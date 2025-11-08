<?= $this->extend('layout/mahasiswa/main') ?>

<?= $this->section('content') ?>
<!-- Header -->
<div class="mb-6 sm:mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Kartu Rencana Studi (KRS)</h1>
           
        </div>
        <div class="mt-4 sm:mt-0">
            <div class="flex items-center space-x-2 text-sm text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span><?= get_current_time('d F Y') ?></span>
            </div>
        </div>
    </div>
</div>

<!-- KRS Status Alert -->
<?php if (!$can_input_krs): ?>
<div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm text-red-700">
                <strong>KRS Sudah Diajukan!</strong><br>
                Status: <span class="font-semibold"><?= $krs_status === 'submitted' ? 'Menunggu Persetujuan' : 'Disetujui' ?></span><br>
                KRS yang sudah diajukan tidak dapat diubah lagi. Untuk perubahan KRS, silakan hubungi Dosen Pembimbing Akademik atau Bagian Akademik.
            </p>
        </div>
    </div>
</div>
<?php else: ?>
<div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
    <div class="flex">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <div class="ml-3">
            <p class="text-sm text-green-700">
                <strong>Periode Input KRS Aktif!</strong><br>
                Silakan pilih mata kuliah yang ingin Anda ambil. Batas maksimal: 24 SKS | Periode: 15 Januari - 15 Februari 2025
            </p>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Total SKS Diambil -->
    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-blue-500">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">SKS Diambil</p>
                <p class="text-2xl font-bold text-gray-900" id="total-sks"><?= getTotalSKSKRS($krs_aktif) ?></p>
                <p class="text-xs text-blue-600">dari 24 SKS</p>
            </div>
        </div>
    </div>

    <!-- Mata Kuliah -->
    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-green-500">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Mata Kuliah</p>
                <p class="text-2xl font-bold text-gray-900" id="total-matkul"><?= count($krs_aktif) ?></p>
                <p class="text-xs text-green-600">mata kuliah</p>
            </div>
        </div>
    </div>

    <!-- Status KRS -->
    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-yellow-500">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Status KRS</p>
                <p class="text-lg font-bold text-gray-900" id="status-krs">
                    <?php if ($krs_status === 'draft'): ?>
                        Draft
                    <?php elseif ($krs_status === 'submitted'): ?>
                        Menunggu Persetujuan
                    <?php else: ?>
                        Disetujui
                    <?php endif; ?>
                </p>
                <p class="text-xs <?= $krs_status === 'draft' ? 'text-yellow-600' : ($krs_status === 'submitted' ? 'text-blue-600' : 'text-green-600') ?>">
                    <?php if ($krs_status === 'draft'): ?>
                        dapat diubah
                    <?php elseif ($krs_status === 'submitted'): ?>
                        menunggu persetujuan
                    <?php else: ?>
                        sudah disetujui
                    <?php endif; ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Sisa Kuota -->
    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-purple-500">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Sisa Kuota</p>
                <p class="text-2xl font-bold text-gray-900" id="sisa-sks"><?= 24 - getTotalSKSKRS($krs_aktif) ?></p>
                <p class="text-xs text-purple-600">SKS tersisa</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Left Column - KRS Aktif -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-800">Mata Kuliah Terpilih</h3>
                <div class="flex items-center space-x-3">
                    <button onclick="printKRS()" class="inline-flex items-center px-3 py-2 border border-blue-600 rounded-md shadow-sm text-sm font-medium text-blue-600 bg-white hover:bg-blue-50 hover:border-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak KRS
                    </button>
                    <button onclick="clearAllKRS()" <?= !$can_input_krs ? 'disabled' : '' ?> class="inline-flex items-center px-3 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium <?= !$can_input_krs ? 'text-gray-400 bg-gray-100 cursor-not-allowed' : 'text-red-700 bg-white hover:bg-red-50' ?>">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Semua
                    </button>
                    <button onclick="submitKRS()" <?= !$can_input_krs ? 'disabled' : '' ?> class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white <?= !$can_input_krs ? 'bg-green-400 cursor-not-allowed' : 'bg-green-600 hover:bg-green-700' ?>">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Ajukan KRS
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200" id="krs-tbody">
                        <?php if (!empty($krs_aktif)): ?>
                            <?php foreach ($krs_aktif as $krs): ?>
                                <tr class="hover:bg-gray-50" data-jadwal-id="<?= $krs['id_jadwal'] ?>">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?= $krs['kode_mata_kuliah'] ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900"><?= $krs['nama_mata_kuliah'] ?></div>
                                        <div class="text-sm text-gray-500"><?= $krs['nama_ruangan'] ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= $krs['nama_dosen'] ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?= $krs['hari'] ?>, <?= $krs['jam'] ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <?= $krs['sks'] ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button onclick="removeFromKRS(<?= $krs['id_jadwal'] ?>)" <?= !$can_input_krs ? 'disabled' : '' ?> class="<?= !$can_input_krs ? 'text-gray-400 cursor-not-allowed' : 'text-red-600 hover:text-red-900' ?>">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr id="empty-krs-row">
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada mata kuliah yang dipilih
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Right Column - Mata Kuliah Tersedia -->
    <div class="space-y-6">
        <!-- Search & Filter -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Cari Mata Kuliah</h3>

            <div class="space-y-4">
                <div>
                    <input type="text" id="search-matkul" placeholder="Cari mata kuliah..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <select id="filter-hari" class="w-full appearance-none bg-white border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Hari</option>
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Mata Kuliah Tersedia -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Mata Kuliah Tersedia</h3>

            <div class="space-y-3 max-h-96 overflow-y-auto" id="matkul-list">
                <?php if (!empty($mata_kuliah_tersedia)): ?>
                    <?php foreach ($mata_kuliah_tersedia as $matkul): ?>
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 hover:shadow-md transition-all matkul-card"
                            data-jadwal-id="<?= $matkul['id'] ?>"
                            data-matkul="<?= strtolower($matkul['nama_mata_kuliah']) ?>"
                            data-hari="<?= strtolower($matkul['hari']) ?>"
                            data-sks="<?= $matkul['sks'] ?>">

                            <div class="flex items-start justify-between mb-2">
                                <div class="flex-1">
                                    <h4 class="font-medium text-gray-900 text-sm"><?= $matkul['nama_mata_kuliah'] ?></h4>
                                    <p class="text-xs text-gray-600"><?= $matkul['kode_mata_kuliah'] ?></p>
                                </div>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <?= $matkul['sks'] ?> SKS
                                </span>
                            </div>

                            <div class="text-xs text-gray-500 mb-2">
                                <div class="flex items-center mb-1">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <?= $matkul['nama_dosen'] ?>
                                </div>
                                <div class="flex items-center mb-1">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <?= $matkul['hari'] ?>, <?= $matkul['jam'] ?>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <?= $matkul['nama_ruangan'] ?>
                                </div>
                            </div>

                            <button onclick="addToKRS(<?= $matkul['id'] ?>)" <?= !$can_input_krs ? 'disabled' : '' ?> class="w-full mt-3 inline-flex items-center justify-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white <?= !$can_input_krs ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700' ?> focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= !$can_input_krs ? 'M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636' : 'M12 6v6m0 0v6m0-6h6m-6 0H6' ?>"></path>
                                </svg>
                                <?= !$can_input_krs ? 'Tidak Dapat Ditambah' : 'Tambah ke KRS' ?>
                            </button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada mata kuliah</h3>
                        <p class="mt-1 text-sm text-gray-500">Mata kuliah belum tersedia untuk semester ini.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
