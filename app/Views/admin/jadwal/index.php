<?= $this->extend('layout/admin/main') ?>

<?= $this->section('head') ?>
<style>
    /* Custom styles untuk DataTable Preline */
    .hs-datatable-search {
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem 0.5rem 2.5rem;
        font-size: 0.875rem;
        width: 100%;
        max-width: 20rem;
    }
    
    .hs-datatable-search:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .hs-datatable-entries {
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        min-width: 4rem;
    }
    
    .hs-datatable-entries:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .hs-datatable-filter {
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        background: white;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .hs-datatable-filter:hover {
        background-color: #f9fafb;
    }
    
    /* Dropdown specific styles */
    .hs-dropdown {
        position: relative;
    }
    
    .hs-dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        z-index: 1000;
        min-width: 12rem;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        margin-top: 0.25rem;
        transition: opacity 0.2s ease, transform 0.2s ease;
    }
    
    .hs-dropdown-menu.hidden {
        opacity: 0;
        transform: translateY(-10px);
        pointer-events: none;
    }
    
    .hs-dropdown-menu:not(.hidden) {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }
    
    .hs-datatable-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .hs-datatable-table thead th {
        background-color: #f9fafb;
        padding: 0.75rem 1rem;
        text-align: left;
        font-weight: 500;
        font-size: 0.875rem;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .hs-datatable-table tbody td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #f3f4f6;
        font-size: 0.875rem;
        color: #111827;
    }
    
    .hs-datatable-table tbody tr:hover {
        background-color: #f9fafb;
    }
    
    .hs-datatable-pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        border-top: 1px solid #e5e7eb;
        background-color: #f9fafb;
    }
    
    .hs-datatable-info {
        font-size: 0.875rem;
        color: #6b7280;
    }
    
    .hs-datatable-nav {
        display: flex;
        gap: 0.5rem;
    }
    
    .hs-datatable-nav button {
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        background: white;
        font-size: 0.875rem;
        color: #374151;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .hs-datatable-nav button:hover:not(:disabled) {
        background-color: #f3f4f6;
    }
    
    .hs-datatable-nav button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .hs-datatable-nav #page-numbers {
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .hs-datatable-nav #page-numbers button {
        min-width: 2rem;
        height: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hs-datatable-nav #page-numbers span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 2rem;
        height: 2rem;
    }
    
    .action-button {
        color: #3b82f6;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .action-button:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }
    
    .action-button.delete {
        color: #ef4444;
    }
    
    .action-button.delete:hover {
        color: #dc2626;
    }
    
    /* Sortable header styles */
    .sortable {
        user-select: none;
        transition: background-color 0.2s ease;
    }
    
    .sortable:hover {
        background-color: #f3f4f6 !important;
    }
    
    .sortable .flex {
        min-width: 0;
    }
    
    .sortable svg {
        transition: color 0.2s ease;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-wrapper p-6">
    <!-- Main DataTable Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <!-- Header dengan Action Button (Konsep Awal) -->
        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Data Jadwal</h2>
                <p class="text-sm text-gray-600">Kelola jadwal kuliah</p>
            </div>

            <div>
                <div class="inline-flex gap-x-2">
                    <button onclick="openJadwalModal()" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"/>
                            <path d="M12 5v14"/>
                        </svg>
                        Tambah Jadwal
                    </button>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <!-- DataTable Controls (Preline Style) -->
        <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <!-- Search -->
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" id="search-input" class="hs-datatable-search" placeholder="Search for items">
            </div>
            
            <!-- Controls -->
            <div class="flex items-center gap-3">
                <!-- Entries per page -->
                <div class="flex items-center gap-2">
                    <select id="entries-select" class="hs-datatable-entries">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                
                <!-- Filter -->
                <div class="hs-dropdown relative inline-flex">
                    <button id="filter-dropdown" type="button" class="hs-datatable-filter hs-dropdown-toggle" aria-expanded="false">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 2v-6.586a1 1 0 00-.293-.707L3.293 7.121A1 1 0 013 6.414V4z"></path>
                        </svg>
                        Filter
                        <svg class="w-3 h-3 transition-transform duration-200" id="filter-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <div id="filter-menu" class="hs-dropdown-menu hidden">
                        <div class="py-2">
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded cursor-pointer">
                                <input type="checkbox" class="filter-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="all" checked>
                                <span class="ml-2 text-sm text-gray-700">Semua Hari</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded cursor-pointer">
                                <input type="checkbox" class="filter-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="senin">
                                <span class="ml-2 text-sm text-gray-700">Senin</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded cursor-pointer">
                                <input type="checkbox" class="filter-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="selasa">
                                <span class="ml-2 text-sm text-gray-700">Selasa</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded cursor-pointer">
                                <input type="checkbox" class="filter-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="rabu">
                                <span class="ml-2 text-sm text-gray-700">Rabu</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded cursor-pointer">
                                <input type="checkbox" class="filter-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="kamis">
                                <span class="ml-2 text-sm text-gray-700">Kamis</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded cursor-pointer">
                                <input type="checkbox" class="filter-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="jumat">
                                <span class="ml-2 text-sm text-gray-700">Jumat</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Table (Preline Style) -->
        <div class="overflow-hidden">
            <table class="hs-datatable-table" id="jadwal-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="sortable cursor-pointer hover:bg-gray-100" data-sort="nama_kelas">
                            <div class="flex items-center justify-between">
                                <span>Kelas</span>
                                <div class="flex flex-col">
                                    <svg class="w-3 h-3 <?= ($current_sort ?? '') === 'nama_kelas' && ($current_order ?? '') === 'ASC' ? 'text-blue-600' : 'text-gray-400' ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd" transform="rotate(180)"></path>
                                    </svg>
                                    <svg class="w-3 h-3 <?= ($current_sort ?? '') === 'nama_kelas' && ($current_order ?? '') === 'DESC' ? 'text-blue-600' : 'text-gray-400' ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </th>
                        <th class="sortable cursor-pointer hover:bg-gray-100" data-sort="nama_mata_kuliah">
                            <div class="flex items-center justify-between">
                                <span>Mata Kuliah</span>
                                <div class="flex flex-col">
                                    <svg class="w-3 h-3 <?= ($current_sort ?? '') === 'nama_mata_kuliah' && ($current_order ?? '') === 'ASC' ? 'text-blue-600' : 'text-gray-400' ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd" transform="rotate(180)"></path>
                                    </svg>
                                    <svg class="w-3 h-3 <?= ($current_sort ?? '') === 'nama_mata_kuliah' && ($current_order ?? '') === 'DESC' ? 'text-blue-600' : 'text-gray-400' ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </th>
                        <th class="sortable cursor-pointer hover:bg-gray-100" data-sort="nama_dosen">
                            <div class="flex items-center justify-between">
                                <span>Dosen</span>
                                <div class="flex flex-col">
                                    <svg class="w-3 h-3 <?= ($current_sort ?? '') === 'nama_dosen' && ($current_order ?? '') === 'ASC' ? 'text-blue-600' : 'text-gray-400' ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd" transform="rotate(180)"></path>
                                    </svg>
                                    <svg class="w-3 h-3 <?= ($current_sort ?? '') === 'nama_dosen' && ($current_order ?? '') === 'DESC' ? 'text-blue-600' : 'text-gray-400' ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </th>
                        <th class="sortable cursor-pointer hover:bg-gray-100" data-sort="hari">
                            <div class="flex items-center justify-between">
                                <span>Hari</span>
                                <div class="flex flex-col">
                                    <svg class="w-3 h-3 <?= ($current_sort ?? '') === 'hari' && ($current_order ?? '') === 'ASC' ? 'text-blue-600' : 'text-gray-400' ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd" transform="rotate(180)"></path>
                                    </svg>
                                    <svg class="w-3 h-3 <?= ($current_sort ?? '') === 'hari' && ($current_order ?? '') === 'DESC' ? 'text-blue-600' : 'text-gray-400' ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </th>
                        <th class="sortable cursor-pointer hover:bg-gray-100" data-sort="jam">
                            <div class="flex items-center justify-between">
                                <span>Jam</span>
                                <div class="flex flex-col">
                                    <svg class="w-3 h-3 <?= ($current_sort ?? '') === 'jam' && ($current_order ?? '') === 'ASC' ? 'text-blue-600' : 'text-gray-400' ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd" transform="rotate(180)"></path>
                                    </svg>
                                    <svg class="w-3 h-3 <?= ($current_sort ?? '') === 'jam' && ($current_order ?? '') === 'DESC' ? 'text-blue-600' : 'text-gray-400' ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </th>
                        <th class="sortable cursor-pointer hover:bg-gray-100" data-sort="nama_ruangan">
                            <div class="flex items-center justify-between">
                                <span>Ruangan</span>
                                <div class="flex flex-col">
                                    <svg class="w-3 h-3 <?= ($current_sort ?? '') === 'nama_ruangan' && ($current_order ?? '') === 'ASC' ? 'text-blue-600' : 'text-gray-400' ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd" transform="rotate(180)"></path>
                                    </svg>
                                    <svg class="w-3 h-3 <?= ($current_sort ?? '') === 'nama_ruangan' && ($current_order ?? '') === 'DESC' ? 'text-blue-600' : 'text-gray-400' ?>" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                        </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php if (!empty($jadwal)): ?>
                        <?php foreach ($jadwal as $index => $jdw): ?>
                            <tr data-hari="<?= strtolower(esc($jdw['hari'])) ?>" class="hover:bg-gray-50" data-index="<?= $index + 1 ?>">
                                <td class="font-medium text-center"><?= $index + 1 ?></td>
                                <td class="font-medium"><?= esc($jdw['nama_kelas']) ?></td>
                                <td><?= esc($jdw['nama_mata_kuliah'] ?? 'N/A') ?></td>
                                <td><?= esc($jdw['nama_dosen'] ?? 'N/A') ?></td>
                                <td><?= esc($jdw['hari']) ?></td>
                                <td><?= esc($jdw['jam']) ?></td>
                                <td><?= esc($jdw['nama_ruangan'] ?? 'N/A') ?></td>
                                <td>
                                    <div class="flex space-x-2">
                                        <button onclick="editJadwal('<?= esc($jdw['id']) ?>')"
                                            class="action-button text-blue-600 hover:text-blue-800">
                                            Edit
                                        </button>
                                        <button onclick="deleteJadwal('<?= esc($jdw['id']) ?>')"
                                            class="action-button delete text-red-600 hover:text-red-800">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data jadwal
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination (Preline Style) -->
        <div class="hs-datatable-pagination">
            <div class="hs-datatable-info">
                Showing <span id="start-entry">1</span> to <span id="end-entry"><?= count($jadwal ?? []) ?></span> of <span id="total-entries"><?= count($jadwal ?? []) ?></span> entries
            </div>
            <div class="hs-datatable-nav">
                <button id="prev-btn" disabled>Previous</button>
                <div id="page-numbers" class="flex gap-1"></div>
                <button id="next-btn" disabled>Next</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Jadwal -->
<div id="addJadwalModal" class="admin-modal fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-4xl mx-4 transform transition-all duration-300 scale-95 opacity-0 relative" id="jadwalModalContent">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 border-b border-gray-200">
            <h3 id="modalTitle" class="text-xl font-semibold text-gray-900">Tambah Jadwal</h3>
            <button onclick="closeJadwalModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Modal Body -->
        <div class="p-6">
            <form id="addJadwalForm">
                <input type="hidden" id="jadwal_id" name="jadwal_id">
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Nama Kelas Field -->
                    <div class="md:col-span-2 lg:col-span-3">
                        <label for="nama_kelas" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Kelas <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_kelas" name="nama_kelas" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                            placeholder="Masukkan nama kelas (contoh: TI-1A, SI-2B)">
                        <div id="nama_kelas-error" class="text-red-500 text-sm mt-2 hidden"></div>
                    </div>

                    <!-- Mata Kuliah Field -->
                    <div>
                        <label for="id_mata_kuliah" class="block text-sm font-semibold text-gray-700 mb-2">
                            Mata Kuliah <span class="text-red-500">*</span>
                        </label>
                        <select id="id_mata_kuliah" name="id_mata_kuliah" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            <option value="">Pilih Mata Kuliah</option>
                            <!-- Options will be loaded via AJAX -->
                        </select>
                        <div id="id_mata_kuliah-error" class="text-red-500 text-sm mt-2 hidden"></div>
                    </div>

                    <!-- Dosen Field -->
                    <div>
                        <label for="nidn" class="block text-sm font-semibold text-gray-700 mb-2">
                            Dosen <span class="text-red-500">*</span>
                        </label>
                        <select id="nidn" name="nidn" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            <option value="">Pilih Dosen</option>
                            <!-- Options will be loaded via AJAX -->
                        </select>
                        <div id="nidn-error" class="text-red-500 text-sm mt-2 hidden"></div>
                    </div>

                    <!-- Hari Field -->
                    <div>
                        <label for="hari" class="block text-sm font-semibold text-gray-700 mb-2">
                            Hari <span class="text-red-500">*</span>
                        </label>
                        <select id="hari" name="hari" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            <option value="">Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                        <div id="hari-error" class="text-red-500 text-sm mt-2 hidden"></div>
                    </div>

                    <!-- Jam Field -->
                    <div>
                        <label for="jam" class="block text-sm font-semibold text-gray-700 mb-2">
                            Jam <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="jam" name="jam" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                            placeholder="Contoh: 08:00-10:00">
                        <div id="jam-error" class="text-red-500 text-sm mt-2 hidden"></div>
                    </div>

                    <!-- Ruangan Field -->
                    <div class="md:col-span-2 lg:col-span-3">
                        <label for="id_ruangan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Ruangan <span class="text-red-500">*</span>
                        </label>
                        <select id="id_ruangan" name="id_ruangan" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            <option value="">Pilih Ruangan</option>
                            <!-- Options will be loaded via AJAX -->
                        </select>
                        <div id="id_ruangan-error" class="text-red-500 text-sm mt-2 hidden"></div>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- Modal Footer -->
        <div class="flex justify-end space-x-3 p-6 border-t border-gray-200">
            <button type="button" onclick="closeJadwalModal()"
                class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                Batal
            </button>
            <button type="submit" form="addJadwalForm" id="submitJadwalBtn"
                class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                <svg id="submitIcon" class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                <span id="submitText">Simpan</span>
            </button>
        </div>
    </div>
</div>

<!-- Modal Delete Confirmation -->
<div id="deleteJadwalModal" class="admin-modal fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0 relative" id="deleteJadwalModalContent">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 border-b border-gray-200">
            <div class="flex items-center">
                <div class="flex-shrink-0 w-10 h-10 mx-auto bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h3 class="ml-4 text-lg font-semibold text-gray-900">Konfirmasi Hapus</h3>
            </div>
            <button onclick="closeDeleteJadwalModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Modal Body -->
        <div class="p-6">
            <div class="text-center">
                <p class="text-gray-600 mb-2">Apakah Anda yakin ingin menghapus jadwal:</p>
                <p class="font-semibold text-gray-900 text-lg mb-1" id="deleteJadwalInfo">-</p>
                <p class="text-sm text-red-600">Data yang dihapus tidak dapat dikembalikan!</p>
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="flex justify-end space-x-3 p-6 border-t border-gray-200">
            <button type="button" onclick="confirmDeleteJadwal()" id="confirmDeleteJadwalBtn"
                class="px-6 py-2.5 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Hapus
            </button>
            <button type="button" onclick="closeDeleteJadwalModal()"
                class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                Batal
            </button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Preline components manually
    if (typeof window.HSDropdown !== 'undefined') {
        window.HSDropdown.autoInit();
        console.log('Preline HSDropdown initialized');
    } else {
        console.log('Preline HSDropdown not available, using manual implementation');
    }
    
    // DataTable functionality
    const searchInput = document.getElementById('search-input');
    const entriesSelect = document.getElementById('entries-select');
    const tableBody = document.getElementById('table-body');
    const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
    
    // Pagination elements
    const startEntry = document.getElementById('start-entry');
    const endEntry = document.getElementById('end-entry');
    const totalEntries = document.getElementById('total-entries');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    
    // Manual dropdown functionality as fallback
    const filterDropdown = document.getElementById('filter-dropdown');
    const dropdownMenu = document.getElementById('filter-menu');
    const filterArrow = document.getElementById('filter-arrow');
    
    // Sorting functionality
    const sortableHeaders = document.querySelectorAll('.sortable');
    
    sortableHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const sortField = this.getAttribute('data-sort');
            const currentSort = '<?= $current_sort ?? '' ?>';
            const currentOrder = '<?= $current_order ?? '' ?>';
            
            let newOrder = 'ASC';
            
            // If clicking the same column, toggle the order
            if (sortField === currentSort) {
                newOrder = currentOrder === 'ASC' ? 'DESC' : 'ASC';
            }
            
            // Redirect with new sort parameters
            const url = new URL(window.location);
            url.searchParams.set('sort_by', sortField);
            url.searchParams.set('sort_order', newOrder);
            window.location.href = url.toString();
        });
    });
    
    // Toggle dropdown manually
    filterDropdown.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const isHidden = dropdownMenu.classList.contains('hidden');
        
        if (isHidden) {
            dropdownMenu.classList.remove('hidden');
            filterArrow.style.transform = 'rotate(180deg)';
            filterDropdown.setAttribute('aria-expanded', 'true');
        } else {
            dropdownMenu.classList.add('hidden');
            filterArrow.style.transform = 'rotate(0deg)';
            filterDropdown.setAttribute('aria-expanded', 'false');
        }
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!filterDropdown.contains(e.target) && !dropdownMenu.contains(e.target)) {
            dropdownMenu.classList.add('hidden');
            filterArrow.style.transform = 'rotate(0deg)';
            filterDropdown.setAttribute('aria-expanded', 'false');
        }
    });
    
    // Prevent dropdown from closing when clicking inside
    dropdownMenu.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    
    let currentPage = 1;
    let entriesPerPage = 10;
    let filteredRows = [];
    let allRows = Array.from(tableBody.querySelectorAll('tr'));
    
    // Initialize filtered rows
    filteredRows = [...allRows];
    
    // Initialize display
    updateDisplay();
    
    // Search functionality
    searchInput.addEventListener('input', function() {
        applyFilters();
    });
    
    // Entries per page
    entriesSelect.addEventListener('change', function() {
        entriesPerPage = parseInt(this.value);
        currentPage = 1;
        updateDisplay();
    });
    
    // Filter functionality
    filterCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            handleFilterChange(this);
        });
    });
    
    // Pagination buttons
    prevBtn.addEventListener('click', function() {
        if (currentPage > 1) {
            currentPage--;
            updateDisplay();
        }
    });
    
    nextBtn.addEventListener('click', function() {
        const totalPages = Math.ceil(filteredRows.length / entriesPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            updateDisplay();
        }
    });

    function handleFilterChange(checkbox) {
        const allCheckbox = document.querySelector('.filter-checkbox[value="all"]');
        
        if (checkbox.value === 'all' && checkbox.checked) {
            // If "Semua Hari" is checked, uncheck all other filters
            filterCheckboxes.forEach(cb => {
                if (cb.value !== 'all') cb.checked = false;
            });
        } else if (checkbox.value !== 'all' && checkbox.checked) {
            // If any specific day is checked, uncheck "Semua Hari"
            if (allCheckbox) allCheckbox.checked = false;
        }

        // If no specific filters are checked, default to "Semua Hari"
        const hasSpecificFilter = Array.from(filterCheckboxes)
            .some(cb => cb.value !== 'all' && cb.checked);
        
        if (!hasSpecificFilter && allCheckbox && !allCheckbox.checked) {
            allCheckbox.checked = true;
        }

        applyFilters();
    }

    function applyFilters() {
        const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
        const allChecked = document.querySelector('.filter-checkbox[value="all"]')?.checked || false;
        
        const selectedDays = Array.from(filterCheckboxes)
            .filter(cb => cb.checked && cb.value !== 'all')
            .map(cb => cb.value);

        filteredRows = allRows.filter(row => {
            const rowHari = row.getAttribute('data-hari');
            const text = row.textContent.toLowerCase();

            // Check if row matches search term
            const matchesSearch = searchTerm === '' || text.includes(searchTerm);

            // Check if row matches day filter
            let matchesDay = false;
            
            if (allChecked || selectedDays.length === 0) {
                // If "Semua Hari" is checked or no specific days selected, show all days
                matchesDay = true;
            } else {
                // Check if row's day is in selected days
                matchesDay = selectedDays.includes(rowHari);
            }

            return matchesSearch && matchesDay;
        });

        currentPage = 1;
        updateDisplay();
    }

    function updateDisplay() {
        displayRows();
        updatePagination();
    }
    
    function displayRows() {
        // Hide all rows first
        allRows.forEach(row => {
            row.style.display = 'none';
        });
        
        // Calculate which rows to show
        const startIndex = (currentPage - 1) * entriesPerPage;
        const endIndex = startIndex + entriesPerPage;
        const rowsToShow = filteredRows.slice(startIndex, endIndex);
        
        // Update row numbers and show the rows for current page
        rowsToShow.forEach((row, index) => {
            row.style.display = '';
            // Update the number in the first cell
            const numberCell = row.querySelector('td:first-child');
            if (numberCell) {
                numberCell.textContent = startIndex + index + 1;
            }
        });
    }
    
    function updatePagination() {
        const totalRows = filteredRows.length;
        const totalPages = Math.ceil(totalRows / entriesPerPage);
        const startIndex = (currentPage - 1) * entriesPerPage + 1;
        const endIndex = Math.min(currentPage * entriesPerPage, totalRows);
        
        startEntry.textContent = totalRows > 0 ? startIndex : 0;
        endEntry.textContent = endIndex;
        totalEntries.textContent = totalRows;
        
        prevBtn.disabled = currentPage <= 1;
        nextBtn.disabled = currentPage >= totalPages || totalPages === 0;

        // Generate page numbers
        const pageNumbers = document.getElementById('page-numbers');
        pageNumbers.innerHTML = '';

        if (totalPages > 1) {
            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            // Adjust start page if we're near the end
            if (endPage - startPage + 1 < maxVisiblePages) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }

            // Add first page and ellipsis if needed
            if (startPage > 1) {
                addPageButton(1, false);
                if (startPage > 2) {
                    pageNumbers.appendChild(createEllipsis());
                }
            }

            // Add visible page numbers
            for (let i = startPage; i <= endPage; i++) {
                addPageButton(i, i === currentPage);
            }

            // Add ellipsis and last page if needed
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    pageNumbers.appendChild(createEllipsis());
                }
                addPageButton(totalPages, false);
            }
        }
    }

    function addPageButton(pageNum, isActive) {
        const pageNumbers = document.getElementById('page-numbers');
        const button = document.createElement('button');
        button.textContent = pageNum;
        button.className = `px-3 py-1 text-sm border rounded ${
            isActive 
                ? 'bg-blue-600 text-white border-blue-600' 
                : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'
        }`;

        if (!isActive) {
            button.addEventListener('click', function() {
                currentPage = pageNum;
                updatePagination();
                displayRows();
            });
        }

        pageNumbers.appendChild(button);
    }

    function createEllipsis() {
        const span = document.createElement('span');
        span.textContent = '...';
        span.className = 'px-3 py-1 text-sm text-gray-500';
        return span;
    }
    
    // Form submission handler
    document.getElementById('addJadwalForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('submitJadwalBtn');
        const originalText = submitBtn.innerHTML;
        
        // Show loading state
        submitBtn.disabled = true;
        const loadingText = isEditMode ? 'Mengupdate...' : 'Menyimpan...';
        submitBtn.innerHTML = `
            <svg class="animate-spin w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            ${loadingText}
        `;
        
        // Clear previous errors
        clearJadwalErrors();
        
        // Get form data
        const formData = new FormData(this);
        
        // Debug: Log form data
        console.log('Form data being sent:');
        for (let [key, value] of formData.entries()) {
            console.log(key + ': ' + value);
        }
        
        // Determine URL and method based on mode
        let url = baseUrl + '/admin/jadwal';
        let method = 'POST';
        
        if (isEditMode && currentEditId) {
            url = baseUrl + '/admin/jadwal/update/' + currentEditId;
            method = 'POST';
        }
        
        // Submit via AJAX
        fetch(url, {
            method: method,
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                // Close modal
                closeJadwalModal();
                
                // Show success message
                const successMessage = isEditMode ? 'Jadwal berhasil diupdate!' : 'Jadwal berhasil ditambahkan!';
                showSuccess(successMessage);
                
                // Reload page to show updated data
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            } else {
                // Show errors
                if (result.errors) {
                    Object.keys(result.errors).forEach(field => {
                        showJadwalError(field, result.errors[field]);
                    });
                } else if (result.message) {
                    showError('Error: ' + result.message);
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError('Terjadi kesalahan saat menyimpan data');
        })
        .finally(() => {
            // Reset button state
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });

    // Close modal when clicking backdrop
    document.getElementById('addJadwalModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeJadwalModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (e.ctrlKey && e.shiftKey) {
                // Emergency cleanup with Ctrl+Shift+Escape
                forceCloseAllModals();
            } else {
                // Normal escape
                const modal = document.getElementById('addJadwalModal');
                const deleteModal = document.getElementById('deleteJadwalModal');
                
                if (!modal.classList.contains('hidden')) {
                    closeJadwalModal();
                } else if (!deleteModal.classList.contains('hidden')) {
                    closeDeleteJadwalModal();
                }
            }
        }
    });
});

