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
    <nav class="bg-yellow-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h1 class="text-xl font-bold">SIPAKU - Dosen</h1>
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
                <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800"><?= esc($dosen['nama']) ?></h2>
                    <p class="text-gray-600">NIDN: <?= esc($dosen['nidn']) ?></p>
                    <p class="text-sm text-gray-500">Dosen</p>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Jadwal</p>
                        <p class="text-2xl font-semibold text-gray-900"><?= $totalJadwal ?></p>
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
                        <p class="text-sm font-medium text-gray-600">Mata Kuliah</p>
                        <p class="text-2xl font-semibold text-gray-900"><?= count($mataKuliah) ?></p>
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
                    <div class="border-l-4 border-yellow-400 pl-4 py-2">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="font-semibold text-gray-900"><?= esc($jadwal['nama_mata_kuliah']) ?></h4>
                                <p class="text-sm text-gray-600">Ruangan: <?= esc($jadwal['nama_ruangan']) ?></p>
                            </div>
                            <span class="text-sm font-medium text-yellow-600"><?= esc($jadwal['jam']) ?></span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Mata Kuliah yang Diampu -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Mata Kuliah yang Diampu</h3>
            </div>
            <div class="p-6">
                <?php if (!empty($mataKuliah)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <?php foreach ($mataKuliah as $mk): ?>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-semibold text-gray-900"><?= esc($mk['nama_mata_kuliah']) ?></h4>
                        <p class="text-sm text-gray-600">Kode: <?= esc($mk['kode_mata_kuliah']) ?></p>
                        <p class="text-sm text-gray-600">SKS: <?= esc($mk['sks']) ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <p class="text-gray-500 text-center py-8">Belum ada mata kuliah yang diampu</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>