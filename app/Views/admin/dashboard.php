<?= $this->extend('layout/admin/main') ?>

<?= $this->section('content') ?>
<!-- Header -->
<div class="mb-6 sm:mb-8">
    <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Dashboard Admin</h1>
    <p class="text-sm sm:text-base text-gray-600">Kelola Data Akademik Sistem SIPAKU</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-5 gap-4 sm:gap-6 mb-8">
    <!-- Total Mahasiswa -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-800">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Mahasiswa</p>
                <p class="text-2xl font-bold text-gray-900"><?= $stats['mahasiswa'] ?? '' ?></p>
            </div>
        </div>
    </div>

    <!-- Total Dosen -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-800">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Dosen</p>
                <p class="text-2xl font-bold text-gray-900"><?= $stats['dosen'] ?? '' ?></p>
            </div>
        </div>
    </div>

    <!-- Total Ruangan -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-yellow-100 text-yellow-800">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Ruangan</p>
                <p class="text-2xl font-bold text-gray-900"><?= $stats['ruangan'] ?? '' ?></p>
            </div>
        </div>
    </div>

    <!-- Total Jadwal -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-800">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Jadwal</p>
                <p class="text-2xl font-bold text-gray-900"><?= $stats['jadwal'] ?? '' ?></p>
            </div>
        </div>
    </div>

    <!-- Total Users -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-800">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-sm font-medium text-gray-600">Total Users</p>
                <p class="text-2xl font-bold text-gray-900"><?= $stats['users'] ?? '' ?></p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mb-8">
    <!-- Recent Activities -->
    <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h3>
            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                Menampilkan <?= $config['recent_activities_limit'] ?? 5 ?> terbaru
            </span>
        </div>
        <div class="space-y-4">
            <?php if (!empty($activities)): ?>
                <?php foreach ($activities as $activity): ?>
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <div class="w-2 h-2 bg-<?= $activity['color'] ?>-500 rounded-full mr-3"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900"><?= $activity['message'] ?></p>
                            <p class="text-xs text-gray-500"><?= $activity['time'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Mahasiswa baru ditambahkan</p>
                        <p class="text-xs text-gray-500">2 menit yang lalu</p>
                    </div>
                </div>
                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                    <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Jadwal kuliah diperbarui</p>
                        <p class="text-xs text-gray-500">15 menit yang lalu</p>
                    </div>
                </div>
                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                    <div class="w-2 h-2 bg-yellow-500 rounded-full mr-3"></div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Ruangan baru ditambahkan</p>
                        <p class="text-xs text-gray-500">1 jam yang lalu</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-lg p-4 sm:p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Navigasi Cepat</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="<?= base_url('admin/mahasiswa') ?>" class="flex flex-col items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition duration-200">
                <svg class="w-8 h-8 text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700">Kelola Mahasiswa</span>
            </a>
            <a href="<?= base_url('admin/dosen') ?>" class="flex flex-col items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition duration-200">
                <svg class="w-8 h-8 text-green-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700">Kelola Dosen</span>
            </a>
            <a href="<?= base_url('admin/ruangan') ?>" class="flex flex-col items-center p-4 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition duration-200">
                <svg class="w-8 h-8 text-yellow-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700">Kelola Ruangan</span>
            </a>
            <a href="<?= base_url('admin/jadwal') ?>" class="flex flex-col items-center p-4 bg-purple-50 hover:bg-purple-100 rounded-lg transition duration-200">
                <svg class="w-8 h-8 text-purple-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <span class="text-sm font-medium text-gray-700">Kelola Jadwal</span>
            </a>
        </div>
        
        <!-- Additional Quick Actions -->
        <div class="mt-6 pt-4 border-t border-gray-200">
            <h4 class="text-sm font-medium text-gray-700 mb-3">Fitur Tambahan</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <button onclick="showSearchModal()" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-200">
                    <svg class="w-5 h-5 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Pencarian Cepat</span>
                </button>
                <button onclick="showStatsModal()" class="flex items-center p-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition duration-200">
                    <svg class="w-5 h-5 text-gray-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Statistik Detail</span>
                </button>
                
                <!-- Test Toast Button (temporary)
                <button onclick="testToast()" class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition duration-200">
                    <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10m0 0V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2m10 0v10a2 2 0 01-2 2H9a2 2 0 01-2-2V8m10 0H7m3 5h4"></path>
                    </svg>
                    <span class="text-sm font-medium text-gray-700">Test Toast</span>
                </button> -->
            </div>
        </div>
        
        <!-- Configuration Info -->
        <div class="mt-4 p-3 bg-gray-50 rounded-lg">
            <h4 class="text-sm font-medium text-gray-700 mb-2">Konfigurasi Dashboard</h4>
            <div class="grid grid-cols-2 gap-2 text-xs text-gray-600">
                <div>Aktivitas: <?= $config['recent_activities_limit'] ?> item</div>
                <div>Data Tabel: <?= $config['recent_data_limit'] ?> item</div>
                <div>Data Tab: <?= $config['tab_data_limit'] ?> item</div>
                <div>Auto Refresh: 5 menit</div>
            </div>
        </div>
        </div>
    </div>
</div>

<!-- Data Tables Preview -->
<div class="bg-white rounded-lg shadow-lg p-4 sm:p-6">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Data Terbaru</h3>
            <p class="text-sm text-gray-500 mt-1">
                Menampilkan <?= $config['recent_data_limit'] ?? 5 ?> data terbaru per kategori
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                Limit: <?= $config['tab_data_limit'] ?? 10 ?> per tab
            </span>
            <a href="#" onclick="refreshDashboard()" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Refresh
            </a>
        </div>
    </div>
    
    <!-- Tabs -->
    <div class="border-b border-gray-200 mb-4">
        <nav class="-mb-px flex space-x-4 sm:space-x-8 overflow-x-auto" id="data-tabs">
            <button class="tab-button py-2 px-1 border-b-2 border-blue-800 font-medium text-sm text-blue-800" data-tab="mahasiswa">
                Mahasiswa
            </button>
            <button class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700" data-tab="dosen">
                Dosen
            </button>
            <button class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700" data-tab="ruangan">
                Ruangan
            </button>
            <button class="tab-button py-2 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700" data-tab="jadwal">
                Jadwal
            </button>
        </nav>
    </div>

    <!-- Loading indicator -->
    <div id="table-loading" class="hidden text-center py-8">
        <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-blue-500 bg-blue-100">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Memuat data...
        </div>
    </div>

    <!-- Table Container -->
    <div id="table-container" class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50" id="table-header">
                <tr>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" id="table-body">
                <!-- Initial data (Mahasiswa) -->
                <?php if (!empty($recent_data)): ?>
                    <?php foreach ($recent_data as $data): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= $data['nim'] ?></td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm text-gray-900"><?= $data['nama'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada data mahasiswa
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Data info -->
    <div id="data-info" class="mt-4 text-center">
        <p class="text-sm text-gray-500">
            <span id="data-count">
                <?php if (!empty($recent_data)): ?>
                    Menampilkan <?= count($recent_data) ?> dari <?= $stats['mahasiswa'] ?? 0 ?> total mahasiswa
                <?php else: ?>
                    Tidak ada data untuk ditampilkan
                <?php endif; ?>
            </span>
            <span class="mx-2">•</span>
            <button onclick="showAllData()" class="text-blue-600 hover:text-blue-800 font-medium">
                Lihat Semua Data
            </button>
        </p>
    </div>

    <!-- Error message -->
    <div id="error-message" class="hidden text-center py-8">
        <div class="text-red-600 bg-red-50 border border-red-200 rounded-lg p-4">
            <p class="font-medium">Gagal memuat data</p>
            <p class="text-sm mt-1">Silakan refresh halaman atau coba lagi nanti</p>
        </div>
    </div>
</div>

<!-- Modal Pencarian Cepat -->
<div id="searchModal" class="admin-modal fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-2xl mx-4 transform transition-all duration-300 scale-95 opacity-0 relative" id="searchModalContent">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-900">Pencarian Cepat</h3>
            <button onclick="closeSearchModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Modal Body -->
        <div class="p-6">
            <div class="mb-4">
                <label for="searchType" class="block text-sm font-medium text-gray-700 mb-2">Cari di:</label>
                <select id="searchType" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="mahasiswa">Mahasiswa (NIM/Nama)</option>
                    <option value="dosen">Dosen (NIDN/Nama)</option>
                    <option value="ruangan">Ruangan</option>
                    <option value="jadwal">Jadwal (Kelas/Mata Kuliah)</option>
                </select>
            </div>
            
            <div class="mb-4">
                <label for="searchQuery" class="block text-sm font-medium text-gray-700 mb-2">Kata Kunci:</label>
                <input type="text" id="searchQuery" placeholder="Masukkan kata kunci pencarian..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <button onclick="performSearch()" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                Cari Sekarang
            </button>
            
            <!-- Search Results -->
            <div id="searchResults" class="mt-6 hidden">
                <h4 class="text-sm font-medium text-gray-700 mb-3">Hasil Pencarian:</h4>
                <div id="searchResultsContent" class="max-h-60 overflow-y-auto border border-gray-200 rounded-lg">
                    <!-- Results will be populated here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Statistik Detail -->
<div id="statsModal" class="admin-modal fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-4xl mx-4 transform transition-all duration-300 scale-95 opacity-0 relative" id="statsModalContent">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-900">Statistik Detail Sistem</h3>
            <button onclick="closeStatsModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Modal Body -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Statistik Mahasiswa -->
                <div class="bg-blue-50 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <h4 class="ml-3 text-lg font-semibold text-blue-800">Mahasiswa</h4>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Total:</span>
                            <span class="text-sm font-medium" id="stats-mahasiswa-total"><?= $stats['mahasiswa'] ?? 0 ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Aktif:</span>
                            <span class="text-sm font-medium text-green-600" id="stats-mahasiswa-aktif">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Terbaru (7 hari):</span>
                            <span class="text-sm font-medium text-blue-600" id="stats-mahasiswa-recent">-</span>
                        </div>
                    </div>
                </div>

                <!-- Statistik Dosen -->
                <div class="bg-green-50 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h4 class="ml-3 text-lg font-semibold text-green-800">Dosen</h4>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Total:</span>
                            <span class="text-sm font-medium" id="stats-dosen-total"><?= $stats['dosen'] ?? 0 ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Aktif:</span>
                            <span class="text-sm font-medium text-green-600" id="stats-dosen-aktif">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Terbaru (7 hari):</span>
                            <span class="text-sm font-medium text-green-600" id="stats-dosen-recent">-</span>
                        </div>
                    </div>
                </div>

                <!-- Statistik Ruangan -->
                <div class="bg-yellow-50 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="p-2 bg-yellow-100 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h4 class="ml-3 text-lg font-semibold text-yellow-800">Ruangan</h4>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Total:</span>
                            <span class="text-sm font-medium" id="stats-ruangan-total"><?= $stats['ruangan'] ?? 0 ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Lab:</span>
                            <span class="text-sm font-medium text-purple-600" id="stats-ruangan-lab">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Kelas:</span>
                            <span class="text-sm font-medium text-yellow-600" id="stats-ruangan-kelas">-</span>
                        </div>
                    </div>
                </div>

                <!-- Statistik Jadwal -->
                <div class="bg-purple-50 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h4 class="ml-3 text-lg font-semibold text-purple-800">Jadwal</h4>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Total:</span>
                            <span class="text-sm font-medium" id="stats-jadwal-total"><?= $stats['jadwal'] ?? 0 ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Hari ini:</span>
                            <span class="text-sm font-medium text-purple-600" id="stats-jadwal-today">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Minggu ini:</span>
                            <span class="text-sm font-medium text-purple-600" id="stats-jadwal-week">-</span>
                        </div>
                    </div>
                </div>


                <!-- Aktivitas Terbaru -->
                <div class="bg-indigo-50 rounded-lg p-4">
                    <div class="flex items-center mb-3">
                        <div class="p-2 bg-indigo-100 rounded-lg">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h4 class="ml-3 text-lg font-semibold text-indigo-800">Aktivitas</h4>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Hari ini:</span>
                            <span class="text-sm font-medium text-indigo-600" id="stats-activity-today">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Minggu ini:</span>
                            <span class="text-sm font-medium text-indigo-600" id="stats-activity-week">-</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Bulan ini:</span>
                            <span class="text-sm font-medium text-indigo-600" id="stats-activity-month">-</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading indicator -->
            <div id="stats-loading" class="hidden text-center py-8">
                <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-blue-500 bg-blue-100">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memuat statistik detail...
                </div>
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="flex justify-end space-x-3 p-6 border-t border-gray-200">
            <button onclick="refreshStats()" class="px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-lg hover:bg-blue-100 transition-colors">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Refresh
            </button>
            <button onclick="closeStatsModal()" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Configuration
const baseUrl = '<?= base_url() ?>';

document.addEventListener('DOMContentLoaded', function() {
    // Initialize tab functionality
    initializeTabs();
    
    // Set initial header for mahasiswa (already set in PHP, but ensure consistency)
    setTableHeader('mahasiswa');
    
    // Update initial data info
    updateDataInfo(<?= count($recent_data) ?>, 'mahasiswa');
});

function initializeTabs() {
    const tabButtons = document.querySelectorAll('.tab-button');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabType = this.getAttribute('data-tab');
            showTab(tabType);
            
            // Update active tab styling
            tabButtons.forEach(btn => {
                btn.classList.remove('border-blue-800', 'text-blue-800');
                btn.classList.add('border-transparent', 'text-gray-500');
            });
            
            this.classList.remove('border-transparent', 'text-gray-500');
            this.classList.add('border-blue-800', 'text-blue-800');
        });
    });
}