// Configuration
const baseUrl = '<?= base_url() ?>';

// Global variables
let isModalOpen = false;
let isEditMode = false;
let currentEditId = null;

// Modal functions
function openJadwalModal(jadwalId = null) {
    // Prevent opening multiple modals
    if (isModalOpen) return;
    
    const modal = document.getElementById('addJadwalModal');
    const modalContent = document.getElementById('jadwalModalContent');
    
    // Set modal state
    isModalOpen = true;
    isEditMode = jadwalId !== null;
    currentEditId = jadwalId;
    
    // Reset form
    document.getElementById('addJadwalForm').reset();
    clearJadwalErrors();
    
    // Set modal title and button based on mode
    const modalTitle = document.getElementById('modalTitle');
    const submitBtn = document.getElementById('submitJadwalBtn');
    const submitText = document.getElementById('submitText');
    const submitIcon = document.getElementById('submitIcon');
    
    if (isEditMode) {
        modalTitle.textContent = 'Edit Jadwal';
        submitText.textContent = 'Update';
        submitBtn.className = 'px-6 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors';
        submitIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>';
    } else {
        modalTitle.textContent = 'Tambah Jadwal';
        submitText.textContent = 'Simpan';
        submitBtn.className = 'px-6 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors';
        submitIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>';
    }
    
    // Load dropdown data first, then load jadwal data if editing
    loadDropdownData().then(() => {
        if (isEditMode) {
            loadJadwalData(jadwalId);
        }
    });
    
    // Add event listeners for real-time conflict checking
    setTimeout(() => {
        const conflictFields = ['id_ruangan', 'nidn', 'hari', 'jam'];
        conflictFields.forEach(fieldId => {
            const field = document.getElementById(fieldId);
            if (field) {
                field.addEventListener('change', checkScheduleConflict);
                field.addEventListener('blur', checkScheduleConflict);
            }
        });
    }, 600); // Wait for dropdowns to load
    
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
    
    // Focus on first input
    setTimeout(() => {
        document.getElementById('nama_kelas').focus();
    }, 100);
}

