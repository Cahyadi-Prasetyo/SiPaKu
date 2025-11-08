<?= $this->extend('layout/mahasiswa/main') ?>

<?= $this->section('content') ?>
<!-- Header -->
<div class="mb-6 sm:mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Keterangan Nilai</h1>
            <p class="text-sm sm:text-base text-gray-600">
                Panduan sistem penilaian dan perhitungan IPK
            </p>
        </div>
    </div>
</div>

<!-- Konversi Nilai -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
        </svg>
        Konversi Nilai Huruf ke Bobot
    </h2>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Huruf</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bobot</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rentang Nilai</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <tr class="bg-green-50">
                    <td class="px-6 py-4 whitespace-nowrap"><span class="text-lg font-bold text-green-700">A</span></td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="font-semibold text-green-700">4.00</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">85 - 100</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">Sangat Memuaskan</td>
                </tr>
                <tr class="bg-green-50">
                    <td class="px-6 py-4 whitespace-nowrap"><span class="text-lg font-bold text-green-600">A-</span></td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="font-semibold text-green-600">3.50</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">80 - 84</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">Sangat Memuaskan</td>
                </tr>
                <tr class="bg-blue-50">
                    <td class="px-6 py-4 whitespace-nowrap"><span class="text-lg font-bold text-blue-700">B+</span></td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="font-semibold text-blue-700">3.25</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">75 - 79</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">Memuaskan</td>
                </tr>
                <tr class="bg-blue-50">
                    <td class="px-6 py-4 whitespace-nowrap"><span class="text-lg font-bold text-blue-600">B</span></td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="font-semibold text-blue-600">3.00</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">70 - 74</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">Memuaskan</td>
                </tr>
                <tr class="bg-blue-50">
                    <td class="px-6 py-4 whitespace-nowrap"><span class="text-lg font-bold text-blue-500">B-</span></td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="font-semibold text-blue-500">2.75</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">65 - 69</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">Memuaskan</td>
                </tr>
                <tr class="bg-yellow-50">
                    <td class="px-6 py-4 whitespace-nowrap"><span class="text-lg font-bold text-yellow-700">C+</span></td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="font-semibold text-yellow-700">2.25</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">60 - 64</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">Cukup</td>
                </tr>
                <tr class="bg-yellow-50">
                    <td class="px-6 py-4 whitespace-nowrap"><span class="text-lg font-bold text-yellow-600">C</span></td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="font-semibold text-yellow-600">2.00</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">55 - 59</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">Cukup</td>
                </tr>
                <tr class="bg-yellow-50">
                    <td class="px-6 py-4 whitespace-nowrap"><span class="text-lg font-bold text-yellow-500">C-</span></td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="font-semibold text-yellow-500">1.75</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">50 - 54</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">Cukup</td>
                </tr>
                <tr class="bg-orange-50">
                    <td class="px-6 py-4 whitespace-nowrap"><span class="text-lg font-bold text-orange-600">D+</span></td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="font-semibold text-orange-600">1.25</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">45 - 49</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">Kurang</td>
                </tr>
                <tr class="bg-orange-50">
                    <td class="px-6 py-4 whitespace-nowrap"><span class="text-lg font-bold text-orange-500">D</span></td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="font-semibold text-orange-500">1.00</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">40 - 44</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">Kurang</td>
                </tr>
                <tr class="bg-red-50">
                    <td class="px-6 py-4 whitespace-nowrap"><span class="text-lg font-bold text-red-600">E</span></td>
                    <td class="px-6 py-4 whitespace-nowrap"><span class="font-semibold text-red-600">0.00</span></td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">0 - 39</td>
                    <td class="px-6 py-4 whitespace-nowrap text-red-600 font-semibold">Tidak Lulus</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Predikat IPK -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
        </svg>
        Predikat IPK (Indeks Prestasi Kumulatif)
    </h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="border-l-4 border-yellow-500 bg-yellow-50 p-4 rounded-r-lg">
            <div class="flex items-center mb-2">
                <span class="text-3xl mr-3">🏆</span>
                <div>
                    <h3 class="font-bold text-yellow-800">Dengan Pujian</h3>
                    <p class="text-sm text-yellow-700">(Cum Laude)</p>
                </div>
            </div>
            <p class="text-2xl font-bold text-yellow-800">3.51 - 4.00</p>
        </div>
        
        <div class="border-l-4 border-green-500 bg-green-50 p-4 rounded-r-lg">
            <div class="flex items-center mb-2">
                <span class="text-3xl mr-3">⭐</span>
                <div>
                    <h3 class="font-bold text-green-800">Sangat Memuaskan</h3>
                    <p class="text-sm text-green-700">Prestasi Tinggi</p>
                </div>
            </div>
            <p class="text-2xl font-bold text-green-800">3.01 - 3.50</p>
        </div>
        
        <div class="border-l-4 border-blue-500 bg-blue-50 p-4 rounded-r-lg">
            <div class="flex items-center mb-2">
                <span class="text-3xl mr-3">✨</span>
                <div>
                    <h3 class="font-bold text-blue-800">Memuaskan</h3>
                    <p class="text-sm text-blue-700">Prestasi Baik</p>
                </div>
            </div>
            <p class="text-2xl font-bold text-blue-800">2.76 - 3.00</p>
        </div>
        
        <div class="border-l-4 border-gray-500 bg-gray-50 p-4 rounded-r-lg">
            <div class="flex items-center mb-2">
                <span class="text-3xl mr-3">✓</span>
                <div>
                    <h3 class="font-bold text-gray-800">Cukup</h3>
                    <p class="text-sm text-gray-700">Lulus Standar</p>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-800">2.00 - 2.75</p>
        </div>
        
        <div class="border-l-4 border-red-500 bg-red-50 p-4 rounded-r-lg">
            <div class="flex items-center mb-2">
                <span class="text-3xl mr-3">⚠️</span>
                <div>
                    <h3 class="font-bold text-red-800">Kurang</h3>
                    <p class="text-sm text-red-700">Tidak Memenuhi Syarat</p>
                </div>
            </div>
            <p class="text-2xl font-bold text-red-800">< 2.00</p>
        </div>
    </div>