function showTab(tabType) {
    console.log('Switching to tab:', tabType);
    
    // Show loading
    showLoading(true);
    hideError();
    
    // Update table header
    setTableHeader(tabType);
    
    // Fetch data via AJAX
    fetch(`${baseUrl}/admin/dashboard/getTabData/${tabType}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        showLoading(false);
        
        if (data.success) {
            updateTableContent(data.data, data.type);
        } else {
            showError(data.error || 'Gagal memuat data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showLoading(false);
        showError('Terjadi kesalahan saat memuat data');
    });
}

function setTableHeader(type) {
    const tableHeader = document.getElementById('table-header');
    let headerHTML = '';
    
    switch(type) {
        case 'mahasiswa':
            headerHTML = `
                <tr>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                </tr>
            `;
            break;
        case 'dosen':
            headerHTML = `
                <tr>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">NIDN</th>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                </tr>
            `;
            break;
        case 'ruangan':
            headerHTML = `
                <tr>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Nama Ruangan</th>
                </tr>
            `;
            break;
        case 'jadwal':
            headerHTML = `
                <tr>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                    <th class="px-3 sm:px-6 py-2 sm:py-3 text-left text-xs sm:text-sm font-medium text-gray-500 uppercase tracking-wider">Hari & Jam</th>
                </tr>
            `;
            break;
    }
    
    tableHeader.innerHTML = headerHTML;
}

function updateTableContent(data, type) {
    const tableBody = document.getElementById('table-body');
    let rowsHTML = '';
    
    if (data && data.length > 0) {
        data.forEach(item => {
            rowsHTML += generateTableRow(item, type);
        });
    } else {
        rowsHTML = `
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                    Tidak ada data ${type}
                </td>
            </tr>
        `;
    }
    
    tableBody.innerHTML = rowsHTML;
}

function generateTableRow(item, type) {
    switch(type) {
        case 'mahasiswa':
            return `
                <tr class="hover:bg-gray-50">
                    <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.nim || 'N/A'}</td>
                    <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm text-gray-900">${item.nama || 'N/A'}</td>
                </tr>
            `;
        case 'dosen':
            return `
                <tr class="hover:bg-gray-50">
                    <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.nidn || 'N/A'}</td>
                    <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm text-gray-900">${item.nama || 'N/A'}</td>
                </tr>
            `;
        case 'ruangan':
            return `
                <tr class="hover:bg-gray-50">
                    <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm text-gray-900">${item.nama_ruangan || 'N/A'}</td>
                </tr>
            `;
        case 'jadwal':
            return `
                <tr class="hover:bg-gray-50">
                    <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm font-medium text-gray-900">${item.nama_kelas || 'N/A'}</td>
                    <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm text-gray-900">${item.nama_mata_kuliah || 'N/A'}</td>
                    <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm text-gray-500">${item.nama_ruangan || 'N/A'}</td>
                    <td class="px-3 sm:px-6 py-3 sm:py-4 whitespace-nowrap text-sm text-gray-500">${item.hari || 'N/A'} ${item.jam || ''}</td>
                </tr>
            `;
        default:
            return '';
    }
}

function getProdiName(nim) {
    if (!nim) return 'N/A';
    
    const nimPrefix = nim.toString().substring(0, 2);
    
    switch (nimPrefix) {
        case '11':
            return 'Teknik Informatika';
        case '12':
            return 'Sistem Informasi';
        case '13':
            return 'Teknik Komputer';
        default:
            return 'Program Studi';
    }
}

function showLoading(show) {
    const loading = document.getElementById('table-loading');
    const tableContainer = document.getElementById('table-container');
    
    if (show) {
        loading.classList.remove('hidden');
        tableContainer.classList.add('hidden');
    } else {
        loading.classList.add('hidden');
        tableContainer.classList.remove('hidden');
    }
}

function showError(message) {
    const errorDiv = document.getElementById('error-message');
    const tableContainer = document.getElementById('table-container');
    
    errorDiv.querySelector('p:last-child').textContent = message || 'Silakan refresh halaman atau coba lagi nanti';
    errorDiv.classList.remove('hidden');
    tableContainer.classList.add('hidden');
}

function hideError() {
    const errorDiv = document.getElementById('error-message');
    errorDiv.classList.add('hidden');
}

// Configuration from PHP
const dashboardConfig = {
    recentDataLimit: <?= $config['recent_data_limit'] ?? 5 ?>,
    tabDataLimit: <?= $config['tab_data_limit'] ?? 10 ?>,
    stats: <?= json_encode($stats) ?>
};

function updateTableContent(data, type) {
    const tableBody = document.getElementById('table-body');
    const dataInfo = document.getElementById('data-info');
    let rowsHTML = '';
    
    if (data && data.length > 0) {
        data.forEach(item => {
            rowsHTML += generateTableRow(item, type);
        });
        
        // Update data info
        updateDataInfo(data.length, type);
    } else {
        // Determine colspan based on type
        let colspan = 2; // Default for mahasiswa, dosen, ruangan
        if (type === 'jadwal') {
            colspan = 4; // Jadwal has 4 columns
        }
        
        rowsHTML = `
            <tr>
                <td colspan="${colspan}" class="px-6 py-4 text-center text-gray-500">
                    Tidak ada data ${type}
                </td>
            </tr>
        `;
        
        // Update data info for empty state
        updateDataInfo(0, type);
    }
    
    tableBody.innerHTML = rowsHTML;
}

function updateDataInfo(count, type) {
    const dataCount = document.getElementById('data-count');
    const totalData = dashboardConfig.stats[type] || 0;
    
    let typeLabel = '';
    switch(type) {
        case 'mahasiswa':
            typeLabel = 'mahasiswa';
            break;
        case 'dosen':
            typeLabel = 'dosen';
            break;
        case 'ruangan':
            typeLabel = 'ruangan';
            break;
        case 'jadwal':
            typeLabel = 'jadwal';
            break;
    }
    
    if (count > 0) {
        dataCount.textContent = `Menampilkan ${count} dari ${totalData} total ${typeLabel}`;
    } else {
        dataCount.textContent = `Tidak ada data ${typeLabel} untuk ditampilkan`;
    }
}

function refreshDashboard() {
    // Show loading state
    const refreshBtn = event.target.closest('a');
    const originalText = refreshBtn.innerHTML;
    
    refreshBtn.innerHTML = `
        <svg class="w-4 h-4 inline mr-1 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
        </svg>
        Refreshing...
    `;
    
    // Reload page after short delay
    setTimeout(() => {
        location.reload();
    }, 500);
}

function showAllData() {
    // Get current active tab
    const activeTab = document.querySelector('.tab-button.border-blue-800');
    const tabType = activeTab ? activeTab.getAttribute('data-tab') : 'mahasiswa';
    
    // Redirect to appropriate page
    switch(tabType) {
        case 'mahasiswa':
            window.location.href = baseUrl + '/admin/mahasiswa';
            break;
        case 'dosen':
            window.location.href = baseUrl + '/admin/dosen';
            break;
        case 'ruangan':
            window.location.href = baseUrl + '/admin/ruangan';
            break;
        case 'jadwal':
            window.location.href = baseUrl + '/admin/jadwal';
            break;
    }
}

// Modal functions
function showSearchModal() {
    const modal = document.getElementById('searchModal');
    const modalContent = document.getElementById('searchModalContent');
    
    // Reset form
    document.getElementById('searchQuery').value = '';
    document.getElementById('searchResults').classList.add('hidden');
    
    // Ensure modal is appended to body root (not inside any container)
    if (modal.parentNode !== document.body) {
        document.body.appendChild(modal);
    }
    
    // Lock body scroll and add modal class
    document.body.classList.add('modal-open');
    document.body.style.overflow = 'hidden';
    
    // Force highest z-index and positioning
    modal.style.cssText = `
        z-index: 2147483647 !important;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background-color: rgba(0, 0, 0, 0.5) !important;
    `;
    
    modalContent.style.cssText = `
        z-index: 2147483648 !important;
        position: relative !important;
    `;
    
    // Show modal
    modal.classList.remove('hidden');
    
    // Animate modal
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    // Focus on search input
    setTimeout(() => {
        document.getElementById('searchQuery').focus();
    }, 100);
}

function closeSearchModal() {
    const modal = document.getElementById('searchModal');
    const modalContent = document.getElementById('searchModalContent');
    
    // Animate out
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    // Hide modal after animation and remove all effects
    setTimeout(() => {
        modal.classList.add('hidden');
        
        // Completely clear all inline styles from modal
        modal.removeAttribute('style');
        modalContent.removeAttribute('style');
        
        // Remove body effects
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.filter = '';
        
        // Ensure modal is properly hidden
        modal.style.display = 'none';
        
        // Force a small delay then reset display
        setTimeout(() => {
            modal.style.display = '';
        }, 50);
    }, 300);
}

function performSearch() {
    const searchType = document.getElementById('searchType').value;
    const searchQuery = document.getElementById('searchQuery').value.trim();
    
    if (!searchQuery) {
        showWarning('Masukkan kata kunci pencarian');
        return;
    }
    
    // Show loading
    const resultsDiv = document.getElementById('searchResults');
    const resultsContent = document.getElementById('searchResultsContent');
    
    resultsDiv.classList.remove('hidden');
    resultsContent.innerHTML = `
        <div class="p-4 text-center">
            <svg class="animate-spin w-6 h-6 mx-auto text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <p class="mt-2 text-sm text-gray-600">Mencari...</p>
        </div>
    `;
    
    // Perform search via AJAX
    fetch(`${baseUrl}/admin/dashboard/search`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            type: searchType,
            query: searchQuery
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.results) {
            displaySearchResults(data.results, searchType);
        } else {
            resultsContent.innerHTML = `
                <div class="p-4 text-center text-gray-500">
                    <p>Tidak ada hasil ditemukan</p>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Search error:', error);
        resultsContent.innerHTML = `
            <div class="p-4 text-center text-red-500">
                <p>Terjadi kesalahan saat mencari</p>
            </div>
        `;
    });
}