function closeJadwalModal() {
    const modal = document.getElementById('addJadwalModal');
    const modalContent = document.getElementById('jadwalModalContent');
    
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
        
        // Reset modal state
        isModalOpen = false;
        isEditMode = false;
        currentEditId = null;
        
        // Force a small delay then reset display
        setTimeout(() => {
            modal.style.display = '';
        }, 50);
    }, 300);
}

// Load jadwal data for editing
function loadJadwalData(jadwalId) {
    console.log('=== Loading jadwal data for ID:', jadwalId, '===');
    
    fetch(baseUrl + '/admin/jadwal/' + jadwalId, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        console.log('Jadwal response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Jadwal data received:', data);
        if (data.success && data.data) {
            const jadwal = data.data;
            
            // Populate form fields immediately
            document.getElementById('jadwal_id').value = jadwal.id || '';
            document.getElementById('nama_kelas').value = jadwal.nama_kelas || '';
            document.getElementById('hari').value = jadwal.hari || '';
            document.getElementById('jam').value = jadwal.jam || '';
            
            console.log('Form fields populated');
            
            // Set dropdown values immediately (dropdowns are already loaded)
            if (jadwal.id_mata_kuliah) {
                const mataKuliahSelect = document.getElementById('id_mata_kuliah');
                console.log('Available Mata Kuliah options:', mataKuliahSelect.options.length);
                console.log('Trying to set Mata Kuliah to:', jadwal.id_mata_kuliah);
                
                // Log all available options
                for (let i = 0; i < mataKuliahSelect.options.length; i++) {
                    console.log(`  Option ${i}: value="${mataKuliahSelect.options[i].value}"`);
                }
                
                mataKuliahSelect.value = jadwal.id_mata_kuliah;
                const found = mataKuliahSelect.value === jadwal.id_mata_kuliah.toString();
                console.log('Set Mata Kuliah - Expected:', jadwal.id_mata_kuliah, 'Actual:', mataKuliahSelect.value, 'Found:', found);
                
                if (!found) {
                    console.error('⚠️ Mata Kuliah value not found in dropdown!');
                }
            }
            
            if (jadwal.nidn) {
                const dosenSelect = document.getElementById('nidn');
                console.log('Available Dosen options:', dosenSelect.options.length);
                console.log('Trying to set Dosen to:', jadwal.nidn);
                
                // Log all available options
                for (let i = 0; i < dosenSelect.options.length; i++) {
                    console.log(`  Option ${i}: value="${dosenSelect.options[i].value}"`);
                }
                
                dosenSelect.value = jadwal.nidn;
                const found = dosenSelect.value === jadwal.nidn.toString();
                console.log('Set Dosen - Expected:', jadwal.nidn, 'Actual:', dosenSelect.value, 'Found:', found);
                
                if (!found) {
                    console.error('⚠️ Dosen value not found in dropdown!');
                }
            }
            
            if (jadwal.id_ruangan) {
                const ruanganSelect = document.getElementById('id_ruangan');
                console.log('Available Ruangan options:', ruanganSelect.options.length);
                console.log('Trying to set Ruangan to:', jadwal.id_ruangan);
                
                ruanganSelect.value = jadwal.id_ruangan;
                const found = ruanganSelect.value === jadwal.id_ruangan.toString();
                console.log('Set Ruangan - Expected:', jadwal.id_ruangan, 'Actual:', ruanganSelect.value, 'Found:', found);
                
                if (!found) {
                    console.error('⚠️ Ruangan value not found in dropdown!');
                }
            }
            
            console.log('=== ✓ Jadwal data loaded and form populated ===');
        } else {
            console.error('Invalid jadwal data:', data);
            showError('Gagal memuat data jadwal');
        }
    })
    .catch(error => {
        console.error('=== ✗ Error loading jadwal data ===', error);
        showError('Terjadi kesalahan saat memuat data jadwal');
    });
}



