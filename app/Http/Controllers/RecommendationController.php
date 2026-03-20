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
            'select' => 2,
            'deluxe' => 4,
            'premium' => 6,
            'exclusive' => 8,
            'ultra' => 10,
        ];

        $rarityValue = $validated['rarity'];
        if (is_string($rarityValue) && array_key_exists(strtolower($rarityValue), $rarityMap)) {
            $rarityValue = $rarityMap[strtolower($rarityValue)];
        }

        // Backward-compatible: convert normalized 0-1 inputs to legacy 2/4/6/8/10 scale.
        if (is_numeric($rarityValue)) {
            $rarityNormalizedMap = [
                0.0 => 2,
                0.25 => 4,
                0.5 => 6,
                0.75 => 8,
                1.0 => 10,
            ];
            $rarityNumeric = (float) $rarityValue;
            if (array_key_exists($rarityNumeric, $rarityNormalizedMap)) {
                $rarityValue = $rarityNormalizedMap[$rarityNumeric];
            }
        }

        if (!is_numeric($rarityValue)) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai rarity tidak valid. Gunakan select/deluxe/premium/exclusive/ultra atau angka 2/4/6/8/10.',
            ], 422);
        }

        $rarityValue = (float) $rarityValue;
        if (!in_array($rarityValue, [2.0, 4.0, 6.0, 8.0, 10.0], true)) {
            return response()->json([
                'success' => false,
                'message' => 'Nilai rarity harus salah satu dari 2, 4, 6, 8, atau 10.',
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

}
