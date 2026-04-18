<?php

namespace App\Http\Controllers;

use App\Models\PredictionHistory;
use App\Models\Weapon;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Throwable;

class RecommendationController extends Controller
{
    private function persistPredictionHistory(Request $request, array $input, array $output): ?PredictionHistory
    {
        if (!$request->user() || !Schema::hasTable('prediction_histories')) {
            return null;
        }

        $rawRecommendations = [];
        if (isset($output['recommendations']) && is_array($output['recommendations'])) {
            $rawRecommendations = $output['recommendations'];
        }

        $compactRecommendations = collect($rawRecommendations)
            ->map(function ($item) {
                if (!is_array($item)) {
                    return null;
                }

                $skinName = trim((string) ($item['skin_name'] ?? ($item['name'] ?? '')));
                if ($skinName === '') {
                    return null;
                }

                $matchPercentage = $item['match_percentage'] ?? null;
                if ($matchPercentage === null && isset($item['similarity_score']) && is_numeric($item['similarity_score'])) {
                    $matchPercentage = number_format((float) $item['similarity_score'], 1) . '%';
                }

                return [
                    'name_skin' => $skinName,
                    'match_percentage' => $matchPercentage !== null ? (string) $matchPercentage : '-',
                ];
            })
            ->filter()
            ->values()
            ->all();

        $weaponValue = $input['weapon'] ?? null;
        $weaponId = null;
        $weaponName = null;

        if (is_numeric($weaponValue)) {
            $weaponModel = Weapon::find((int) $weaponValue);
            $weaponId = $weaponModel?->id;
            $weaponName = $weaponModel?->name ?? (string) $weaponValue;
        } else {
            $weaponName = (string) $weaponValue;
            $weaponModel = Weapon::whereRaw('LOWER(name) = ?', [strtolower($weaponName)])->first();
            if ($weaponModel) {
                $weaponId = $weaponModel->id;
                $weaponName = $weaponModel->name;
            }
        }

        return PredictionHistory::create([
            'user_id' => $request->user()->id,
            'weapon_id' => $weaponId,
            'weapon_name' => $weaponName,
            'input_price' => (float) ($input['price'] ?? 0),
            'input_vfx' => (float) ($input['vfx'] ?? 0),
            'input_rarity' => (string) ($input['rarity'] ?? ''),
            'top_n' => isset($input['top_n']) ? (int) $input['top_n'] : null,
            'recommendations' => $compactRecommendations,
            'response_payload' => [
                'input' => [
                    'weapon' => $weaponName,
                    'price' => (float) ($input['price'] ?? 0),
                    'vfx' => (float) ($input['vfx'] ?? 0),
                    'rarity' => (string) ($input['rarity'] ?? ''),
                    'top_n' => isset($input['top_n']) ? (int) $input['top_n'] : null,
                ],
                'summary' => [
                    'total_recommendations' => count($compactRecommendations),
                ],
            ],
        ]);
    }

    private function fastApiEndpoint(string $path): string
    {
        $baseUrl = trim((string) config('services.fastapi.url', 'http://127.0.0.1:8000'));

        if ($baseUrl === '') {
            $baseUrl = 'http://127.0.0.1:8000';
        }

        if (!preg_match('/^https?:\/\//i', $baseUrl)) {
            $baseUrl = 'http://' . $baseUrl;
        }

        return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
    }