// Load dropdown data
function loadDropdownData() {
    console.log('=== Starting loadDropdownData ===');
    console.log('Base URL:', baseUrl);
    
    // Show loading state
    const mataKuliahSelect = document.getElementById('id_mata_kuliah');
    const dosenSelect = document.getElementById('nidn');
    const ruanganSelect = document.getElementById('id_ruangan');
    
    mataKuliahSelect.innerHTML = '<option value="">Loading...</option>';
    dosenSelect.innerHTML = '<option value="">Loading...</option>';
    ruanganSelect.innerHTML = '<option value="">Loading...</option>';
    
    // Return a Promise that resolves when all dropdowns are loaded
    const mataKuliahPromise = fetch(baseUrl + '/admin/jadwal/getMataKuliah', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        console.log('Mata Kuliah response status:', response.status);
        console.log('Mata Kuliah response headers:', response.headers.get('content-type'));
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        // Clone response to read it twice
        const clonedResponse = response.clone();
        return response.text().then(text => {
            console.log('Raw response text:', text.substring(0, 500)); // First 500 chars
            try {
                return JSON.parse(text);
            } catch (e) {
                console.error('Failed to parse JSON:', e);
                console.error('Full response:', text);
                throw new Error('Invalid JSON response');
            }
        });
    })
    .then(data => {
        console.log('Mata Kuliah data received:', data);
        console.log('Data type:', typeof data);
        console.log('Data keys:', Object.keys(data));
        console.log('data.success:', data.success);
        console.log('data.data:', data.data);
        console.log('Is data.data an array?', Array.isArray(data.data));
        
        const select = document.getElementById('id_mata_kuliah');
        select.innerHTML = '<option value="">Pilih Mata Kuliah</option>';
        
        if (data.success && data.data && Array.isArray(data.data)) {
            console.log('Processing', data.data.length, 'mata kuliah items');
            data.data.forEach(mk => {
                const option = document.createElement('option');
                option.value = mk.id_mata_kuliah;
                option.textContent = `${mk.kode_mata_kuliah} - ${mk.nama_mata_kuliah}`;
                select.appendChild(option);
            });
            console.log('✓ Mata Kuliah loaded:', data.data.length, 'items');
        } else {
            console.error('Invalid mata kuliah data structure:', data);
            console.error('Full data object:', JSON.stringify(data, null, 2));
        }
    })
    .catch(error => {
        console.error('✗ Error loading mata kuliah:', error);
        const select = document.getElementById('id_mata_kuliah');
        select.innerHTML = '<option value="">Error loading data</option>';
        throw error;
    });
    
    // Load Dosen
    const dosenPromise = fetch(baseUrl + '/admin/jadwal/getDosen', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        console.log('Dosen response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Dosen data received:', data);
        const select = document.getElementById('nidn');
        select.innerHTML = '<option value="">Pilih Dosen</option>';
        
        if (data.success && data.data && Array.isArray(data.data)) {
            console.log('Processing', data.data.length, 'dosen items');
            data.data.forEach(dosen => {
                const option = document.createElement('option');
                option.value = dosen.nidn;
                option.textContent = `${dosen.nidn} - ${dosen.nama}`;
                select.appendChild(option);
            });
            console.log('✓ Dosen loaded:', data.data.length, 'items');
        } else {
            console.error('Invalid dosen data structure:', data);
        }
    })
    .catch(error => {
        console.error('✗ Error loading dosen:', error);
        const select = document.getElementById('nidn');
        select.innerHTML = '<option value="">Error loading data</option>';
        throw error;
    });
    
    // Load Ruangan
    const ruanganPromise = fetch(baseUrl + '/admin/jadwal/getRuangan', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        console.log('Ruangan response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Ruangan data received:', data);
        const select = document.getElementById('id_ruangan');
        select.innerHTML = '<option value="">Pilih Ruangan</option>';
        
        if (data.success && data.data && Array.isArray(data.data)) {
            console.log('Processing', data.data.length, 'ruangan items');
            data.data.forEach(ruangan => {
                const option = document.createElement('option');
                option.value = ruangan.id_ruangan;
                option.textContent = ruangan.nama_ruangan;
                select.appendChild(option);
            });
            console.log('✓ Ruangan loaded:', data.data.length, 'items');
        } else {
            console.error('Invalid ruangan data structure:', data);
        }
    })
    .catch(error => {
        console.error('✗ Error loading ruangan:', error);
        const select = document.getElementById('id_ruangan');
        select.innerHTML = '<option value="">Error loading data</option>';
        throw error;
    });
    
    // Wait for all dropdowns to load
    return Promise.all([mataKuliahPromise, dosenPromise, ruanganPromise])
        .then(() => {
            console.log('=== ✓ All dropdowns loaded successfully ===');
        })
        .catch(error => {
            console.error('=== ✗ Error loading one or more dropdowns ===', error);
            // Don't throw, allow partial success
        });
}



