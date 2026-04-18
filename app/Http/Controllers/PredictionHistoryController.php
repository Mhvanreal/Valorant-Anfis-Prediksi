<?php

namespace App\Http\Controllers;

use App\Models\PredictionHistory;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as PaginationLengthAwarePaginator;
use Illuminate\Support\Facades\Schema;

class PredictionHistoryController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 10;

        if (!Schema::hasTable('prediction_histories')) {
            $histories = new PaginationLengthAwarePaginator(
                items: collect(),
                total: 0,
                perPage: $perPage,
                currentPage: 1,
                options: ['path' => $request->url(), 'query' => $request->query()]
            );

            return view('predictions.index', [
                'histories' => $histories,
                'tableReady' => false,
            ]);
        }

        $histories = PredictionHistory::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate($perPage);

        return view('predictions.index', [
            'histories' => $histories,
            'tableReady' => true,
        ]);
    }

    public function updateStatus(Request $request, PredictionHistory $predictionHistory)
    {
        if ((int) $predictionHistory->user_id !== (int) $request->user()->id) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => ['required', 'in:meleset,tidak_meleset'],
        ]);

        $totalSkin = (int) ($predictionHistory->top_n ?? 0);
        if ($totalSkin < 1) {
            $recommendations = is_array($predictionHistory->recommendations) ? $predictionHistory->recommendations : [];
            $totalSkin = count($recommendations);
        }

        if ($validated['status'] === 'meleset' && $totalSkin < 1) {
            return back()->withErrors('Top N pada history ini belum tersedia, jadi status meleset tidak bisa dihitung.');
        }

        $missCount = 0;
        if ($validated['status'] === 'meleset') {
            $missValidated = $request->validate([
                'miss_count' => ['required', 'integer', 'min:1', 'max:' . $totalSkin],
            ]);
            $missCount = (int) $missValidated['miss_count'];
        }

        $missPercentage = $totalSkin > 0 ? round(($missCount / $totalSkin) * 100, 2) : 0;
        $responsePayload = is_array($predictionHistory->response_payload) ? $predictionHistory->response_payload : [];
        $responsePayload['evaluation'] = [
            'miss_count' => $missCount,
            'total_skin' => $totalSkin,
            'miss_percentage' => $missPercentage,
        ];

        $predictionHistory->update([
            'status' => $validated['status'],
            'response_payload' => $responsePayload,
        ]);

        return back()->with('success', 'Status history prediksi berhasil diperbarui.');
    }
}