    public function recommend(Request $request)
    {
        $priceMin = (float) env('INPUT_PRICE_MIN', 0);
        $priceMax = (float) env('INPUT_PRICE_MAX', 10000);
        $vfxMin = (float) env('INPUT_VFX_MIN', 0);
        $vfxMax = (float) env('INPUT_VFX_MAX', 10);

        $validated = $request->validate([
            'weapon' => ['required'],
            'price' => ['required', 'numeric', 'min:' . $priceMin, 'max:' . $priceMax],
            'vfx' => ['required', 'numeric', 'min:' . $vfxMin, 'max:' . $vfxMax],
            'rarity' => ['required'],
            'top_n' => ['nullable', 'integer', 'min:1', 'max:50'],
        ]);

        $rarityMap = [
            'select' => 1,
            'deluxe' => 2,
            'premium' => 3,
            'exclusive' => 4,
            'ultra' => 5,
        ];

        $rarityValue = $validated['rarity'];
        if (is_string($rarityValue) && array_key_exists(strtolower($rarityValue), $rarityMap)) {
            $rarityValue = $rarityMap[strtolower($rarityValue)];
        }

        if (!is_numeric($rarityValue)) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai rarity tidak valid. Gunakan select/deluxe/premium/exclusive/ultra atau angka 1/2/3/4/5.',
            ], 422);
        }

        $rarityValue = (float) $rarityValue;
        if (!in_array($rarityValue, [1.0, 2.0, 3.0, 4.0, 5.0], true)) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai rarity harus salah satu dari 1, 2, 3, 4, atau 5.',
            ], 422);
        }

        $weaponValue = $validated['weapon'];
        if (is_numeric($weaponValue)) {
            $weaponModel = Weapon::find((int) $weaponValue);
            $weaponValue = $weaponModel ? strtolower($weaponModel->name) : (string) $weaponValue;
        }

        $url = $this->fastApiEndpoint('/api/recommend-filtered');

        $payload = [
            "weapon" => $weaponValue,
            // Send RAW features; FastAPI should transform using scaler.pkl from training.
            "price" => (float) $validated['price'],
            "vfx" => (float) $validated['vfx'],
            "rarity" => $rarityValue,
            "top_n" => (int) ($validated['top_n'] ?? 3),
        ];

        try {
            $response = Http::timeout(10)
                ->retry(2, 200)
                ->post($url, $payload);
        } catch (ConnectionException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal terhubung ke layanan FastAPI. Periksa FASTAPI_URL Anda. Nilai saat ini: ' . (string) config('services.fastapi.url', ''),
            ], 503);
        }

        if ($response->successful()) {
            $body = $response->json();
            $responseBody = [];

            if (is_array($body)) {
                $body['input'] = [
                    'price' => (float) $validated['price'],
                    'vfx' => (float) $validated['vfx'],
                    'rarity' => $rarityValue,
                ];

                $responseBody = $body;
            } else {
                $responseBody = [
                    'success' => true,
                    'data' => $body,
                    'input' => [
                        'price' => (float) $validated['price'],
                        'vfx' => (float) $validated['vfx'],
                        'rarity' => $rarityValue,
                    ],
                ];
            }

            try {
                $history = $this->persistPredictionHistory($request, [
                    'weapon' => $validated['weapon'],
                    'price' => (float) $validated['price'],
                    'vfx' => (float) $validated['vfx'],
                    'rarity' => $validated['rarity'],
                    'top_n' => (int) ($validated['top_n'] ?? 3),
                ], $responseBody);

                $responseBody['history_saved'] = $history !== null;
                $responseBody['history_id'] = $history?->id;
            } catch (Throwable $e) {
                $responseBody['history_saved'] = false;
                $responseBody['history_save_error'] = 'Gagal menyimpan history prediksi.';
            }

            return response()->json($responseBody, $response->status());
        }

        return response()->json([
            'success' => false,
            'message' => $response->body(),
        ], $response->status());
    }

    public function recommendRaw(Request $request)
    {
        $priceMin = (float) env('INPUT_PRICE_MIN', 0);
        $priceMax = (float) env('INPUT_PRICE_MAX', 10000);
        $vfxMin = (float) env('INPUT_VFX_MIN', 0);
        $vfxMax = (float) env('INPUT_VFX_MAX', 10);

        $validated = $request->validate([
            'available_skins' => ['required', 'array', 'min:1'],
            'available_skins.*' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:' . $priceMin, 'max:' . $priceMax],
            'rarity' => ['required', 'numeric', 'min:1', 'max:5'],
            'vfx' => ['required', 'numeric', 'min:' . $vfxMin, 'max:' . $vfxMax],
        ]);

        $url = $this->fastApiEndpoint('/api/recommend');

        $payload = [
            'available_skins' => array_values($validated['available_skins']),
            'price' => (float) $validated['price'],
            'rarity' => (float) $validated['rarity'],
            'vfx' => (float) $validated['vfx'],
        ];

        try {
            $response = Http::timeout(15)
                ->retry(2, 200)
                ->post($url, $payload);
        } catch (ConnectionException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal terhubung ke layanan FastAPI. Periksa FASTAPI_URL Anda. Nilai saat ini: ' . (string) config('services.fastapi.url', ''),
            ], 503);
        }

        if ($response->successful()) {
            $body = $response->json();

            if (is_array($body)) {
                $body['input'] = $payload;
                return response()->json($body, $response->status());
            }

            return response()->json([
                'success' => true,
                'data' => $body,
                'input' => $payload,
            ], $response->status());
        }

        return response()->json([
            'success' => false,
            'message' => $response->body(),
        ], $response->status());
    }

    public function save(Request $request)
    {
        if (!Schema::hasTable('prediction_histories')) {
            return response()->json([
                'success' => false,
                'message' => 'Tabel prediction_histories belum tersedia. Jalankan migrasi terlebih dahulu.',
            ], 422);
        }

        $priceMin = (float) env('INPUT_PRICE_MIN', 0);
        $priceMax = (float) env('INPUT_PRICE_MAX', 10000);
        $vfxMin = (float) env('INPUT_VFX_MIN', 0);
        $vfxMax = (float) env('INPUT_VFX_MAX', 10);

        $validated = $request->validate([
            'input' => ['required', 'array'],
            'input.weapon' => ['required'],
            'input.price' => ['required', 'numeric', 'min:' . $priceMin, 'max:' . $priceMax],
            'input.vfx' => ['required', 'numeric', 'min:' . $vfxMin, 'max:' . $vfxMax],
            'input.rarity' => ['required'],
            'input.top_n' => ['nullable', 'integer', 'min:1', 'max:50'],
            'output' => ['required', 'array'],
            'output.recommendations' => ['nullable', 'array'],
        ]);

        $history = $this->persistPredictionHistory($request, [
            'weapon' => $validated['input']['weapon'],
            'price' => (float) $validated['input']['price'],
            'vfx' => (float) $validated['input']['vfx'],
            'rarity' => (string) $validated['input']['rarity'],
            'top_n' => $validated['input']['top_n'] ?? null,
        ], $validated['output']);

        if (!$history) {
            return response()->json([
                'success' => false,
                'message' => 'History prediksi hanya bisa disimpan saat user sudah login.',
            ], 401);
        }

        return response()->json([
            'success' => true,
            'message' => 'Hasil prediksi berhasil disimpan ke database.',
            'data' => [
                'id' => $history->id,
                'created_at' => $history->created_at,
            ],
        ]);
    }

}
