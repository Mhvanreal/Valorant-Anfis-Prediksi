<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

class SkinScraperController extends Controller
{
    /**
     * Tampilkan halaman scraper
     */
    public function showScraperForm(): Response
    {
        $weapons = \App\Models\Weapon::orderBy('name')->pluck('name');
        return response()->view('skins.scraper', compact('weapons'));
    }

    /**
     * Jalankan scraper Python dan stream output via SSE
     */
    public function run(Request $request): StreamedResponse
    {
        $request->validate([
            'weapons'   => 'nullable|array',
            'weapons.*' => 'string|max:50',
            'dry_run'   => 'nullable|boolean',
        ]);

        $scriptPath = base_path('scripts/scrape_skins.py');

        if (!file_exists($scriptPath)) {
            abort(500, 'Script scraper tidak ditemukan: ' . $scriptPath);
        }

        $pythonPath = $this->resolvePython();

        // ── Bangun argumen sebagai array (aman, tidak ada masalah escaping) ──
        // -X utf8 : paksa Python pakai UTF-8 di semua I/O (penting di Windows)
        $argv = [$pythonPath, '-X', 'utf8', $scriptPath];

        // Filter weapon (opsional)
        $weapons = array_filter((array) $request->input('weapons', []));
        if (!empty($weapons)) {
            $argv[] = '--weapons';
            foreach ($weapons as $w) {
                $argv[] = $w;
            }
        }

        // Dry run
        if ($request->boolean('dry_run')) {
            $argv[] = '--dry-run';
        }

        // Konfigurasi DB dari Laravel config
        $argv[] = '--db-host';     $argv[] = config('database.connections.mysql.host',     '127.0.0.1');
        $argv[] = '--db-port';     $argv[] = config('database.connections.mysql.port',     '3306');
        $argv[] = '--db-name';     $argv[] = config('database.connections.mysql.database', 'valorant_anfis');
        $argv[] = '--db-user';     $argv[] = config('database.connections.mysql.username', 'root');
        $argv[] = '--db-password'; $argv[] = config('database.connections.mysql.password', '');

        // Gabungkan menjadi command string dengan escaping yang benar
        $command = implode(' ', array_map('escapeshellarg', $argv)) . ' 2>&1';

        return response()->stream(function () use ($command, $pythonPath) {

            $process = popen($command, 'r');

            if (!$process) {
                $this->sseEvent('log', [
                    'level'     => 'error',
                    'message'   => 'Gagal memulai proses Python. Periksa PYTHON_PATH di .env',
                    'timestamp' => date('H:i:s'),
                ]);
                $this->sseEvent('done', []);
                return;
            }

            while (!feof($process)) {
                $line = fgets($process);
                if ($line === false) break;

                $line = trim($line);
                if (empty($line)) continue;

                $data = json_decode($line, true);

                if ($data && isset($data['level'])) {
                    $this->sseEvent('log', $data);
                } elseif ($data && isset($data['type']) && $data['type'] === 'stats') {
                    $this->sseEvent('stats', $data);
                } else {
                    // Raw output — biasanya error Python / pip warning
                    $this->sseEvent('log', [
                        'level'     => 'warning',
                        'message'   => $line,
                        'timestamp' => date('H:i:s'),
                    ]);
                }

                ob_flush();
                flush();
            }

            pclose($process);

            $this->sseEvent('done', ['message' => 'Proses scraping selesai.']);
            ob_flush();
            flush();

        }, 200, [
            'Content-Type'      => 'text/event-stream',
            'Cache-Control'     => 'no-cache, no-store',
            'X-Accel-Buffering' => 'no',
            'Connection'        => 'keep-alive',
        ]);
    }

    /**
     * Emit satu SSE event
     */
    private function sseEvent(string $event, array $data): void
    {
        echo "event: {$event}\n";
        echo 'data: ' . json_encode($data, JSON_UNESCAPED_UNICODE) . "\n\n";
    }

    /**
     * Resolve path Python yang valid.
     *
     * Urutan prioritas:
     *  1. PYTHON_PATH di .env  (paling eksplisit, selalu diutamakan)
     *  2. Daftar path absolut umum di Windows / Laragon
     *  3. Nama command di PATH sistem (python / python3 / py)
     */
    private function resolvePython(): string
    {
        // 1. Dari .env
        $envPath = env('PYTHON_PATH');
        if ($envPath && file_exists($envPath)) {
            return $envPath;
        }

        // 2. Path absolut umum (Laragon, pyenv-win, WinPython, installer standar)
        $knownPaths = [
            'D:\\laragon\\bin\\python\\python-3.13\\python.exe',
            'D:\\laragon\\bin\\python\\python-3.12\\python.exe',
            'D:\\laragon\\bin\\python\\python-3.11\\python.exe',
            'D:\\laragon\\bin\\python\\python-3.10\\python.exe',
            'C:\\Python313\\python.exe',
            'C:\\Python312\\python.exe',
            'C:\\Python311\\python.exe',
            'C:\\Python310\\python.exe',
            'C:\\Python39\\python.exe',
            'C:\\Users\\' . get_current_user() . '\\AppData\\Local\\Programs\\Python\\Python313\\python.exe',
            'C:\\Users\\' . get_current_user() . '\\AppData\\Local\\Programs\\Python\\Python312\\python.exe',
            'C:\\Users\\' . get_current_user() . '\\AppData\\Local\\Programs\\Python\\Python311\\python.exe',
            'C:\\Users\\' . get_current_user() . '\\AppData\\Local\\Programs\\Python\\Python310\\python.exe',
        ];

        foreach ($knownPaths as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }

        // 3. Fallback ke command di PATH — bisa jadi tidak ditemukan di web context
        //    tapi tetap dicoba sebagai last resort
        foreach (['python3', 'python', 'py'] as $cmd) {
            $out  = [];
            $code = 0;
            exec("where {$cmd} 2>NUL", $out, $code);
            if ($code === 0 && !empty($out[0]) && file_exists(trim($out[0]))) {
                return trim($out[0]);
            }
        }

        // Tidak ditemukan — kembalikan string deskriptif agar error jelas
        return 'PYTHON_NOT_FOUND';
    }
}