function displaySearchResults(results, type) {
    const resultsContent = document.getElementById('searchResultsContent');
    let html = '';
    
    results.forEach(item => {
        let displayText = '';
        let clickAction = '';
        
        switch(type) {
            case 'mahasiswa':
                displayText = `${item.nim} - ${item.nama}`;
                clickAction = `onclick="goToPage('admin/mahasiswa')"`;
                break;
            case 'dosen':
                displayText = `${item.nidn} - ${item.nama}`;
                clickAction = `onclick="goToPage('admin/dosen')"`;
                break;
            case 'ruangan':
                displayText = item.nama_ruangan;
                clickAction = `onclick="goToPage('admin/ruangan')"`;
                break;
            case 'jadwal':
                displayText = `${item.nama_kelas} - ${item.nama_mata_kuliah || 'N/A'}`;
                clickAction = `onclick="goToPage('admin/jadwal')"`;
                break;
        }
        
        html += `
            <div class="p-3 border-b border-gray-100 hover:bg-gray-50 cursor-pointer" ${clickAction}>
                <p class="text-sm font-medium text-gray-900">${displayText}</p>
            </div>
        `;
    });
    
    if (html) {
        resultsContent.innerHTML = html;
    } else {
        resultsContent.innerHTML = `
            <div class="p-4 text-center text-gray-500">
                <p>Tidak ada hasil ditemukan</p>
            </div>
        `;
    }
}

