<?php

namespace App\Http\Controllers;

use App\Models\Weapon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecommendationController extends Controller
{
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

        $url = env('FASTAPI_URL') . '/api/recommend-filtered';

        $payload = [
            "weapon" => $weaponValue,
            // Send RAW features; FastAPI should transform using scaler.pkl from training.
            "price" => (float) $validated['price'],
            "vfx" => (float) $validated['vfx'],
            "rarity" => $rarityValue,
            "top_n" => (int) ($validated['top_n'] ?? 3),
        ];

        $response = Http::timeout(10)
            ->retry(2, 200)
            ->post($url, $payload);

        if ($response->successful()) {
            $body = $response->json();

            if (is_array($body)) {
                $body['input'] = [
                    'price' => (float) $validated['price'],
                    'vfx' => (float) $validated['vfx'],
                    'rarity' => $rarityValue,
                ];

                return response()->json($body, $response->status());
            }

            return response()->json([
                'success' => true,
                'data' => $body,
                'input' => [
                    'price' => (float) $validated['price'],
                    'vfx' => (float) $validated['vfx'],
                    'rarity' => $rarityValue,
                ],
            ], $response->status());
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

        $url = env('FASTAPI_URL') . '/api/recommend';

        $payload = [
            'available_skins' => array_values($validated['available_skins']),
            'price' => (float) $validated['price'],
            'rarity' => (float) $validated['rarity'],
            'vfx' => (float) $validated['vfx'],
        ];

        $response = Http::timeout(15)
            ->retry(2, 200)
            ->post($url, $payload);

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

}
