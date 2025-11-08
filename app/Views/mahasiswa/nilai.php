<?= $this->extend('layout/mahasiswa/main') ?>

<?= $this->section('content') ?>
<!-- Header -->
<div class="mb-6 sm:mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Nilai & Transkrip</h1>
            <p class="text-sm sm:text-base text-gray-600">
                Lihat nilai dan transkrip akademik - NIM: <span class="font-medium text-blue-600"><?= session('kode') ?? '-' ?></span>
            </p>
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

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- IPK -->
    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-blue-500">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">IPK</p>
                <p class="text-2xl font-bold text-gray-900"><?= number_format($ipk, 2) ?></p>
                <p class="text-xs text-blue-600"><?= getPredikatIPK($ipk) ?></p>
            </div>
        </div>
    </div>

    <!-- Total SKS -->
    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-green-500">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Total SKS Lulus</p>
                <p class="text-2xl font-bold text-gray-900"><?= $total_sks ?></p>
                <p class="text-xs text-green-600">dari 144 SKS</p>
            </div>
        </div>
    </div>

    <!-- Mata Kuliah Lulus -->
    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-yellow-500">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-500">Mata Kuliah Lulus</p>
                <p class="text-2xl font-bold text-gray-900"><?= count($transkrip) ?></p>
                <p class="text-xs text-yellow-600">mata kuliah</p>
            </div>
        </div>
    </div>

    <!-- Progress Studi -->
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
                <p class="text-sm font-medium text-gray-500">Progress Studi</p>
                <p class="text-2xl font-bold text-gray-900"><?= round(($total_sks / 144) * 100) ?>%</p>
                <p class="text-xs text-purple-600">dari total SKS</p>
            </div>
        </div>
    </div>
</div>