function goToPage(page) {
    closeSearchModal();
    setTimeout(() => {
        window.location.href = baseUrl + '/' + page;
    }, 300);
}

// Export function - commented out for now
/*
function exportData() {
    const options = [
        { value: 'mahasiswa', label: 'Data Mahasiswa' },
        { value: 'dosen', label: 'Data Dosen' },
        { value: 'ruangan', label: 'Data Ruangan' },
        { value: 'jadwal', label: 'Data Jadwal' }
    ];
    
    let optionsHtml = options.map(opt => 
        `<option value="${opt.value}">${opt.label}</option>`
    ).join('');
    
    const result = prompt(`Pilih data yang akan di-export:\n\n${options.map((opt, i) => `${i+1}. ${opt.label}`).join('\n')}\n\nMasukkan nomor (1-4):`);
    
    if (result) {
        const index = parseInt(result) - 1;
        if (index >= 0 && index < options.length) {
            const selectedType = options[index].value;
            
            // Create download link
            const downloadUrl = `${baseUrl}/admin/dashboard/export/${selectedType}`;
            
            // Show loading message
            alert(`Memproses export ${options[index].label}...`);
            
            // Create temporary link and trigger download
            const link = document.createElement('a');
            link.href = downloadUrl;
            link.download = `${selectedType}_${new Date().toISOString().split('T')[0]}.csv`;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        } else {
            alert('Pilihan tidak valid');
        }
    }
}
*/

