@extends('layouts.app-dashboard')

@section('title', 'Scraping Skins')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <div class="flex items-center mb-3 space-x-2 text-sm text-gray-600 dark:text-gray-400">
                <a href="{{ route('skins.index') }}"
                    class="transition-colors hover:text-red-600 dark:hover:text-red-400">Skins</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="font-medium text-gray-900 dark:text-white">Scraping</span>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Scraping Skins</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Ambil data skin langsung dari
                <a href="https://valorant-api.com" target="_blank"
                    class="font-medium text-red-600 hover:underline dark:text-red-400">valorant-api.com</a>
                menggunakan Python
            </p>
        </div>
        <a href="{{ route('skins.index') }}"
            class="inline-flex items-center px-4 py-2 space-x-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali</span>
        </a>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        <!-- Left: Config Panel -->
        <div class="space-y-6 lg:col-span-1">

            <!-- Info Card -->
            <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                        <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Cara Kerja
                    </h3>
                </div>
                <div class="p-5 space-y-3">
                    <div class="flex items-start space-x-3">
                        <span
                            class="flex-shrink-0 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-600 rounded-full mt-0.5">1</span>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Script Python mengambil data dari
                            <strong>valorant-api.com</strong></p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <span
                            class="flex-shrink-0 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-600 rounded-full mt-0.5">2</span>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Data di-parse: nama skin, weapon, rarity,
                            harga VP, gambar, dan theme UUID</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <span
                            class="flex-shrink-0 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-600 rounded-full mt-0.5">3</span>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Insert atau update ke database MySQL secara
                            otomatis (upsert by UUID)</p>
                    </div>
                    <div class="flex items-start space-x-3">
                        <span
                            class="flex-shrink-0 flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-green-600 rounded-full mt-0.5">✓</span>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Kolom <strong>vfx</strong>,
                            <strong>popularity</strong>, dan <strong>score</strong> tidak tersedia dari API —
                            diisi manual atau via Import Excel</p>
                    </div>
                </div>
            </div>

            <!-- Scraper Config Form -->
            <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                        <svg class="w-4 h-4 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                        Konfigurasi
                    </h3>
                </div>
                <div class="p-5 space-y-5">

                    <!-- Filter Weapon -->
                    <div>
                        <label class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Filter Weapon
                        </label>
                        <p class="mb-3 text-xs text-gray-500 dark:text-gray-400">
                            Pilih weapon spesifik atau biarkan kosong untuk scrape semua weapon.
                        </p>
                        <div class="grid grid-cols-2 gap-2" id="weaponCheckboxes">
                            @foreach ($weapons as $weapon)
                                <label
                                    class="flex items-center p-2 space-x-2 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <input type="checkbox" name="weapons[]" value="{{ $weapon }}"
                                        class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500 dark:border-gray-600 weapon-checkbox">
                                    <span class="text-xs font-medium text-gray-700 dark:text-gray-300">{{ $weapon }}</span>
                                </label>
                            @endforeach
                        </div>
                        <div class="flex gap-2 mt-2">
                            <button type="button" onclick="toggleAll(true)"
                                class="text-xs text-blue-600 hover:text-blue-800 dark:text-blue-400">Pilih semua</button>
                            <span class="text-xs text-gray-400">•</span>
                            <button type="button" onclick="toggleAll(false)"
                                class="text-xs text-red-600 hover:text-red-800 dark:text-red-400">Reset</button>
                        </div>
                    </div>

                    <!-- Dry Run Toggle -->
                    <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg dark:border-gray-600">
                        <div>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Dry Run</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Preview tanpa simpan ke database</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="dryRunToggle" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-red-600">
                            </div>
                        </label>
                    </div>

                    <!-- Start Button -->
                    <button id="startBtn" onclick="startScraping()"
                        class="w-full inline-flex items-center justify-center px-5 py-3 space-x-2 text-sm font-medium text-white transition-all duration-200 rounded-lg shadow bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span id="startBtnText">Mulai Scraping</span>
                    </button>

                    <button id="stopBtn" onclick="stopScraping()" class="hidden w-full inline-flex items-center justify-center px-5 py-3 space-x-2 text-sm font-medium text-gray-700 transition-all duration-200 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                        </svg>
                        <span>Hentikan</span>
                    </button>
                </div>
            </div>

            <!-- Data yang di-scrape -->
            <div class="p-4 border border-blue-200 rounded-lg bg-blue-50 dark:bg-blue-900/20 dark:border-blue-800">
                <p class="mb-2 text-xs font-semibold text-blue-800 dark:text-blue-400">Data yang di-scrape:</p>
                <div class="space-y-1">
                    @foreach ([
                        ['uuid', '✓', 'green'],
                        ['weapon', '✓', 'green'],
                        ['skin_name', '✓', 'green'],
                        ['rarity', '✓', 'green'],
                        ['price (VP)', '✓', 'green'],
                        ['image_url', '✓', 'green'],
                        ['is_battlepass', '✓', 'green'],
                        ['theme_uuid', '✓', 'green'],
                        ['vfx', '— manual', 'yellow'],
                        ['popularity', '— manual', 'yellow'],
                        ['score', '— manual', 'yellow'],
                    ] as [$col, $status, $color])
                        <div class="flex items-center justify-between">
                            <code class="text-xs font-mono text-blue-800 dark:text-blue-300">{{ $col }}</code>
                            <span class="text-xs font-medium text-{{ $color }}-700 dark:text-{{ $color }}-400">{{ $status }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right: Live Log Panel -->
        <div class="lg:col-span-2">
            <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800 h-full flex flex-col">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                        <svg class="w-4 h-4 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Log Scraping
                    </h3>
                    <div class="flex items-center space-x-3">
                        <!-- Status indicator -->
                        <div id="statusBadge"
                            class="hidden items-center px-3 py-1 space-x-1.5 text-xs font-medium rounded-full">
                        </div>
                        <button onclick="clearLog()"
                            class="text-xs text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            Bersihkan
                        </button>
                    </div>
                </div>

                <!-- Stats Bar (tersembunyi sampai scraping selesai) -->
                <div id="statsBar" class="hidden px-6 py-3 border-b border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <p class="text-xl font-bold text-green-600 dark:text-green-400" id="statNew">0</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Skin Baru</p>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-gray-500 dark:text-gray-400" id="statSkipped">0</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Sudah Ada</p>
                        </div>
                        <div>
                            <p class="text-xl font-bold text-red-600 dark:text-red-400" id="statErrors">0</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Error</p>
                        </div>
                    </div>
                    <p class="mt-2 text-xs text-center text-gray-500 dark:text-gray-400" id="statElapsed"></p>
                </div>

                <!-- Log output -->
                <div id="logContainer"
                    class="flex-1 overflow-y-auto bg-gray-950 font-mono text-xs p-4 space-y-0.5 min-h-[400px] max-h-[520px]">
                    <p class="text-gray-500 italic">Konfigurasi scraping di panel kiri, lalu klik "Mulai Scraping"...</p>
                </div>

                <!-- Footer hint -->
                <div class="px-6 py-3 border-t border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        <svg class="inline w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Log di-stream secara real-time. Kolom <strong>vfx</strong>, <strong>popularity</strong>, dan
                        <strong>score</strong> perlu diisi manual via halaman
                        <a href="{{ route('skins.import.form') }}" class="text-red-600 hover:underline dark:text-red-400">Import
                            Excel</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let eventSource = null;
            let isRunning = false;

            function toggleAll(checked) {
                document.querySelectorAll('.weapon-checkbox').forEach(cb => cb.checked = checked);
            }

            function getSelectedWeapons() {
                return [...document.querySelectorAll('.weapon-checkbox:checked')].map(cb => cb.value);
            }

            function startScraping() {
                if (isRunning) return;

                // Build form data
                const selectedWeapons = getSelectedWeapons();
                const dryRun = document.getElementById('dryRunToggle').checked;

                const params = new URLSearchParams();
                selectedWeapons.forEach(w => params.append('weapons[]', w));
                if (dryRun) params.append('dry_run', '1');

                // Reset UI
                clearLog();
                document.getElementById('statsBar').classList.add('hidden');
                setStatus('running', 'Berjalan...');
                setButtonState(true);
                isRunning = true;

                appendLog('info', 'Memulai scraping skins dari valorant-api.com...');
                if (dryRun) appendLog('warning', 'Mode DRY RUN aktif — tidak ada data yang disimpan ke database.');
                if (selectedWeapons.length > 0) {
                    appendLog('info', `Filter weapon: ${selectedWeapons.join(', ')}`);
                } else {
                    appendLog('info', 'Semua weapon akan di-scrape.');
                }

                // Buka SSE connection
                const url = `{{ route('skins.scraper.run') }}?${params.toString()}`;
                eventSource = new EventSource(url);

                eventSource.addEventListener('log', e => {
                    const data = JSON.parse(e.data);
                    appendLog(data.level, `[${data.timestamp}] ${data.message}`);
                });

                eventSource.addEventListener('stats', e => {
                    const data = JSON.parse(e.data);
                    showStats(data);
                });

                eventSource.addEventListener('done', e => {
                    appendLog('success', '✓ Scraping selesai!');
                    setStatus('done', 'Selesai');
                    setButtonState(false);
                    isRunning = false;
                    eventSource.close();
                    eventSource = null;
                });

                eventSource.addEventListener('error', e => {
                    const data = JSON.parse(e.data || '{}');
                    appendLog('error', data.message || 'Koneksi SSE terputus.');
                    setStatus('error', 'Error');
                    setButtonState(false);
                    isRunning = false;
                    if (eventSource) {
                        eventSource.close();
                        eventSource = null;
                    }
                });

                eventSource.onerror = () => {
                    if (isRunning) {
                        appendLog('warning', 'Koneksi ke server terputus. Scraping mungkin masih berjalan di background.');
                        setStatus('error', 'Terputus');
                        setButtonState(false);
                        isRunning = false;
                    }
                };
            }

            function stopScraping() {
                if (eventSource) {
                    eventSource.close();
                    eventSource = null;
                }
                isRunning = false;
                appendLog('warning', 'Scraping dihentikan oleh pengguna.');
                setStatus('stopped', 'Dihentikan');
                setButtonState(false);
            }

            function appendLog(level, message) {
                const container = document.getElementById('logContainer');

                // Hapus placeholder
                const placeholder = container.querySelector('.italic');
                if (placeholder) placeholder.remove();

                const colors = {
                    info:    'text-gray-300',
                    warning: 'text-yellow-400',
                    error:   'text-red-400',
                    success: 'text-green-400',
                };

                const icons = {
                    info:    '›',
                    warning: '⚠',
                    error:   '✕',
                    success: '✓',
                };

                const line = document.createElement('div');
                line.className = `flex items-start space-x-2 py-0.5 ${colors[level] || 'text-gray-300'}`;
                line.innerHTML = `
                    <span class="flex-shrink-0 mt-0.5 select-none opacity-60">${icons[level] || '›'}</span>
                    <span class="break-all">${escapeHtml(message)}</span>
                `;
                container.appendChild(line);
                container.scrollTop = container.scrollHeight;
            }

            function showStats(data) {
                document.getElementById('statsBar').classList.remove('hidden');
                document.getElementById('statNew').textContent     = data.new      ?? data.inserted ?? 0;
                document.getElementById('statSkipped').textContent = data.skipped  ?? 0;
                document.getElementById('statErrors').textContent  = data.errors   ?? 0;
                document.getElementById('statElapsed').textContent = `Selesai dalam ${data.elapsed}s`;
            }

            function clearLog() {
                const container = document.getElementById('logContainer');
                container.innerHTML = '<p class="text-gray-500 italic">Log akan muncul di sini...</p>';
                document.getElementById('statsBar').classList.add('hidden');
                document.getElementById('statusBadge').classList.add('hidden');
            }

            function setStatus(state, label) {
                const badge = document.getElementById('statusBadge');
                badge.classList.remove('hidden');
                badge.classList.remove(
                    'bg-yellow-100', 'text-yellow-700', 'dark:bg-yellow-900/30', 'dark:text-yellow-400',
                    'bg-green-100', 'text-green-700', 'dark:bg-green-900/30', 'dark:text-green-400',
                    'bg-red-100', 'text-red-700', 'dark:bg-red-900/30', 'dark:text-red-400',
                    'bg-gray-100', 'text-gray-700', 'dark:bg-gray-700', 'dark:text-gray-300',
                );

                const stateClasses = {
                    running:  'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400',
                    done:     'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                    error:    'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                    stopped:  'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                };

                badge.className = `flex items-center px-3 py-1 space-x-1.5 text-xs font-medium rounded-full ${stateClasses[state] || stateClasses.stopped}`;

                const dot = state === 'running'
                    ? '<span class="relative flex w-2 h-2"><span class="absolute inline-flex w-full h-full bg-yellow-400 rounded-full opacity-75 animate-ping"></span><span class="relative inline-flex w-2 h-2 bg-yellow-500 rounded-full"></span></span>'
                    : '<span class="w-2 h-2 rounded-full bg-current"></span>';

                badge.innerHTML = `${dot}<span>${label}</span>`;
            }

            function setButtonState(running) {
                const startBtn = document.getElementById('startBtn');
                const stopBtn  = document.getElementById('stopBtn');
                const startText = document.getElementById('startBtnText');

                if (running) {
                    startBtn.disabled = true;
                    startBtn.classList.add('opacity-50', 'cursor-not-allowed');
                    startText.textContent = 'Sedang berjalan...';
                    stopBtn.classList.remove('hidden');
                    stopBtn.classList.add('flex');
                } else {
                    startBtn.disabled = false;
                    startBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    startText.textContent = 'Mulai Scraping';
                    stopBtn.classList.add('hidden');
                    stopBtn.classList.remove('flex');
                }
            }

            function escapeHtml(str) {
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/"/g, '&quot;');
            }
        </script>
    @endpush
@endsection