</div>

<!-- Rumus Perhitungan -->
<div class="bg-white rounded-lg shadow-lg p-6">
    <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
        </svg>
        Rumus Perhitungan
    </h2>
    
    <div class="space-y-6">
        <!-- Nilai Mutu -->
        <div class="bg-blue-50 p-4 rounded-lg">
            <h3 class="font-semibold text-blue-900 mb-2">1. Nilai Mutu (NM)</h3>
            <div class="bg-white p-3 rounded border-2 border-blue-200">
                <p class="text-center text-lg font-mono">Nilai Mutu = Bobot × SKS</p>
            </div>
            <p class="text-sm text-gray-600 mt-2">
                <strong>Contoh:</strong> Mata Kuliah Pemrograman Web (3 SKS) dengan nilai A (4.00)<br>
                Nilai Mutu = 4.00 × 3 = <strong>12.00</strong>
            </p>
        </div>
        
        <!-- IPS -->
        <div class="bg-green-50 p-4 rounded-lg">
            <h3 class="font-semibold text-green-900 mb-2">2. Indeks Prestasi Semester (IPS)</h3>
            <div class="bg-white p-3 rounded border-2 border-green-200">
                <p class="text-center text-lg font-mono">IPS = Total Nilai Mutu / Total SKS</p>
            </div>
            <p class="text-sm text-gray-600 mt-2">
                <strong>Contoh:</strong> Total Nilai Mutu = 28.00, Total SKS = 8<br>
                IPS = 28.00 / 8 = <strong>3.50</strong> (Sangat Memuaskan)
            </p>
        </div>
        
        <!-- IPK -->
        <div class="bg-yellow-50 p-4 rounded-lg">
            <h3 class="font-semibold text-yellow-900 mb-2">3. Indeks Prestasi Kumulatif (IPK)</h3>
            <div class="bg-white p-3 rounded border-2 border-yellow-200">
                <p class="text-center text-lg font-mono">IPK = Total NM Semua Semester / Total SKS Semua Semester</p>
            </div>
            <p class="text-sm text-gray-600 mt-2">
                <strong>Contoh:</strong> Total NM = 112.00, Total SKS = 32<br>
                IPK = 112.00 / 32 = <strong>3.50</strong> (Sangat Memuaskan)
            </p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
