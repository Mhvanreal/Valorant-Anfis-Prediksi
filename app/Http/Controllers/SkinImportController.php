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
     * Download template Excel
     */
    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="template_import_skins.csv"',
        ];

        $columns = ['uuid', 'weapon', 'skin_name', 'price', 'rarity', 'is_battlepass', 'popularity', 'vfx', 'image_url', 'theme_uuid', 'score'];

        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');

            // Header
            fputcsv($file, $columns);

            // Contoh data
            fputcsv($file, [
                'e7e8a4c7-4f7a-5e82-b15f-6e4dd5d8b9c2',
                'Vandal',
                'Glitchpop',
                '2175',
                '10.0',
                'No',
                '8.5',
                '4.2857',
                'https://media.valorant-api.com/weaponskins/example/displayicon.png',
                'd8b688bb-41de-6bca-06da-c29aa10de21a',
                '7.5'
            ]);

            fputcsv($file, [
                'f8a9b5d8-5g8b-6f93-c26g-7f5ee6e9ca3d',
                'Ghost',
                'Reaver',
                '1775',
                '10.0',
                'Yes',
                '9.2',
                '3.5',
                'https://media.valorant-api.com/weaponskins/example2/displayicon.png',
                'f8a9b5d8-5g8b-6f93-c26g-7f5ee6e9ca3d',
                '8.2'
            ]);

            fputcsv($file, [
                'g9b0c6e9-6h9c-7g04-d37h-8g6ff7f0db4e',
                'Melee',
                'Kuronami',
                '4350',
                '10.0',
                'No',
                '9.8',
                '5.0',
                'https://media.valorant-api.com/weaponskins/example3/displayicon.png',
                'g9b0c6e9-6h9c-7g04-d37h-8g6ff7f0db4e',
                '9.0'
            ]);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