<!-- Tabs Navigation -->
<div class="bg-white rounded-lg shadow-lg mb-6">
    <div class="border-b border-gray-200">
        <nav class="-mb-px flex space-x-8 px-6" aria-label="Tabs">
            <button onclick="switchTab('rencana-studi')" id="tab-rencana-studi" class="tab-button active border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Rencana Studi
            </button>
            <button onclick="switchTab('transkrip')" id="tab-transkrip" class="tab-button border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                Transkrip Nilai
            </button>
        </nav>
    </div>

    <!-- Rencana Studi Tab -->
    <div id="content-rencana-studi" class="tab-content p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Rencana Studi Semester Aktif</h3>
            <div class="flex items-center space-x-3">
                <input type="text" id="search-rencana" placeholder="Cari mata kuliah..." class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button onclick="exportRencanaStudi()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Angka</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Huruf</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="rencana-studi-tbody">
                    <?php if (!empty($rencana_studi)): ?>
                        <?php foreach ($rencana_studi as $rs): ?>
                            <tr class="hover:bg-gray-50 rencana-row" data-matkul="<?= strtolower($rs['nama_mata_kuliah']) ?>">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= $rs['kode_mata_kuliah'] ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?= $rs['nama_mata_kuliah'] ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= $rs['nama_dosen'] ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <?= $rs['sks'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= $rs['nilai_angka'] ?? '-' ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($rs['nilai_huruf']): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= getNilaiClass($rs['nilai_huruf']) ?>">
                                            <?= $rs['nilai_huruf'] ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-gray-400">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if ($rs['nilai_huruf']): ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= getStatusClass($rs['nilai_huruf']) ?>">
                                            <?= getStatusText($rs['nilai_huruf']) ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Belum Dinilai
                                        </span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada mata kuliah dalam rencana studi
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Transkrip Tab -->
    <div id="content-transkrip" class="tab-content p-6 hidden">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-800">Transkrip Nilai Akademik</h3>
            <div class="flex items-center space-x-3">
                <input type="text" id="search-transkrip" placeholder="Cari mata kuliah..." class="px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <button onclick="exportTranskrip()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export PDF
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Angka</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Huruf</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mutu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="transkrip-tbody">
                    <?php if (!empty($transkrip)): ?>
                        <?php foreach ($transkrip as $tr): ?>
                            <tr class="hover:bg-gray-50 transkrip-row" data-matkul="<?= strtolower($tr['nama_mata_kuliah']) ?>">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= $tr['kode_mata_kuliah'] ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900"><?= $tr['nama_mata_kuliah'] ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <?= $tr['sks'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= $tr['nilai_angka'] ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= getNilaiClass($tr['nilai_huruf']) ?>">
                                        <?= $tr['nilai_huruf'] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?= getNilaiMutu($tr['nilai_huruf']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= getStatusClass($tr['nilai_huruf']) ?>">
                                        <?= getStatusText($tr['nilai_huruf']) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Belum ada nilai yang tersedia
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Summary Footer -->
        <?php if (!empty($transkrip)): ?>
            <div class="mt-6 bg-gray-50 rounded-lg p-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="text-sm text-gray-500">Total SKS Lulus</p>
                        <p class="text-lg font-semibold text-gray-900"><?= $total_sks ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">IPK</p>
                        <p class="text-lg font-semibold text-gray-900"><?= number_format($ipk, 2) ?></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Predikat</p>
                        <p class="text-lg font-semibold text-gray-900"><?= getPredikatIPK($ipk) ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
// Helper functions
function getNilaiClass($nilai) {
    switch ($nilai) {
        case 'A':
        case 'A-':
            return 'bg-green-100 text-green-800';
        case 'B+':
        case 'B':
        case 'B-':
            return 'bg-blue-100 text-blue-800';
        case 'C+':
        case 'C':
        case 'C-':
            return 'bg-yellow-100 text-yellow-800';
        case 'D+':
        case 'D':
            return 'bg-orange-100 text-orange-800';
        case 'E':
            return 'bg-red-100 text-red-800';
        default:
            return 'bg-gray-100 text-gray-800';
    }
}

function getStatusClass($nilai) {
    return in_array($nilai, ['A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D']) 
        ? 'bg-green-100 text-green-800' 
        : 'bg-red-100 text-red-800';
}

function getStatusText($nilai) {
    return in_array($nilai, ['A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D']) 
        ? 'Lulus' 
        : 'Tidak Lulus';
}

function getNilaiMutu($nilai) {
    $mutu = [
        'A' => '4.00',
        'A-' => '3.50',
        'B+' => '3.25',
        'B' => '3.00',
        'B-' => '2.75',
        'C+' => '2.25',
        'C' => '2.00',
        'C-' => '1.75',
        'D+' => '1.25',
        'D' => '1.00',
        'E' => '0.00'
    ];
    return $mutu[$nilai] ?? '0.00';
}

function getPredikatIPK($ipk) {
    if ($ipk >= 3.51) return 'Cum Laude';
    if ($ipk >= 3.01) return 'Sangat Memuaskan';
    if ($ipk >= 2.76) return 'Memuaskan';
    if ($ipk >= 2.00) return 'Cukup';
    return 'Kurang';
}
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality
        const searchRencana = document.getElementById('search-rencana');
        const searchTranskrip = document.getElementById('search-transkrip');
        
        function filterTable(searchInput, tableBodyId, rowClass) {
            const searchTerm = searchInput.value.toLowerCase();
            const rows = document.querySelectorAll(`.${rowClass}`);
            
            rows.forEach(row => {
                const matkul = row.dataset.matkul;
                const matches = !searchTerm || matkul.includes(searchTerm);
                row.style.display = matches ? 'table-row' : 'none';
            });
        }
        
        searchRencana.addEventListener('input', () => {
            filterTable(searchRencana, 'rencana-studi-tbody', 'rencana-row');
        });
        
        searchTranskrip.addEventListener('input', () => {
            filterTable(searchTranskrip, 'transkrip-tbody', 'transkrip-row');
        });
    });
    
    function switchTab(tabName) {
        // Hide all tab contents
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(content => content.classList.add('hidden'));
        
        // Remove active class from all tab buttons
        const tabButtons = document.querySelectorAll('.tab-button');
        tabButtons.forEach(button => {
            button.classList.remove('active', 'border-blue-500', 'text-blue-600');
            button.classList.add('border-transparent', 'text-gray-500');
        });
        
        // Show selected tab content
        document.getElementById(`content-${tabName}`).classList.remove('hidden');
        
        // Add active class to selected tab button
        const activeButton = document.getElementById(`tab-${tabName}`);
        activeButton.classList.add('active', 'border-blue-500', 'text-blue-600');
        activeButton.classList.remove('border-transparent', 'text-gray-500');
    }
    
    function exportRencanaStudi() {
        window.toast.info('🚧 Fitur export rencana studi sedang dalam pengembangan', 3000);
    }
    
    function exportTranskrip() {
        window.toast.info('🚧 Fitur export transkrip PDF sedang dalam pengembangan', 3000);
    }
</script>
<?= $this->endSection() ?>