// Statistics Modal Functions
function showStatsModal() {
    const modal = document.getElementById('statsModal');
    const modalContent = document.getElementById('statsModalContent');
    
    // Ensure modal is appended to body root (not inside any container)
    if (modal.parentNode !== document.body) {
        document.body.appendChild(modal);
    }
    
    // Lock body scroll and add modal class
    document.body.classList.add('modal-open');
    document.body.style.overflow = 'hidden';
    
    // Force highest z-index and positioning
    modal.style.cssText = `
        z-index: 2147483647 !important;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background-color: rgba(0, 0, 0, 0.5) !important;
    `;
    
    modalContent.style.cssText = `
        z-index: 2147483648 !important;
        position: relative !important;
    `;
    
    // Show modal
    modal.classList.remove('hidden');
    
    // Animate modal
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
    
    // Load detailed statistics
    loadDetailedStats();
}

function closeStatsModal() {
    const modal = document.getElementById('statsModal');
    const modalContent = document.getElementById('statsModalContent');
    
    // Animate out
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    // Hide modal after animation and remove all effects
    setTimeout(() => {
        modal.classList.add('hidden');
        
        // Completely clear all inline styles from modal
        modal.removeAttribute('style');
        modalContent.removeAttribute('style');
        
        // Remove body effects
        document.body.classList.remove('modal-open');
        document.body.style.overflow = '';
        document.body.style.filter = '';
        
        // Ensure modal is properly hidden
        modal.style.display = 'none';
        
        // Force a small delay then reset display
        setTimeout(() => {
            modal.style.display = '';
        }, 50);
    }, 300);
}

