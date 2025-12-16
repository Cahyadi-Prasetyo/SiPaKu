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
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Konversi Nilai Huruf ke Bobot -->
        <div>
            <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Konversi Nilai Huruf ke Bobot
            </h4>
            <div class="grid grid-cols-2 gap-x-6 gap-y-2 text-sm text-gray-700">
                <div class="flex items-center justify-between px-3 py-1.5 bg-green-50 rounded">
                    <span class="font-medium">A</span>
                    <span class="text-gray-600">= 4.00</span>
                </div>
                <div class="flex items-center justify-between px-3 py-1.5 bg-green-50 rounded">
                    <span class="font-medium">A-</span>
                    <span class="text-gray-600">= 3.50</span>
                </div>
                <div class="flex items-center justify-between px-3 py-1.5 bg-blue-50 rounded">
                    <span class="font-medium">B</span>
                    <span class="text-gray-600">= 3.00</span>
                </div>
                <div class="flex items-center justify-between px-3 py-1.5 bg-blue-50 rounded">
                    <span class="font-medium">B-</span>
                    <span class="text-gray-600">= 2.50</span>
                </div>
                <div class="flex items-center justify-between px-3 py-1.5 bg-yellow-50 rounded">
                    <span class="font-medium">C</span>
                    <span class="text-gray-600">= 2.00</span>
                </div>
                <div class="flex items-center justify-between px-3 py-1.5 bg-orange-50 rounded">
                    <span class="font-medium">D</span>
                    <span class="text-gray-600">= 1.00</span>
                </div>
                <div class="flex items-center justify-between px-3 py-1.5 bg-red-50 rounded col-span-2">
                    <span class="font-medium">E</span>
                    <span class="text-gray-600">= 0.00</span>
                </div>
            </div>
        </div>
        
        <!-- Predikat IPK -->
        <div>
            <h4 class="text-sm font-semibold text-gray-700 mb-3 flex items-center">
                <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                Predikat IPK
            </h4>
            <div class="space-y-2 text-sm">
                <div class="flex items-start px-4 py-2.5 bg-purple-50 rounded-lg border-l-4 border-purple-500">
                    <div class="flex-1">
                        <div class="font-semibold text-purple-900">3.51 - 4.00</div>
                        <div class="text-purple-700 text-xs mt-0.5">Dengan Pujian (Cum Laude)</div>
                    </div>
                </div>
                <div class="flex items-start px-4 py-2.5 bg-green-50 rounded-lg border-l-4 border-green-500">
                    <div class="flex-1">
                        <div class="font-semibold text-green-900">3.01 - 3.50</div>
                        <div class="text-green-700 text-xs mt-0.5">Sangat Memuaskan</div>
                    </div>
                </div>
                <div class="flex items-start px-4 py-2.5 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                    <div class="flex-1">
                        <div class="font-semibold text-blue-900">2.76 - 3.00</div>
                        <div class="text-blue-700 text-xs mt-0.5">Memuaskan</div>
                    </div>
                </div>
                <div class="flex items-start px-4 py-2.5 bg-yellow-50 rounded-lg border-l-4 border-yellow-500">
                    <div class="flex-1">
                        <div class="font-semibold text-yellow-900">2.00 - 2.75</div>
                        <div class="text-yellow-700 text-xs mt-0.5">Cukup</div>
                    </div>
                </div>
                <div class="flex items-start px-4 py-2.5 bg-red-50 rounded-lg border-l-4 border-red-500">
                    <div class="flex-1">
                        <div class="font-semibold text-red-900">&lt; 2.00</div>
                        <div class="text-red-700 text-xs mt-0.5">Kurang</div>
                    </div>
                </div>
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
