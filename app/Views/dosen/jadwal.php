    <?= $this->extend('layout/dosen/main') ?>

<?= $this->section('content') ?>
<!-- Header -->
<div class="mb-6 sm:mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Jadwal Mengajar</h1>
            <p class="text-sm sm:text-base text-gray-600">
                Kelola jadwal mengajar Anda
            </p>
        </div>
        <div class="mt-4 sm:mt-0">
            <div class="flex items-center space-x-3">
                <button onclick="refreshJadwal()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Refresh
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Filter dan Search -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label for="filter-hari" class="block text-sm font-medium text-gray-700 mb-2">Filter Hari</label>
            <select id="filter-hari" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                <option value="">Semua Hari</option>
                <option value="Senin">Senin</option>
                <option value="Selasa">Selasa</option>
                <option value="Rabu">Rabu</option>
                <option value="Kamis">Kamis</option>
                <option value="Jumat">Jumat</option>
                <option value="Sabtu">Sabtu</option>
            </select>
        </div>
        
        <div>
            <label for="filter-ruangan" class="block text-sm font-medium text-gray-700 mb-2">Filter Ruangan</label>
            <select id="filter-ruangan" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                <option value="">Semua Ruangan</option>
                <?php if (!empty($ruangan_list)): ?>
                    <?php foreach ($ruangan_list as $ruangan): ?>
                        <option value="<?= $ruangan['nama_ruangan'] ?>"><?= $ruangan['nama_ruangan'] ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        
        <div>
            <label for="search-matkul" class="block text-sm font-medium text-gray-700 mb-2">Cari Mata Kuliah</label>
            <input type="text" id="search-matkul" placeholder="Nama mata kuliah..." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
        </div>
        
        <div class="flex items-end">
            <button onclick="resetFilters()" class="w-full px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                Reset Filter
            </button>
        </div>
    </div>
</div>

<!-- Jadwal Cards -->
<div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
    <?php if (!empty($jadwal_mengajar)): ?>
        <?php foreach ($jadwal_mengajar as $jadwal): ?>
            <div class="jadwal-card bg-white rounded-lg shadow-lg overflow-hidden border-l-4 border-yellow-400" 
                 data-hari="<?= $jadwal['hari'] ?>" 
                 data-ruangan="<?= $jadwal['nama_ruangan'] ?>" 
                 data-matkul="<?= strtolower($jadwal['nama_mata_kuliah']) ?>">
                
                <!-- Card Header -->
                <div class="bg-yellow-50 px-6 py-4 border-b border-yellow-100">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900"><?= $jadwal['nama_kelas'] ?></h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                            <?= $jadwal['sks'] ?> SKS
                        </span>
                    </div>
                    <p class="text-sm text-yellow-700 mt-1"><?= $jadwal['nama_mata_kuliah'] ?></p>
                </div>
                
                <!-- Card Body -->
                <div class="px-6 py-4">
                    <div class="space-y-3">
                        <!-- Waktu -->
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="font-medium"><?= $jadwal['hari'] ?></span>
                            <span class="mx-2">•</span>
                            <span><?= $jadwal['jam'] ?></span>
                        </div>
                        
                        <!-- Ruangan -->
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span><?= $jadwal['nama_ruangan'] ?></span>
                        </div>
                        
                        <!-- Jumlah Mahasiswa -->
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                            <span><?= $jadwal['jumlah_mahasiswa'] ?? '0' ?> Mahasiswa</span>
                        </div>
                    </div>
                </div>
                
                <!-- Card Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <?php if (isset($jadwal['nilai_status'])): ?>
                                <?php if ($jadwal['nilai_status'] === 'complete'): ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Nilai Lengkap
                                    </span>
                                <?php elseif ($jadwal['nilai_status'] === 'partial'): ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                        </svg>
                                        Sebagian
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        Belum Ada
                                    </span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <!-- <a href="<?= base_url('dosen/nilai/input/' . $jadwal['id']) ?>" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 transition-colors">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Input Nilai
                            </a> -->
                            
                            <button onclick="showJadwalDetail(<?= $jadwal['id'] ?>)" class="inline-flex items-center px-3 py-1.5 border border-gray-300 text-xs font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- Empty State -->
        <div class="col-span-full">
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada jadwal mengajar</h3>
                <p class="mt-1 text-sm text-gray-500">Anda belum memiliki jadwal mengajar yang terdaftar.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Summary Statistics -->
<div class="bg-white rounded-lg shadow-lg p-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Ringkasan Jadwal</h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="text-center p-4 bg-yellow-50 rounded-lg">
            <div class="text-2xl font-bold text-yellow-600"><?= count($jadwal_mengajar ?? []) ?></div>
            <div class="text-sm text-gray-600">Total Jadwal</div>
        </div>
        <div class="text-center p-4 bg-blue-50 rounded-lg">
            <div class="text-2xl font-bold text-blue-600"><?= $stats['total_mahasiswa'] ?? '0' ?></div>
            <div class="text-sm text-gray-600">Total Mahasiswa</div>
        </div>
        <div class="text-center p-4 bg-purple-50 rounded-lg">
            <div class="text-2xl font-bold text-purple-600"><?= $stats['total_matkul'] ?? '0' ?></div>
            <div class="text-sm text-gray-600">Mata Kuliah</div>
        </div>
        <div class="text-center p-4 bg-yellow-50 rounded-lg">
            <div class="text-2xl font-bold text-yellow-600"><?= $stats['nilai_pending'] ?? '0' ?></div>
            <div class="text-sm text-gray-600">Nilai Pending</div>
        </div>
    </div>
</div>

<script>
    // Filter functions
    function filterJadwal() {
        const filterHari = document.getElementById('filter-hari').value.toLowerCase();
        const filterRuangan = document.getElementById('filter-ruangan').value.toLowerCase();
        const searchMatkul = document.getElementById('search-matkul').value.toLowerCase();
        
        const cards = document.querySelectorAll('.jadwal-card');
        
        cards.forEach(card => {
            const hari = card.dataset.hari.toLowerCase();
            const ruangan = card.dataset.ruangan.toLowerCase();
            const matkul = card.dataset.matkul.toLowerCase();
            
            const matchHari = !filterHari || hari.includes(filterHari);
            const matchRuangan = !filterRuangan || ruangan.includes(filterRuangan);
            const matchMatkul = !searchMatkul || matkul.includes(searchMatkul);
            
            if (matchHari && matchRuangan && matchMatkul) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    function resetFilters() {
        document.getElementById('filter-hari').value = '';
        document.getElementById('filter-ruangan').value = '';
        document.getElementById('search-matkul').value = '';
        filterJadwal();
    }
    
    function refreshJadwal() {
        window.toast.info('🔄 Memperbarui data jadwal...', 2000);
        setTimeout(() => {
            window.location.reload();
        }, 1000);
    }
    
    function showJadwalDetail(jadwalId) {
        window.toast.info('🚧 Detail jadwal sedang dalam pengembangan', 3000);
    }
    
    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('filter-hari').addEventListener('change', filterJadwal);
        document.getElementById('filter-ruangan').addEventListener('change', filterJadwal);
        document.getElementById('search-matkul').addEventListener('input', filterJadwal);
    });
</script>
<?= $this->endSection() ?>