function loadDetailedStats() {
    // Show loading
    document.getElementById('stats-loading').classList.remove('hidden');
    
    // Fetch detailed statistics
    fetch(`${baseUrl}/admin/dashboard/getDetailedStats`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('stats-loading').classList.add('hidden');
        
        if (data.success) {
            updateStatsDisplay(data.stats);
        } else {
            console.error('Failed to load detailed stats');
        }
    })
    .catch(error => {
        console.error('Error loading stats:', error);
        document.getElementById('stats-loading').classList.add('hidden');
    });
}

function updateStatsDisplay(stats) {
    // Update mahasiswa stats
    document.getElementById('stats-mahasiswa-aktif').textContent = stats.mahasiswa_aktif || '-';
    document.getElementById('stats-mahasiswa-recent').textContent = stats.mahasiswa_recent || '-';
    
    // Update dosen stats
    document.getElementById('stats-dosen-aktif').textContent = stats.dosen_aktif || '-';
    document.getElementById('stats-dosen-recent').textContent = stats.dosen_recent || '-';
    
    // Update ruangan stats
    document.getElementById('stats-ruangan-lab').textContent = stats.ruangan_lab || '-';
    document.getElementById('stats-ruangan-kelas').textContent = stats.ruangan_kelas || '-';
    
    // Update jadwal stats
    document.getElementById('stats-jadwal-today').textContent = stats.jadwal_today || '-';
    document.getElementById('stats-jadwal-week').textContent = stats.jadwal_week || '-';
    
    // Update activity stats
    document.getElementById('stats-activity-today').textContent = stats.activity_today || '-';
    document.getElementById('stats-activity-week').textContent = stats.activity_week || '-';
    document.getElementById('stats-activity-month').textContent = stats.activity_month || '-';
}