function getTotalSKSKRS($krs)
{
    $total = 0;
    foreach ($krs as $item) {
        $total += $item['sks'];
    }
    return $total;
}
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search and filter functionality
        const searchMatkul = document.getElementById('search-matkul');
        const filterHari = document.getElementById('filter-hari');

        function filterMataKuliah() {
            const searchTerm = searchMatkul.value.toLowerCase();
            const selectedHari = filterHari.value.toLowerCase();

            const matkulCards = document.querySelectorAll('.matkul-card');
            matkulCards.forEach(card => {
                const matkul = card.dataset.matkul;
                const hari = card.dataset.hari;

                const matchesSearch = !searchTerm || matkul.includes(searchTerm);
                const matchesHari = !selectedHari || hari === selectedHari;

                card.style.display = (matchesSearch && matchesHari) ? 'block' : 'none';
            });
        }

        searchMatkul.addEventListener('input', filterMataKuliah);
        filterHari.addEventListener('change', filterMataKuliah);

        // Check for schedule conflicts and highlight
        checkScheduleConflicts();
    });

    function checkScheduleConflicts() {
        // Get all KRS schedules
        const krsRows = document.querySelectorAll('#krs-tbody tr[data-jadwal-id]');
        const krsSchedules = [];

        krsRows.forEach(row => {
            const cells = row.querySelectorAll('td');
            if (cells.length >= 4) {
                const jadwalText = cells[3].textContent.trim();
                const parts = jadwalText.split(',');
                if (parts.length === 2) {
                    krsSchedules.push({
                        hari: parts[0].trim().toLowerCase(),
                        jam: parts[1].trim()
                    });
                }
            }
        });

        // Check available mata kuliah for conflicts
        const matkulCards = document.querySelectorAll('.matkul-card');
        matkulCards.forEach(card => {
            const hari = card.dataset.hari;
            const jadwalText = card.querySelector('.text-xs.text-gray-500 div:nth-child(2)');

            if (jadwalText) {
                const jamMatch = jadwalText.textContent.match(/\d{2}:\d{2}-\d{2}:\d{2}/);
                if (jamMatch) {
                    const jam = jamMatch[0];

                    // Check if conflicts with any KRS schedule
                    const hasConflict = krsSchedules.some(schedule => {
                        return schedule.hari === hari && isTimeOverlap(schedule.jam, jam);
                    });

                    if (hasConflict) {
                        card.classList.remove('border-gray-200', 'hover:border-blue-300');
                        card.classList.add('border-blue-300', 'bg-blue-50');
                        const button = card.querySelector('button');
                        button.disabled = true;
                        button.classList.remove('bg-blue-600', 'hover:bg-blue-700', 'text-white');
                        button.classList.add('bg-blue-600', 'text-white', 'cursor-not-allowed');
                        button.innerHTML = '<svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>Bentrok Jadwal';
                    }
                }
            }
        });
    }

    function isTimeOverlap(time1, time2) {
        const parts1 = time1.split('-');
        const parts2 = time2.split('-');

        if (parts1.length !== 2 || parts2.length !== 2) {
            return false;
        }

        const start1 = parts1[0].trim();
        const end1 = parts1[1].trim();
        const start2 = parts2[0].trim();
        const end2 = parts2[1].trim();

        // Simple string comparison (works for HH:MM format)
        return (start1 < end2 && end1 > start2);
    }

    function addToKRS(jadwalId) {
        const card = document.querySelector(`.matkul-card[data-jadwal-id="${jadwalId}"]`);
        const sks = parseInt(card.dataset.sks);
        const currentSKS = parseInt(document.getElementById('total-sks').textContent);

        // Check if already in KRS
        const existingRow = document.querySelector(`#krs-tbody tr[data-jadwal-id="${jadwalId}"]`);
        if (existingRow) {
            window.toast.warning('Mata kuliah ini sudah ada dalam KRS Anda', 3000);
            return;
        }

        // Check SKS limit
        if (currentSKS + sks > 24) {
            window.toast.error(`Tidak dapat menambahkan! Total SKS akan menjadi ${currentSKS + sks} (maksimal 24 SKS)`, 4000);
            return;
        }

        // Disable button temporarily
        const button = card.querySelector('button');
        const originalText = button.innerHTML;
        button.disabled = true;
        button.innerHTML = '<svg class="animate-spin w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Menambahkan...';

        // Show loading
        const loadingToast = window.toast.info('Menambahkan mata kuliah ke KRS...', 5000);

        // Send AJAX request
        fetch('<?= base_url('mahasiswa/krs/add') ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    jadwal_id: jadwalId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (loadingToast && loadingToast.parentElement) {
                    loadingToast.remove();
                }

                if (data.success) {
                    window.toast.success(data.message, 2000);

                    // Reload page to update data
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    window.toast.error(data.message, 4000);
                    // Re-enable button
                    button.disabled = false;
                    button.innerHTML = originalText;
                }
            })
            .catch(error => {
                if (loadingToast && loadingToast.parentElement) {
                    loadingToast.remove();
                }
                console.error('Error:', error);
                window.toast.error('Terjadi kesalahan saat menambahkan mata kuliah', 4000);
                // Re-enable button
                button.disabled = false;
                button.innerHTML = originalText;
            });
    }

    async function removeFromKRS(jadwalId) {
        const confirmed = await window.confirmDialog({
            title: 'Hapus Mata Kuliah',
            cancelText: 'Batal',
            message: 'Apakah Anda yakin ingin menghapus mata kuliah ini dari KRS?',
            cancelText: 'Batal',
            confirmText: 'Hapus',
            type: 'danger',
            confirmClass: 'confirm-btn-danger'
        });

        if (!confirmed) {
            return;
        }

        // Show loading
        const loadingToast = window.toast.info('Menghapus mata kuliah dari KRS...', 5000);

        // Send AJAX request
        fetch('<?= base_url('mahasiswa/krs/remove') ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    jadwal_id: jadwalId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (loadingToast && loadingToast.parentElement) {
                    loadingToast.remove();
                }

                if (data.success) {
                    window.toast.success(data.message, 2000);

                    // Reload page to update data
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    window.toast.error(data.message, 4000);
                }
            })
            .catch(error => {
                if (loadingToast && loadingToast.parentElement) {
                    loadingToast.remove();
                }
                console.error('Error:', error);
                window.toast.error('Terjadi kesalahan saat menghapus mata kuliah', 4000);
            });
    }

    async function clearAllKRS() {
        const confirmed = await window.confirmDialog({
            title: 'Hapus Semua Mata Kuliah',
            message: 'Apakah Anda yakin ingin menghapus SEMUA mata kuliah dari KRS? Tindakan ini tidak dapat dibatalkan.',
            confirmText: 'Hapus Semua',
            cancelText: 'Batal',
            type: 'danger',
            confirmClass: 'confirm-btn-danger'
        });

        if (!confirmed) {
            return;
        }

        const rows = document.querySelectorAll('#krs-tbody tr[data-jadwal-id]');

        if (rows.length === 0) {
            window.toast.warning('KRS Anda sudah kosong', 2000);
            return;
        }

        // Show loading
        const loadingToast = window.toast.info('Menghapus semua mata kuliah dari KRS...', 5000);

        // Collect all jadwal IDs
        const jadwalIds = Array.from(rows).map(row => row.dataset.jadwalId);

        // Send multiple delete requests
        Promise.all(jadwalIds.map(jadwalId =>
                fetch('<?= base_url('mahasiswa/krs/remove') ?>', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        jadwal_id: jadwalId
                    })
                }).then(r => r.json())
            ))
            .then(results => {
                if (loadingToast && loadingToast.parentElement) {
                    loadingToast.remove();
                }

                const successCount = results.filter(r => r.success).length;

                if (successCount > 0) {
                    window.toast.success(`Berhasil menghapus ${successCount} mata kuliah dari KRS`, 2000);

                    // Reload page
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    window.toast.error('Gagal menghapus mata kuliah', 3000);
                }
            })
            .catch(error => {
                if (loadingToast && loadingToast.parentElement) {
                    loadingToast.remove();
                }
                console.error('Error:', error);
                window.toast.error('Terjadi kesalahan saat menghapus mata kuliah', 3000);
            });
    }

    function updateKRSCounters() {
        const rows = document.querySelectorAll('#krs-tbody tr[data-jadwal-id]');
        let totalSKS = 0;

        rows.forEach(row => {
            const sksElement = row.querySelector('.bg-blue-100');
            if (sksElement) {
                totalSKS += parseInt(sksElement.textContent);
            }
        });

        document.getElementById('total-sks').textContent = totalSKS;
        document.getElementById('total-matkul').textContent = rows.length;
        document.getElementById('sisa-sks').textContent = 24 - totalSKS;
    }

    async function submitKRS() {
        const rows = document.querySelectorAll('#krs-tbody tr[data-jadwal-id]');

        if (rows.length === 0) {
            window.toast.warning('Belum ada mata kuliah yang dipilih untuk diajukan', 3000);
            return;
        }

        const totalSKS = parseInt(document.getElementById('total-sks').textContent);

        if (totalSKS < 12) {
            const confirmed = await window.confirmDialog({
                title: 'SKS Kurang dari Minimal',
                message: `Total SKS Anda hanya ${totalSKS} SKS (minimal 12 SKS). Apakah Anda yakin ingin mengajukan KRS?`,
                confirmText: 'Ya, Ajukan',
                cancelText: 'Batal',
                type: 'warning'
            });

            if (!confirmed) {
                return;
            }
        }

        const finalConfirm = await window.confirmDialog({
            title: 'Ajukan KRS',
            message: 'Apakah Anda yakin ingin mengajukan KRS untuk disetujui? Setelah diajukan, KRS tidak dapat diubah.',
            confirmText: 'Ya, Ajukan',
            cancelText: 'Batal',
            type: 'warning'
        });

        if (!finalConfirm) {
            return;
        }

        const loadingToast = window.toast.info('Mengajukan KRS untuk persetujuan...', 5000);

        // Send AJAX request
        fetch('<?= base_url('mahasiswa/krs/submit') ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    total_sks: totalSKS,
                    total_matkul: rows.length
                })
            })
            .then(response => {
                // Check if response is OK
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                return response.json();
            })
            .then(data => {
                if (loadingToast && loadingToast.parentElement) {
                    loadingToast.remove();
                }

                if (data && data.success) {
                    window.toast.success(data.message, 3000);

                    // Update status
                    const statusElement = document.getElementById('status-krs');
                    if (statusElement) {
                        statusElement.textContent = 'Menunggu Persetujuan';
                    }

                    // Disable buttons
                    document.querySelectorAll('button[onclick^="addToKRS"]').forEach(btn => {
                        btn.disabled = true;
                        btn.classList.add('opacity-50', 'cursor-not-allowed');
                    });

                    document.querySelectorAll('button[onclick^="removeFromKRS"]').forEach(btn => {
                        btn.disabled = true;
                        btn.classList.add('opacity-50', 'cursor-not-allowed');
                    });

                    const clearBtn = document.querySelector('button[onclick="clearAllKRS()"]');
                    const submitBtn = document.querySelector('button[onclick="submitKRS()"]');
                    if (clearBtn) clearBtn.disabled = true;
                    if (submitBtn) submitBtn.disabled = true;
                } else {
                    window.toast.error(data && data.message ? data.message : 'Gagal mengajukan KRS', 4000);
                }
            })
            .catch(error => {
                if (loadingToast && loadingToast.parentElement) {
                    loadingToast.remove();
                }
                console.error('Submit KRS Error:', error);
                console.error('Error details:', error.message);
                window.toast.error('Terjadi kesalahan saat mengajukan KRS. Silakan coba lagi.', 4000);
            });
    }

    function printKRS() {
        const rows = document.querySelectorAll('#krs-tbody tr[data-jadwal-id]');

        if (rows.length === 0) {
            window.toast.warning('Belum ada mata kuliah untuk dicetak', 3000);
            return;
        }

        // Open print window
        window.open('<?= base_url('mahasiswa/krs/print') ?>', '_blank');
        window.toast.info('Membuka halaman cetak KRS...', 2000);
    }
</script>
<?= $this->endSection() ?>