<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | SIPAKU</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
</head>
<body class="bg-gray-100">
    <!-- Navigation -->
    <nav class="bg-green-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h1 class="text-xl font-bold">SIPAKU - Mahasiswa</h1>
            </div>
            <div class="flex items-center space-x-4">
                <span>Selamat datang, <?= session()->get('nama_user') ?></span>
                <a href="<?= base_url('logout') ?>" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto mt-8 px-4">
        <!-- Profile Section -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800"><?= esc($mahasiswa['nama']) ?></h2>
                    <p class="text-gray-600">NIM: <?= esc($mahasiswa['nim']) ?></p>
                    <p class="text-sm text-gray-500">Mahasiswa</p>
                </div>
            </div>
        </div>

        <!-- Academic Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">IPK</p>
                        <p class="text-2xl font-semibold text-gray-900"><?= number_format($ipk, 2) ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total SKS</p>
                        <p class="text-2xl font-semibold text-gray-900"><?= $totalSKS ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Jadwal Hari Ini</p>
                        <p class="text-2xl font-semibold text-gray-900"><?= count($jadwalHariIni) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Today's Schedule -->
        <?php if (!empty($jadwalHariIni)): ?>
        <div class="bg-white rounded-lg shadow mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Jadwal Hari Ini</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <?php foreach ($jadwalHariIni as $jadwal): ?>
                    <div class="border-l-4 border-green-400 pl-4 py-2">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-semibold text-gray-900"><?= esc($jadwal['nama_mata_kuliah']) ?></h4>
                                <p class="text-sm text-gray-600">Dosen: <?= esc($jadwal['nama_dosen']) ?></p>
                                <p class="text-sm text-gray-600">Ruangan: <?= esc($jadwal['nama_ruangan']) ?></p>
                            </div>
                            <span class="text-sm font-medium text-green-600"><?= esc($jadwal['jam']) ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Rencana Studi -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Rencana Studi Aktif</h3>
            </div>
            <div class="p-6">
                <?php if (!empty($rencanaStudi)): ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($rencanaStudi as $rs): ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?= esc($rs['nama_mata_kuliah']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= esc($rs['kode_mata_kuliah']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= esc($rs['sks']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= esc($rs['nama_dosen']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= esc($rs['hari']) ?>, <?= esc($rs['jam']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= esc($rs['nama_ruangan']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php if ($rs['nilai_angka']): ?>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            <?= $rs['nilai_angka'] >= 80 ? 'bg-green-100 text-green-800' : 
                                               ($rs['nilai_angka'] >= 70 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') ?>">
                                            <?= $rs['nilai_angka'] ?> (<?= $rs['nilai_huruf'] ?>)
                                        </span>
                                    <?php else: ?>
                                        <span class="text-gray-400">Belum ada</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                <p class="text-gray-500 text-center py-8">Belum ada rencana studi yang terdaftar</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>