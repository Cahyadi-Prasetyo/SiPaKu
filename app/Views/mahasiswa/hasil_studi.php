<?= $this->extend('layout/mahasiswa/main') ?>

<?= $this->section('content') ?>

<!-- Tabel Hasil Studi -->
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
        <h3 class="text-lg font-semibold text-gray-800">Daftar Hasil Studi</h3>
        <p class="text-sm text-gray-600 mt-1">Hasil studi dari rencana studi yang telah dibuat</p>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode MK</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Angka</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Huruf</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bobot</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Mutu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($hasil_studi)): ?>
                    <?php 
                    $no = 1;
                    foreach ($hasil_studi as $hs): 
                        $bobot = getNilaiBobot($hs['nilai_huruf']);
                        $nilai_mutu = $bobot * $hs['sks'];
                    ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $no++ ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $hs['kode_mata_kuliah'] ?></td>
                            <td class="px-6 py-4 text-sm text-gray-900"><?= $hs['nama_mata_kuliah'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $hs['sks'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <?= $hs['nilai_angka'] ? number_format($hs['nilai_angka'], 2) : '-' ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= getNilaiHurufClass($hs['nilai_huruf']) ?>">
                                    <?= $hs['nilai_huruf'] ?? '-' ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <?= $hs['nilai_huruf'] ? number_format($bobot, 2) : '-' ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <?= $hs['nilai_huruf'] ? number_format($nilai_mutu, 2) : '-' ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= getStatusLulusClass($hs['nilai_huruf']) ?>">
                                    <?= getStatusLulus($hs['nilai_huruf']) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <!-- Total Row -->
                    <tr class="bg-gray-100 font-semibold">
                        <td colspan="3" class="px-6 py-4 text-sm text-gray-900 text-right">TOTAL</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $total_sks ?? '0' ?></td>
                        <td colspan="2" class="px-6 py-4"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">-</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= number_format($total_nilai_mutu ?? 0, 2) ?></td>
                        <td class="px-6 py-4"></td>
                    </tr>
                    
                    <!-- IPK Row -->
                    <tr class="bg-blue-50 font-bold">
                        <td colspan="3" class="px-6 py-4 text-sm text-gray-900 text-right">IPK (Total Nilai Mutu / Total SKS)</td>
                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-lg text-blue-700">
                            <?= number_format($ipk, 2) ?> / 4.00
                        </td>
                        <td class="px-6 py-4"></td>
                    </tr>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="px-6 py-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada hasil studi</h3>
                            <p class="mt-1 text-sm text-gray-500">Hasil studi akan muncul setelah dosen menginput nilai.</p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Keterangan Nilai -->
<div class="mt-6 bg-white rounded-lg shadow-lg p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Keterangan Nilai</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <h4 class="text-sm font-medium text-gray-700 mb-2">Konversi Nilai Huruf ke Bobot:</h4>
            <div class="space-y-1 text-sm text-gray-600">
                <div class="flex justify-between"><span>A = 4.0</span><span>B+ = 3.25</span><span>C+ = 2.25</span><span>D+ = 1.25</span></div>
                <div class="flex justify-between"><span>A- = 3.5</span><span>B = 3.0</span><span>C = 2.0</span><span>D = 1.0</span></div>
                <div class="flex justify-between"><span></span><span>B- = 2.75</span><span>C- = 1.75</span><span>E = 0.0</span></div>
            </div>
        </div>
        <div>
            <h4 class="text-sm font-medium text-gray-700 mb-2">Predikat IPK:</h4>
            <div class="space-y-1 text-sm text-gray-600">
                <div>3.51 - 4.00 = Dengan Pujian (Cum Laude)</div>
                <div>3.01 - 3.50 = Sangat Memuaskan</div>
                <div>2.76 - 3.00 = Memuaskan</div>
                <div>2.00 - 2.75 = Cukup</div>
                <div>&lt; 2.00 = Kurang</div>
            </div>
        </div>
    </div>
</div>

<?php
// Helper functions
function getNilaiBobot($nilaiHuruf) {
    $bobot = [
        'A' => 4.0, 'A-' => 3.5,
        'B+' => 3.25, 'B' => 3.0, 'B-' => 2.75,
        'C+' => 2.25, 'C' => 2.0, 'C-' => 1.75,
        'D+' => 1.25, 'D' => 1.0,
        'E' => 0.0
    ];
    return $bobot[$nilaiHuruf] ?? 0.0;
}

function getNilaiHurufClass($nilaiHuruf) {
    switch ($nilaiHuruf) {
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

function getStatusLulus($nilaiHuruf) {
    if (!$nilaiHuruf) return 'Belum Dinilai';
    $bobot = getNilaiBobot($nilaiHuruf);
    return $bobot >= 2.0 ? 'Lulus' : 'Tidak Lulus';
}

function getStatusLulusClass($nilaiHuruf) {
    if (!$nilaiHuruf) return 'bg-gray-100 text-gray-800';
    $bobot = getNilaiBobot($nilaiHuruf);
    return $bobot >= 2.0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
}

function getPredikatIPK($ipk) {
    if ($ipk >= 3.51) return 'Dengan Pujian (Cum Laude)';
    if ($ipk >= 3.01) return 'Sangat Memuaskan';
    if ($ipk >= 2.76) return 'Memuaskan';
    if ($ipk >= 2.00) return 'Cukup';
    return 'Kurang';
}
?>

<script>
    // Development toast function
    function showDevelopmentToast(featureName) {
        const message = `🚧 ${featureName} sedang dalam tahap pengembangan dan akan segera tersedia!`;
        if (window.toast) {
            window.toast.info(message, 4000);
        }
    }
</script>
<?= $this->endSection() ?>
