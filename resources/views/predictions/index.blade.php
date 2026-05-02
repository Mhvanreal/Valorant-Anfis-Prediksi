@extends('layouts.app-dashboard')

@section('title', 'History Prediksi')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">History Prediksi</h1>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Daftar hasil prediksi yang tersimpan dari pengunjung (guest) dan admin</p>
        </div>
    </div>

    @if (session('success'))
        <div
            class="p-3 mb-4 text-sm text-green-700 border border-green-200 rounded-lg bg-green-50 dark:bg-green-900/20 dark:text-green-300 dark:border-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div
            class="p-3 mb-4 text-sm text-red-700 border border-red-200 rounded-lg bg-red-50 dark:bg-red-900/20 dark:text-red-300 dark:border-red-800">
            {{ $errors->first() }}
        </div>
    @endif

    @if (!$tableReady)
        <div class="p-4 mb-6 border border-yellow-200 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 dark:border-yellow-800">
            <p class="text-sm font-medium text-yellow-800 dark:text-yellow-300">
                Tabel history prediksi belum tersedia. Jalankan migrasi terlebih dahulu dengan perintah
                <span class="font-semibold">php artisan migrate</span>.
            </p>
        </div>
    @endif

    <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th
                            class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase dark:text-gray-300">
                            #</th>
                        <th
                            class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase dark:text-gray-300">
                            Tanggal</th>
                        <th
                            class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase dark:text-gray-300">
                            Pengguna</th>
                        <th
                            class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase dark:text-gray-300">
                            Weapon</th>
                        <th
                            class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase dark:text-gray-300">
                            Input</th>
                        <th
                            class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase dark:text-gray-300">
                            Top N</th>
                        <th
                            class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase dark:text-gray-300">
                            Status</th>
                        <th
                            class="px-6 py-3 text-xs font-semibold tracking-wider text-left text-gray-700 uppercase dark:text-gray-300">
                            Rekomendasi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    @forelse ($histories as $history)
                        @php
                            $recommendations = is_array($history->recommendations) ? $history->recommendations : [];
                            $recommendationItems = collect($recommendations)
                                ->map(function ($item) {
                                    if (!is_array($item)) {
                                        return null;
                                    }

                                    $nameSkin = $item['name_skin'] ?? ($item['skin_name'] ?? ($item['name'] ?? null));
                                    if (!$nameSkin) {
                                        return null;
                                    }

                                    return [
                                        'name_skin' => $nameSkin,
                                        'match_percentage' => $item['match_percentage'] ?? '-',
                                    ];
                                })
                                ->filter()
                                ->take(3)
                                ->values();

                            $totalSkin = (int) ($history->top_n ?? 0);
                            if ($totalSkin < 1) {
                                $totalSkin = max(1, $recommendationItems->count());
                            }

                            $payload = is_array($history->response_payload) ? $history->response_payload : [];
                            $evaluation = is_array($payload['evaluation'] ?? null) ? $payload['evaluation'] : [];
                            $missCount =
                                isset($evaluation['miss_count']) && is_numeric($evaluation['miss_count'])
                                    ? (int) $evaluation['miss_count']
                                    : null;
                            $missPercentage =
                                isset($evaluation['miss_percentage']) && is_numeric($evaluation['miss_percentage'])
                                    ? (float) $evaluation['miss_percentage']
                                    : ($missCount !== null && $totalSkin > 0
                                        ? round(($missCount / $totalSkin) * 100, 2)
                                        : null);
                        @endphp
                        <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-300">
                                {{ ($histories->currentPage() - 1) * $histories->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-300">
                                {{ $history->created_at?->timezone('Asia/Jakarta')->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-300">
                                @php
                                    $guestToken = is_string($history->guest_token ?? null) ? $history->guest_token : null;
                                    $guestLabel = $guestToken ? 'Guest-' . substr($guestToken, 0, 8) : 'Guest';
                                @endphp
                                {{ $history->user_id ? 'Admin' : $guestLabel }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-300">
                                {{ $history->weapon_name ?: '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                <div class="space-y-1">
                                    <p>Price: <span
                                            class="font-medium">{{ rtrim(rtrim(number_format((float) $history->input_price, 2, '.', ''), '0'), '.') }}</span>
                                    </p>
                                    <p>VFX: <span
                                            class="font-medium">{{ rtrim(rtrim(number_format((float) $history->input_vfx, 2, '.', ''), '0'), '.') }}</span>
                                    </p>
                                    <p>Rarity: <span class="font-medium">{{ $history->input_rarity }}</span></p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-300">
                                {{ $history->top_n ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap dark:text-gray-300">
                                @php
                                    $status = strtolower((string) ($history->status ?? 'tidak_meleset'));
                                    $statusClass = match ($status) {
                                        'tidak_meleset'
                                            => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
                                        'meleset' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
                                        default => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
                                    };

                                    $statusLabel = $status === 'tidak_meleset' ? 'tidak meleset' : $status;
                                @endphp
                                <span
                                    class="inline-flex px-2.5 py-1 text-xs font-semibold capitalize rounded-full {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                                <p class="mt-1 text-xs text-gray-600 dark:text-gray-300">
                                    @if ($status === 'meleset' && $missCount !== null)
                                        Meleset {{ $missCount }} dari {{ $totalSkin }}
                                        ({{ number_format($missPercentage ?? 0, 1) }}%)
                                    @elseif ($status === 'tidak_meleset')
                                        Akurat 100%
                                    @else
                                        -
                                    @endif
                                </p>
                                <div class="mt-2">
                                    <button type="button"
                                        class="inline-flex items-center px-2.5 py-1 text-xs font-semibold text-white transition rounded-md bg-cyan-600 hover:bg-cyan-700 edit-status-btn"
                                        data-id="{{ $history->id }}" data-status="{{ $status }}"
                                        data-weapon="{{ $history->weapon_name ?: '-' }}" data-total="{{ $totalSkin }}"
                                        data-miss-count="{{ $missCount ?? 0 }}"
                                        data-url="{{ route('predictions.status.update', $history) }}">
                                        Edit
                                    </button>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-300">
                                @if ($recommendationItems->isNotEmpty())
                                    <ul class="space-y-1 list-disc list-inside">
                                        @foreach ($recommendationItems as $item)
                                            <li>
                                                <span class="font-medium">{{ $item['name_skin'] }}</span>
                                                <span
                                                    class="text-gray-500 dark:text-gray-400">({{ $item['match_percentage'] }})</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-gray-500 dark:text-gray-400">Tidak ada data rekomendasi</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <span class="text-5xl text-gray-300 material-icons dark:text-gray-600">history</span>
                                    <p class="mt-4 text-sm font-medium text-gray-700 dark:text-gray-400">Belum ada history
                                        prediksi</p>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">Lakukan prediksi dari halaman utama,
                                        hasilnya akan tersimpan otomatis sebagai guest</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($histories->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $histories->links() }}
            </div>
        @endif
    </div>

    <div id="statusModal" class="fixed inset-0 z-50 hidden p-4 bg-black/60 backdrop-blur-sm">
        <div class="flex items-center justify-center w-full min-h-full">
            <div
                class="w-full max-w-md p-6 bg-white border border-gray-200 shadow-2xl rounded-xl dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">Edit Status History</h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Weapon: <span id="modalWeaponName">-</span>
                        </p>
                    </div>
                    <button id="closeStatusModal" type="button"
                        class="p-2 text-gray-500 transition rounded-md hover:bg-gray-100 hover:text-gray-700 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                        <span class="material-icons">close</span>
                    </button>
                </div>

                <form id="statusForm" method="POST" class="mt-4 space-y-4">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="statusInput"
                            class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Status</label>
                        <select id="statusInput" name="status"
                            class="w-full px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                            <option value="tidak_meleset">tidak meleset (akurat 100%)</option>
                            <option value="meleset">meleset</option>
                        </select>
                    </div>

                    <div id="missCountWrapper" class="hidden">
                        <label for="missCountInput"
                            class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Jumlah skin meleset
                        </label>
                        <input type="number" id="missCountInput" name="miss_count" min="1"
                            class="w-full px-3 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500">
                        <p id="missCountHelper" class="mt-1 text-xs text-gray-500 dark:text-gray-400">-</p>
                    </div>

                    <div class="flex items-center justify-end gap-2 pt-2">
                        <button type="button" id="cancelStatusModal"
                            class="px-4 py-2 text-sm font-semibold text-gray-700 transition bg-gray-100 rounded-lg hover:bg-gray-200 dark:text-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-semibold text-white transition rounded-lg bg-cyan-600 hover:bg-cyan-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const statusModal = document.getElementById('statusModal');
        const closeStatusModal = document.getElementById('closeStatusModal');
        const cancelStatusModal = document.getElementById('cancelStatusModal');
        const statusForm = document.getElementById('statusForm');
        const statusInput = document.getElementById('statusInput');
        const missCountWrapper = document.getElementById('missCountWrapper');
        const missCountInput = document.getElementById('missCountInput');
        const missCountHelper = document.getElementById('missCountHelper');
        const modalWeaponName = document.getElementById('modalWeaponName');
        const editButtons = document.querySelectorAll('.edit-status-btn');
        let activeTotalSkin = 1;

        function updateMissCountVisibility(totalSkin) {
            const isMeleset = statusInput.value === 'meleset';

            if (isMeleset) {
                missCountWrapper.classList.remove('hidden');
                missCountInput.disabled = false;
                missCountInput.required = true;
                missCountInput.min = '1';
                missCountInput.max = String(totalSkin);
                if (!missCountInput.value || Number(missCountInput.value) < 1) {
                    missCountInput.value = '1';
                }
                missCountHelper.textContent = `Isi angka berapa skin yang meleset dari total top n ${totalSkin}.`;
            } else {
                missCountWrapper.classList.add('hidden');
                missCountInput.disabled = true;
                missCountInput.required = false;
                missCountInput.value = '';
                missCountHelper.textContent = '-';
            }
        }

        function openStatusModal(payload) {
            statusForm.setAttribute('action', payload.url);
            statusInput.value = payload.status === 'meleset' ? 'meleset' : 'tidak_meleset';
            modalWeaponName.textContent = payload.weapon;
            activeTotalSkin = payload.totalSkin > 0 ? payload.totalSkin : 1;
            missCountInput.value = payload.status === 'meleset' ? String(payload.missCount ?? 1) : '';
            updateMissCountVisibility(activeTotalSkin);
            statusModal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function hideStatusModal() {
            statusModal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        editButtons.forEach((button) => {
            button.addEventListener('click', () => {
                const totalSkin = Number(button.dataset.total || '0');
                openStatusModal({
                    url: button.dataset.url,
                    status: button.dataset.status,
                    weapon: button.dataset.weapon,
                    totalSkin: totalSkin > 0 ? totalSkin : 1,
                    missCount: Number(button.dataset.missCount || '0'),
                });
            });
        });

        if (statusInput) {
            statusInput.addEventListener('change', () => {
                updateMissCountVisibility(activeTotalSkin);
            });
        }

        if (closeStatusModal) {
            closeStatusModal.addEventListener('click', hideStatusModal);
        }

        if (cancelStatusModal) {
            cancelStatusModal.addEventListener('click', hideStatusModal);
        }

        if (statusModal) {
            statusModal.addEventListener('click', (event) => {
                if (event.target === statusModal) {
                    hideStatusModal();
                }
            });
        }

        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && statusModal && !statusModal.classList.contains('hidden')) {
                hideStatusModal();
            }
        });
    </script>
@endpush
