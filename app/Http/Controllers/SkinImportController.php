<?php

namespace App\Http\Controllers;

use App\Imports\SkinsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

class SkinImportController extends Controller
{
    /**
     * Menampilkan form import
     */
    public function showImportForm()
    {
        return view('skins.import');
    }

    /**
     * Proses import file Excel
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', // Max 10MB
        ], [
            'file.required' => 'File Excel wajib dipilih',
            'file.mimes' => 'File harus berformat Excel (.xlsx, .xls) atau CSV',
            'file.max' => 'Ukuran file maksimal 10MB',
        ]);

        try {
            $file = $request->file('file');

            // Buat instance import
            $import = new SkinsImport();

            // Import file
            Excel::import($import, $file);

            // Ambil informasi hasil import
            $importedCount = $import->getImportedCount();
            $skippedCount = $import->getSkippedCount();
            $errors = $import->getErrors();

            // Siapkan pesan
            $message = "Import selesai! ";
            $message .= "Berhasil: {$importedCount}, Dilewati: {$skippedCount}";

            if ($skippedCount > 0 && count($errors) > 0) {
                // Batasi jumlah error yang ditampilkan
                $displayErrors = array_slice($errors, 0, 10);

                return redirect()
                    ->route('skins.import.form')
                    ->with('warning', $message)
                    ->with('import_errors', $displayErrors)
                    ->with('total_errors', count($errors));
            }

            return redirect()
                ->route('skins.import.form')
                ->with('success', $message);

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMessages = [];

            foreach ($failures as $failure) {
                $errorMessages[] = "Baris {$failure->row()}: " . implode(', ', $failure->errors());
            }

            return redirect()
                ->route('skins.import.form')
                ->with('error', 'Validasi gagal')
                ->with('import_errors', array_slice($errorMessages, 0, 10));

        } catch (\Exception $e) {
            Log::error('Import Excel Error: ' . $e->getMessage());

            return redirect()
                ->route('skins.import.form')
                ->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }

    /**
     * Download template CSV
     * Kolom: uuid, weapon, skin_name, price, rarity, is_battlepass, popularity, vfx, image_url, theme_uuid, score
     */
    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="template_import_skins.csv"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
        ];

        // Urutan kolom harus sinkron dengan SkinsImport::model()
        $columns = [
            'uuid',          // Wajib: ID unik skin (UUID format)
            'weapon',        // Wajib: Nama weapon (misal: Vandal, Phantom, Ghost)
            'skin_name',     // Wajib: Nama skin
            'price',         // Opsional: Harga VP (integer)
            'rarity',        // Opsional: Tingkat kelangkaan (Select/Deluxe/Premium/Exclusive/Ultra)
            'is_battlepass', // Opsional: Yes/No
            'popularity',    // Opsional: Desimal 0–10
            'vfx',           // Opsional: Visual Effect score, desimal 1.0–10.0
            'image_url',     // Opsional: URL gambar skin
            'theme_uuid',    // Opsional: UUID tema skin
            'score',         // Opsional: Skor prediksi keseluruhan
        ];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');

            // BOM untuk kompatibilitas Excel
            fprintf($file, chr(0xEF) . chr(0xBB) . chr(0xBF));

            // Header row
            fputcsv($file, $columns);

            // Contoh data 1 - Glitchpop Vandal (Premium, VFX tinggi)
            fputcsv($file, [
                'e7e8a4c7-4f7a-5e82-b15f-6e4dd5d8b9c2', // uuid
                'Vandal',                                  // weapon
                'Glitchpop Vandal',                        // skin_name
                '2175',                                    // price
                'Premium',                                 // rarity
                'No',                                      // is_battlepass
                '8.50',                                    // popularity
                '9.00',                                    // vfx (animasi kompleks, partikel banyak)
                'https://media.valorant-api.com/weaponskins/example/displayicon.png', // image_url
                'd8b688bb-41de-6bca-06da-c29aa10de21a',   // theme_uuid
                '8.75',                                    // score
            ]);

            // Contoh data 2 - Reaver Ghost (Premium, VFX sedang)
            fputcsv($file, [
                'f8a9b5d8-5f8b-6f93-c26f-7f5ee6e9ca3d', // uuid
                'Ghost',                                   // weapon
                'Reaver Ghost',                            // skin_name
                '1775',                                    // price
                'Premium',                                 // rarity
                'No',                                      // is_battlepass
                '9.20',                                    // popularity
                '7.50',                                    // vfx (efek sedang, cahaya ungu)
                'https://media.valorant-api.com/weaponskins/example2/displayicon.png', // image_url
                'f8a9b5d8-5f8b-6f93-c26f-7f5ee6e9ca3d',  // theme_uuid
                '8.35',                                    // score
            ]);

            // Contoh data 3 - Kuronami Melee (Ultra, VFX ekstreem)
            fputcsv($file, [
                'g9b0c6e9-6h9c-7g04-d37h-8g6ff7f0db4e', // uuid
                'Melee',                                   // weapon
                'Kuronami Katana',                         // skin_name
                '4350',                                    // price
                'Ultra',                                   // rarity
                'No',                                      // is_battlepass
                '9.80',                                    // popularity
                '9.80',                                    // vfx (efek air, partikel masif)
                'https://media.valorant-api.com/weaponskins/example3/displayicon.png', // image_url
                'g9b0c6e9-6h9c-7g04-d37h-8g6ff7f0db4e',  // theme_uuid
                '9.65',                                    // score
            ]);

            // Contoh data 4 - Battlepass skin (VFX minimal)
            fputcsv($file, [
                'h0c1d7f0-7i0d-8h15-e48i-9h7gg8g1ec5f', // uuid
                'Spectre',                                 // weapon
                'Spline Spectre',                          // skin_name
                '0',                                       // price (battlepass = gratis)
                'Select',                                  // rarity
                'Yes',                                     // is_battlepass
                '5.00',                                    // popularity
                '2.00',                                    // vfx (minimal, hanya warna)
                '',                                        // image_url (kosong)
                '',                                        // theme_uuid (kosong)
                '4.50',                                    // score
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