// Check for schedule conflicts in real-time
function checkScheduleConflict() {
    const ruanganId = document.getElementById('id_ruangan').value;
    const nidn = document.getElementById('nidn').value;
    const hari = document.getElementById('hari').value;
    const jam = document.getElementById('jam').value;
    
    // Clear previous warnings
    clearConflictWarnings();
    
    // Only check if all required fields are filled
    if (!ruanganId || !nidn || !hari || !jam) {
        return;
    }
    
    const data = {
        id_ruangan: ruanganId,
        nidn: nidn,
        hari: hari,
        jam: jam,
        exclude_id: isEditMode ? currentEditId : null
    };
    
    fetch(baseUrl + '/admin/jadwal/checkConflict', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.conflicts && Object.keys(result.conflicts).length > 0) {
            showConflictWarnings(result.conflicts);
        } else {
            // No conflicts found, show positive feedback
            showNoConflictFeedback();
        }
    })
    .catch(error => {
        console.error('Error checking conflicts:', error);
        // Show a subtle error indicator
        const fields = ['id_ruangan', 'nidn'];
        fields.forEach(field => {
            const fieldElement = document.getElementById(field);
            if (fieldElement) {
                fieldElement.className = fieldElement.className.replace(
                    'border-gray-300', 'border-gray-400'
                );
            }
        });
    });
}