function refreshStats() {
    loadDetailedStats();
}

// // Test toast function (temporary)
// function testToast() {
//     showSuccess('Toast berhasil ditampilkan!');
//     setTimeout(() => showError('Ini adalah error toast'), 1000);
//     setTimeout(() => showWarning('Ini adalah warning toast'), 2000);
//     setTimeout(() => showInfo('Ini adalah info toast'), 3000);
// }

// Close modal when clicking backdrop
document.addEventListener('click', function(e) {
    const searchModal = document.getElementById('searchModal');
    const statsModal = document.getElementById('statsModal');
    
    if (e.target === searchModal) {
        closeSearchModal();
    }
    
    if (e.target === statsModal) {
        closeStatsModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const searchModal = document.getElementById('searchModal');
        const statsModal = document.getElementById('statsModal');
        
        if (!searchModal.classList.contains('hidden')) {
            closeSearchModal();
        } else if (!statsModal.classList.contains('hidden')) {
            closeStatsModal();
        }
    }
});

// Enter key to search
document.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
        const searchQuery = document.getElementById('searchQuery');
        if (document.activeElement === searchQuery) {
            performSearch();
        }
    }
});

// Auto refresh stats every 5 minutes
setInterval(function() {
    location.reload();
}, 5 * 60 * 1000);
</script>
<?= $this->endSection() ?>