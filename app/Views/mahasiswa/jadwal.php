<?= $this->extend('layout/mahasiswa/main') ?>

<?= $this->section('content') ?>
<!-- Header -->
<div class="mb-6 sm:mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Jadwal Kuliah</h1>
            
        </div>
      
    </div>
</div>

<!-- Filter & Actions -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex flex-col sm:flex-row gap-4">
            <!-- Filter Hari -->
            <div class="relative">
                <select id="filter-hari" class="appearance-none bg-white border border-gray-300 rounded-md px-4 py-2 pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                </select>
                <svg class="absolute right-2 top-3 w-4 h-4 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>

            <!-- Search -->
            <div class="relative">
                <input type="text" id="search-jadwal" placeholder="Cari mata kuliah..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>

        <div class="flex items-center space-x-3">
            <button onclick="exportJadwal()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Export PDF
            </button>
        </div>
    </div>
</div>

<!-- Jadwal Grid View -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-6">Jadwal Mingguan</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4" id="jadwal-grid">
        <?php if (!empty($jadwal_kuliah)): ?>
            <?php 
            $jadwalByHari = [];
            foreach ($jadwal_kuliah as $jadwal) {
                $jadwalByHari[$jadwal['hari']][] = $jadwal;
            }
            
            $hariUrutan = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
            ?>
            
            <?php foreach ($hariUrutan as $hari): ?>
                <?php if (isset($jadwalByHari[$hari])): ?>
                    <div class="border border-gray-200 rounded-lg p-4 jadwal-card" data-hari="<?= $hari ?>">
                        
                        <div class="space-y-3">
                            <?php foreach ($jadwalByHari[$hari] as $jadwal): ?>
                                <div class="bg-gray-50 rounded-lg p-4 jadwal-item" data-matkul="<?= strtolower($jadwal['nama_mata_kuliah']) ?>">
                                    <div class="flex items-start justify-between mb-2">
                                        <h5 class="font-medium text-gray-900 text-sm"><?= $jadwal['nama_mata_kuliah'] ?></h5><br>
                                        <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                                            <?= $jadwal['sks'] ?> SKS
                                        </span>
                                    </div>
                                    
                                    <p class="text-xs text-gray-600 mb-2"><?= $jadwal['nama_kelas'] ?></p>
                                    
                                    <div class="flex items-center text-xs text-gray-500 mb-1">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <?= $jadwal['jam'] ?>
                                    </div>
                                    
                                    <div class="flex items-center text-xs text-gray-500 mb-1">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <?= $jadwal['nama_ruangan'] ?>
                                    </div>
                                    
                                    <div class="flex items-center text-xs text-gray-500">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <?= $jadwal['nama_dosen'] ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada jadwal kuliah</h3>
                <p class="mt-1 text-sm text-gray-500">Anda belum terdaftar dalam mata kuliah apapun.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Jadwal Table View -->
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-gray-800">Jadwal Detail</h3>
        <div class="flex items-center space-x-2">
            <button onclick="toggleView('grid')" id="btn-grid" class="p-2 text-gray-400 hover:text-blue-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                </svg>
            </button>
            <button onclick="toggleView('table')" id="btn-table" class="p-2 text-blue-600 hover:text-blue-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0V4a1 1 0 011-1h12a1 1 0 011 1v16a1 1 0 01-1 1H4a1 1 0 01-1-1z"></path>
                </svg>
            </button>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200" id="jadwal-table">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jam</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ruangan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (!empty($jadwal_kuliah)): ?>
                    <?php foreach ($jadwal_kuliah as $jadwal): ?>
                        <tr class="hover:bg-gray-50 jadwal-row" data-hari="<?= strtolower($jadwal['hari']) ?>" data-matkul="<?= strtolower($jadwal['nama_mata_kuliah']) ?>">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900"><?= $jadwal['nama_mata_kuliah'] ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= $jadwal['nama_kelas'] ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= $jadwal['nama_dosen'] ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <?= $jadwal['hari'] ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= $jadwal['jam'] ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?= $jadwal['nama_ruangan'] ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <?= $jadwal['sks'] ?> SKS
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada jadwal kuliah yang tersedia
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterHari = document.getElementById('filter-hari');
        const searchJadwal = document.getElementById('search-jadwal');
        
        function filterJadwal() {
            const selectedHari = filterHari.value.toLowerCase();
            const searchTerm = searchJadwal.value.toLowerCase();
            
            // Filter grid cards
            const gridCards = document.querySelectorAll('.jadwal-card');
            gridCards.forEach(card => {
                const hari = card.dataset.hari.toLowerCase();
                const items = card.querySelectorAll('.jadwal-item');
                let hasVisibleItems = false;
                
                items.forEach(item => {
                    const matkul = item.dataset.matkul;
                    const matchesSearch = !searchTerm || matkul.includes(searchTerm);
                    
                    if (matchesSearch) {
                        item.style.display = 'block';
                        hasVisibleItems = true;
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                const matchesHari = !selectedHari || hari === selectedHari;
                card.style.display = (matchesHari && hasVisibleItems) ? 'block' : 'none';
            });
            
            // Filter table rows
            const tableRows = document.querySelectorAll('.jadwal-row');
            tableRows.forEach(row => {
                const hari = row.dataset.hari;
                const matkul = row.dataset.matkul;
                
                const matchesHari = !selectedHari || hari === selectedHari;
                const matchesSearch = !searchTerm || matkul.includes(searchTerm);
                
                row.style.display = (matchesHari && matchesSearch) ? 'table-row' : 'none';
            });
        }
        
        filterHari.addEventListener('change', filterJadwal);
        searchJadwal.addEventListener('input', filterJadwal);
    });
    
    function toggleView(view) {
        const gridView = document.getElementById('jadwal-grid').parentElement;
        const tableView = document.getElementById('jadwal-table').parentElement.parentElement;
        const btnGrid = document.getElementById('btn-grid');
        const btnTable = document.getElementById('btn-table');
        
        if (view === 'grid') {
            gridView.style.display = 'block';
            tableView.style.display = 'none';
            btnGrid.classList.add('text-blue-600');
            btnGrid.classList.remove('text-gray-400');
            btnTable.classList.add('text-gray-400');
            btnTable.classList.remove('text-blue-600');
        } else {
            gridView.style.display = 'none';
            tableView.style.display = 'block';
            btnTable.classList.add('text-blue-600');
            btnTable.classList.remove('text-gray-400');
            btnGrid.classList.add('text-gray-400');
            btnGrid.classList.remove('text-blue-600');
        }
    }
    
    function exportJadwal() {
        window.toast.info('🚧 Fitur export PDF sedang dalam pengembangan', 3000);
    }
</script>
<?= $this->endSection() ?>