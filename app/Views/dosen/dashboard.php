<?= $this->extend('layout/dosen/main') ?>

<?= $this->section('content') ?>
<!-- Header -->
<div class="mb-6 sm:mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Dashboard Dosen</h1>
            <p class="text-sm sm:text-base text-gray-600">
                Selamat datang, <span class="font-medium text-green-600"><?= session('nama_user') ?? 'Dosen' ?></span>
            </p>
        </div>
       
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
    <!-- Total Jadwal Mengajar -->
    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-yellow-400">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-800">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Jadwal Mengajar</p>
                <p class="text-2xl font-bold text-gray-900"><?= $stats['total_jadwal'] ?? '0' ?></p>
                <p class="text-xs text-yellow-600 mt-1">Semester ini</p>
            </div>
        </div>
    </div>

    <!-- Nilai Belum Diinput -->
    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-yellow-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-800">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Nilai Pending</p>
                <p class="text-2xl font-bold text-gray-900"><?= $stats['nilai_pending'] ?? '0' ?></p>
                <p class="text-xs text-yellow-600 mt-1">Belum diinput</p>
            </div>
        </div>
    </div>

    <!-- Mata Kuliah -->
    <div class="bg-white rounded-lg shadow-lg p-6 border-l-4 border-purple-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-800">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Mata Kuliah</p>
                <p class="text-2xl font-bold text-gray-900"><?= $stats['total_matkul'] ?? '0' ?></p>
                <p class="text-xs text-purple-600 mt-1">Yang diampu</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Jadwal Hari Ini -->
    <div class="lg:col-span-2 bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Jadwal Mengajar Hari Ini</h3>
            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                <?= date('l, d M Y,H:i') ?>
            </span>
        </div>

        <div class="space-y-4">
            <?php if (!empty($jadwal_hari_ini)): ?>
                <?php foreach ($jadwal_hari_ini as $jadwal): ?>
                    <div class="flex items-center p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-yellow-600 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 flex-1">
                            <h4 class="text-sm font-medium text-gray-900"><?= $jadwal['nama_kelas'] ?></h4>
                            <p class="text-sm text-gray-600"><?= $jadwal['nama_mata_kuliah'] ?> (<?= $jadwal['sks'] ?> SKS)</p>
                            <div class="flex items-center mt-2 text-xs text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <?= $jadwal['hari']?>
                                <?= $jadwal['jam'] ?>
                                <span class="mx-2">•</span>
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                <?= $jadwal['nama_ruangan'] ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada jadwal hari ini</h3>
                    <p class="mt-1 text-sm text-gray-500">Anda tidak memiliki jadwal mengajar untuk hari ini.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
        <div class="space-y-3">
            <a href="<?= base_url('dosen/jadwal') ?>" class="flex items-center p-3 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition duration-200">
                <svg class="w-8 h-8 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <div>
                    <span class="text-sm font-medium text-gray-700">Lihat Jadwal</span>
                    <p class="text-xs text-gray-500">Jadwal mengajar lengkap</p>
                </div>
            </a>

            <a href="<?= base_url('dosen/nilai') ?>" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition duration-200">
                <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <div>
                    <span class="text-sm font-medium text-gray-700">Input Nilai</span>
                    <p class="text-xs text-gray-500">Kelola nilai mahasiswa</p>
                </div>
            </a>

            <button onclick="showDevelopmentToast('Laporan')" class="w-full flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition duration-200">
                <svg class="w-8 h-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                <div>
                    <span class="text-sm font-medium text-gray-700">Laporan</span>
                    <p class="text-xs text-gray-500">Statistik & laporan</p>
                </div>
            </button>
        </div>

        <!-- Profile Summary -->
        <div class="mt-6 pt-4 border-t border-gray-200">
            <h4 class="text-sm font-medium text-gray-700 mb-3">Informasi Dosen</h4>
            <div class="space-y-2 text-sm text-gray-600">
                <div class="flex justify-between">
                    <span>NIDN:</span>
                    <span class="font-medium"><?= session('kode') ?? '-' ?></span>
                </div>
                <div class="flex justify-between">
                    <span>Status:</span>
                    <span class="font-medium text-yellow-600">Aktif</span>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    // Development toast function
    function showDevelopmentToast(featureName) {
        const message = `🚧 ${featureName} sedang dalam tahap pengembangan dan akan segera tersedia!`;
        if (window.toast) {
            window.toast.info(message, 4000);
        }
    }

    // Auto refresh data setiap 5 menit
    setInterval(function() {
        // Refresh stats atau data tertentu jika diperlukan
        console.log('Auto refresh - checking for updates...');
    }, 300000); // 5 menit
</script>
<?= $this->endSection() ?>