function showConflictWarnings(conflicts) {
    Object.keys(conflicts).forEach(field => {
        const fieldElement = document.getElementById(field);
        const errorElement = document.getElementById(field + '-error');
        
        if (fieldElement && errorElement) {
            // Show warning styling (orange instead of red)
            fieldElement.className = fieldElement.className.replace(
                'border-gray-300', 'border-orange-500'
            ).replace(
                'focus:border-blue-500', 'focus:border-orange-500'
            ).replace(
                'focus:ring-blue-500', 'focus:ring-orange-500'
            );
            
            // Handle both old string format and new object format
            let conflictData = conflicts[field];
            let formattedMessage = '';
            
            if (typeof conflictData === 'object' && conflictData.type === 'conflict') {
                // New structured format
                const detailsList = Object.entries(conflictData.details)
                    .map(([key, value]) => `<li class="ml-4">• <span class="font-medium">${key}:</span> ${value}</li>`)
                    .join('');
                
                formattedMessage = `
                    <div class="space-y-2">
                        <div class="font-semibold text-orange-800">${conflictData.title}</div>
                        <div class="text-orange-700">${conflictData.message}</div>
                        <div class="text-sm">
                            <div class="font-medium text-orange-800 mb-1">Detail konflik:</div>
                            <ul class="space-y-1">${detailsList}</ul>
                        </div>
                    </div>
                `;
            } else {
                // Fallback for old string format
                formattedMessage = typeof conflictData === 'string' 
                    ? conflictData.replace(/\n•/g, '<br>•') 
                    : String(conflictData);
            }
            
            errorElement.innerHTML = `
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 mt-0.5">
                        <svg class="w-5 h-5 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        ${formattedMessage}
                    </div>
                </div>
            `;
            errorElement.className = 'mt-2 p-4 bg-gradient-to-r from-orange-50 to-yellow-50 border-l-4 border-orange-400 rounded-r-md shadow-sm';
            errorElement.classList.remove('hidden');
        }
    });
}

function clearConflictWarnings() {
    const fields = ['id_ruangan', 'nidn'];
    
    fields.forEach(field => {
        const fieldElement = document.getElementById(field);
        const errorElement = document.getElementById(field + '-error');
        
        if (fieldElement) {
            // Reset to normal styling
            fieldElement.className = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors';
        }
        
        if (errorElement) {
            errorElement.classList.add('hidden');
            errorElement.innerHTML = '';
            errorElement.className = 'text-red-500 text-sm mt-2 hidden';
        }
    });
}

// Add helper function to show success feedback when no conflicts
function showNoConflictFeedback() {
    const fields = ['id_ruangan', 'nidn'];
    
    fields.forEach(field => {
        const fieldElement = document.getElementById(field);
        
        if (fieldElement && fieldElement.value) {
            // Show green border for no conflicts
            fieldElement.className = fieldElement.className.replace(
                'border-gray-300', 'border-green-400'
            ).replace(
                'border-orange-500', 'border-green-400'
            ).replace(
                'focus:border-blue-500', 'focus:border-green-500'
            ).replace(
                'focus:ring-blue-500', 'focus:ring-green-500'
            );
        }
    });
    
    // Auto-reset to normal after 2 seconds
    setTimeout(() => {
        fields.forEach(field => {
            const fieldElement = document.getElementById(field);
            if (fieldElement) {
                fieldElement.className = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors';
            }
        });
    }, 2000);
}

// Emergency cleanup function
function forceCloseAllModals() {
    const modal = document.getElementById('addJadwalModal');
    const modalContent = document.getElementById('jadwalModalContent');
    const deleteModal = document.getElementById('deleteJadwalModal');
    const deleteModalContent = document.getElementById('deleteJadwalModalContent');
    
    // Force hide add/edit modal
    if (modal) {
        modal.classList.add('hidden');
        modal.removeAttribute('style');
        modal.style.display = 'none';
    }
    
    if (modalContent) {
        modalContent.removeAttribute('style');
    }
    
    // Force hide delete modal
    if (deleteModal) {
        deleteModal.classList.add('hidden');
        deleteModal.removeAttribute('style');
        deleteModal.style.display = 'none';
    }
    
    if (deleteModalContent) {
        deleteModalContent.removeAttribute('style');
    }
    
    // Clean up body
    document.body.classList.remove('modal-open');
    document.body.style.overflow = '';
    document.body.style.filter = '';
    
    // Reset state
    isModalOpen = false;
    isEditMode = false;
    currentEditId = null;
    isDeleteJadwalModalOpen = false;
    currentDeleteJadwalId = null;
    
    console.log('Force closed all modals');
}

// Helper functions
function clearJadwalErrors() {
    const errorFields = ['nama_kelas', 'id_mata_kuliah', 'nidn', 'hari', 'jam', 'id_ruangan'];
    
    errorFields.forEach(field => {
        const errorElement = document.getElementById(field + '-error');
        const inputElement = document.getElementById(field);
        
        if (errorElement) {
            errorElement.classList.add('hidden');
            errorElement.textContent = '';
        }
        
        if (inputElement) {
            if (inputElement.tagName === 'SELECT') {
                inputElement.className = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors';
            } else {
                inputElement.className = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors';
            }
        }
    });
}

function showJadwalError(fieldId, message) {
    const errorElement = document.getElementById(fieldId + '-error');
    const inputElement = document.getElementById(fieldId);
    
    if (errorElement) {
        let formattedMessage = '';
        
        // Handle both old string format and new object format
        if (typeof message === 'object' && message.type === 'conflict') {
            // New structured format
            const detailsList = Object.entries(message.details)
                .map(([key, value]) => `<li class="ml-4">• <span class="font-medium">${key}:</span> ${value}</li>`)
                .join('');
            
            formattedMessage = `
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 mt-0.5">
                        <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="space-y-2">
                            <div class="font-semibold text-red-800">${message.title}</div>
                            <div class="text-red-700">${message.message}</div>
                            <div class="text-sm">
                                <div class="font-medium text-red-800 mb-1">Detail konflik:</div>
                                <ul class="space-y-1">${detailsList}</ul>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        } else {
            // Fallback for old string format
            const messageText = typeof message === 'string' ? message.replace(/\n•/g, '<br>•') : String(message);
            formattedMessage = `
                <div class="flex items-start space-x-2">
                    <svg class="w-4 h-4 text-red-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <div class="text-red-700 text-sm">${messageText}</div>
                </div>
            `;
        }
        
        errorElement.innerHTML = formattedMessage;
        errorElement.classList.remove('hidden');
        errorElement.className = 'mt-2 p-4 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-400 rounded-r-md shadow-sm';
    }
    
    if (inputElement) {
        if (inputElement.tagName === 'SELECT') {
            inputElement.className = 'w-full px-4 py-3 border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors';
        } else {
            inputElement.className = 'w-full px-4 py-3 border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors';
        }
    }
}



function editJadwal(id) {
    console.log('Edit Jadwal clicked for ID:', id);
    openJadwalModal(id);
}

// Delete Modal Functions
let currentDeleteJadwalId = null;
let isDeleteJadwalModalOpen = false;

function deleteJadwal(id) {
    // Get jadwal data first to show in modal
    fetch(baseUrl + '/admin/jadwal/' + id, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.data) {
            const jadwal = data.data;
            
            // Debug: Log the actual data structure
            console.log('Jadwal data received:', jadwal);
            
            // Build jadwal info with safe checks
            let jadwalInfo = '';
            
            // Add mata kuliah (with fallback)
            if (jadwal.mata_kuliah) {
                jadwalInfo += jadwal.mata_kuliah;
            } else if (jadwal.nama_mata_kuliah) {
                jadwalInfo += jadwal.nama_mata_kuliah;
            } else {
                jadwalInfo += 'Mata Kuliah';
            }
            
            // Add nama kelas if available
            if (jadwal.nama_kelas) {
                jadwalInfo += ` (${jadwal.nama_kelas})`;
            }
            
            // Add hari and jam with fallbacks
            const hari = jadwal.hari || 'Hari';
            const jam = jadwal.jam || jadwal.waktu || 'Waktu';
            jadwalInfo += ` - ${hari} ${jam}`;
            
            console.log('Final jadwal info:', jadwalInfo);
            openDeleteJadwalModal(id, jadwalInfo);
        } else {
            // Fallback jika gagal load data
            openDeleteJadwalModal(id, 'Jadwal');
        }
    })
    .catch(error => {
        console.error('Error loading jadwal data:', error);
        // Fallback jika gagal load data
        openDeleteJadwalModal(id, 'Jadwal');
    });
}

function openDeleteJadwalModal(id, info) {
    if (isDeleteJadwalModalOpen) return;
    
    const modal = document.getElementById('deleteJadwalModal');
    const modalContent = document.getElementById('deleteJadwalModalContent');
    
    // Set modal state
    isDeleteJadwalModalOpen = true;
    currentDeleteJadwalId = id;
    
    // Populate modal content
    document.getElementById('deleteJadwalInfo').textContent = info;
    
    // Ensure modal is appended to body root
    if (modal.parentNode !== document.body) {
        document.body.appendChild(modal);
    }
    
    // Lock body scroll
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
}

function closeDeleteJadwalModal() {
    const modal = document.getElementById('deleteJadwalModal');
    const modalContent = document.getElementById('deleteJadwalModalContent');
    
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
        
        // Reset modal state
        isDeleteJadwalModalOpen = false;
        currentDeleteJadwalId = null;
        
        // Force a small delay then reset display
        setTimeout(() => {
            modal.style.display = '';
        }, 50);
    }, 300);
}

function confirmDeleteJadwal() {
    if (!currentDeleteJadwalId) return;
    
    const confirmBtn = document.getElementById('confirmDeleteJadwalBtn');
    const originalText = confirmBtn.innerHTML;
    
    // Show loading state
    confirmBtn.disabled = true;
    confirmBtn.innerHTML = `
        <svg class="animate-spin w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
        </svg>
        Menghapus...
    `;
    
    // Send delete request
    fetch(baseUrl + '/admin/jadwal/' + currentDeleteJadwalId, {
        method: 'DELETE',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            // Close modal first
            closeDeleteJadwalModal();
            
            // Show success toast
            showToast('Jadwal berhasil dihapus!', 'success');
            
            // Reload page to show updated data
            setTimeout(() => {
                window.location.reload();
            }, 1000);
        } else {
            showToast('Error: ' + (result.message || 'Gagal menghapus jadwal'), 'error');
            
            // Reset button state
            confirmBtn.disabled = false;
            confirmBtn.innerHTML = originalText;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan saat menghapus data', 'error');
        
        // Reset button state
        confirmBtn.disabled = false;
        confirmBtn.innerHTML = originalText;
    });
}

// Close delete modal when clicking backdrop
document.getElementById('deleteJadwalModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteJadwalModal();
    }
});
</script>
<?= $this->endSection() ?>