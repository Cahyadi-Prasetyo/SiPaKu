<?= $this->extend('layout/admin/main') ?>

<?php
// Helper function untuk menentukan kategori gelar dosen
function getDosenCategory($nama)
{
    $nama = strtolower($nama);

    if (strpos($nama, 'prof.') !== false) {
        return 'profesor';
    } elseif (strpos($nama, 'dr.') !== false) {
        return 'doktor';
    } elseif (strpos($nama, 'm.kom') !== false || strpos($nama, 'm.t') !== false || strpos($nama, 'm.sc') !== false) {
        return 'magister';
    } else {
        return 'magister'; // default untuk yang tidak ada gelar spesifik
    }
}
?>

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

    .action-button {
        color: #3b82f6;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        margin-right: 0.5rem;
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
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-wrapper p-6">
    <!-- Main DataTable Card -->
    <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <!-- Header dengan Action Button -->
        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Data Dosen</h2>
                <p class="text-sm text-gray-600">Kelola data dosen</p>
            </div>

            <div>
                <div class="inline-flex gap-x-2">
                    <button type="button" onclick="openDosenModal()" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="M12 5v14" />
                        </svg>
                        Tambah Dosen
                    </button>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <!-- DataTable Controls -->
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
                                <span class="ml-2 text-sm text-gray-700">Semua Gelar</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded cursor-pointer">
                                <input type="checkbox" class="filter-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="profesor">
                                <span class="ml-2 text-sm text-gray-700">Profesor</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded cursor-pointer">
                                <input type="checkbox" class="filter-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="doktor">
                                <span class="ml-2 text-sm text-gray-700">Doktor (Dr.)</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded cursor-pointer">
                                <input type="checkbox" class="filter-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="magister">
                                <span class="ml-2 text-sm text-gray-700">Magister</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-hidden">
            <table class="hs-datatable-table" id="dosen-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIDN</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php if (!empty($dosen)): ?>
                        <?php foreach ($dosen as $index => $dsn): ?>
                            <?php
                            $category = getDosenCategory($dsn['nama']);
                            ?>
                            <tr data-category="<?= $category ?>" class="hover:bg-gray-50" data-index="<?= $index + 1 ?>">
                                <td class="font-medium text-center"><?= $index + 1 ?></td>
                                <td class="font-medium"><?= esc($dsn['nidn']) ?></td>
                                <td><?= esc($dsn['nama']) ?></td>
                                <td>
                                    <div class="flex space-x-2">
                                        <button onclick="editDosen('<?= esc($dsn['nidn']) ?>')"
                                            class="action-button text-blue-600 hover:text-blue-800">
                                            Edit
                                        </button>
                                        <button onclick="deleteDosen('<?= esc($dsn['nidn']) ?>')"
                                            class="action-button delete text-red-600 hover:text-red-800">
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada data dosen
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="hs-datatable-pagination">
            <div class="hs-datatable-info">
                Showing <span id="start-entry">1</span> to <span id="end-entry"><?= count($dosen ?? []) ?></span> of <span id="total-entries"><?= count($dosen ?? []) ?></span> entries
            </div>
            <div class="hs-datatable-nav">
                <button id="prev-btn" disabled>Previous</button>
                <div id="page-numbers" class="flex gap-1"></div>
                <button id="next-btn" disabled>Next</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Dosen -->
<div id="addDosenModal" class="admin-modal fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0 relative" id="dosenModalContent">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-900">Tambah Dosen</h3>
            <button onclick="closeDosenModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Modal Body -->
        <div class="p-6">
            <form id="addDosenForm">
                <!-- NIDN Field -->
                <div class="mb-5">
                    <label for="nidn" class="block text-sm font-semibold text-gray-700 mb-2">
                        NIDN <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nidn" name="nidn" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="Masukkan NIDN dosen">
                    <div id="nidn-error" class="text-red-500 text-sm mt-2 hidden"></div>
                </div>

                <!-- Nama Field -->
                <div class="mb-6">
                    <label for="nama_dosen" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama_dosen" name="nama" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="Masukkan nama lengkap dosen">
                    <div id="nama-error" class="text-red-500 text-sm mt-2 hidden"></div>
                </div>
            </form>
        </div>
        
        <!-- Modal Footer -->
        <div class="flex justify-end space-x-3 p-6 border-t border-gray-200">
            <button type="button" onclick="closeDosenModal()"
                class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                Batal
            </button>
            <button type="submit" form="addDosenForm" id="submitDosenBtn"
                class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Simpan
            </button>
        </div>
    </div>
</div>

<!-- Modal Edit Dosen -->
<div id="editDosenModal" class="admin-modal fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0 relative" id="editDosenModalContent">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-900">Edit Dosen</h3>
            <button onclick="closeEditDosenModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Modal Body -->
        <div class="p-6">
            <form id="editDosenForm">
                <input type="hidden" id="edit_nidn" name="nidn">
                
                <!-- NIDN Field (Read Only) -->
                <div class="mb-5">
                    <label for="edit_nidn_display" class="block text-sm font-semibold text-gray-700 mb-2">
                        NIDN
                    </label>
                    <input type="text" id="edit_nidn_display" readonly
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed"
                        placeholder="NIDN dosen">
                </div>

                <!-- Nama Field -->
                <div class="mb-6">
                    <label for="edit_nama_dosen" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="edit_nama_dosen" name="nama" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="Masukkan nama lengkap dosen">
                    <div id="edit_nama-error" class="text-red-500 text-sm mt-2 hidden"></div>
                </div>
            </form>
        </div>
        
        <!-- Modal Footer -->
        <div class="flex justify-end space-x-3 p-6 border-t border-gray-200">
            <button type="button" onclick="closeEditDosenModal()"
                class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                Batal
            </button>
            <button type="submit" form="editDosenForm" id="updateDosenBtn"
                class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Update
            </button>
        </div>
    </div>
</div>

<!-- Modal Delete Confirmation -->
<div id="deleteDosenModal" class="admin-modal fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0 relative" id="deleteDosenModalContent">
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
            <button onclick="closeDeleteDosenModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Modal Body -->
        <div class="p-6">
            <div class="text-center">
                <p class="text-gray-600 mb-2">Apakah Anda yakin ingin menghapus dosen:</p>
                <p class="font-semibold text-gray-900 mb-1" id="deleteDosenName">-</p>
                <p class="text-sm text-gray-500 mb-4">NIDN: <span id="deleteDosenNidn">-</span></p>
                <p class="text-sm text-red-600">Data yang dihapus tidak dapat dikembalikan!</p>
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="flex justify-end space-x-3 p-6 border-t border-gray-200">
            <button type="button" onclick="confirmDeleteDosen()" id="confirmDeleteDosenBtn"
                class="px-6 py-2.5 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Hapus
            </button>
            <button type="button" onclick="closeDeleteDosenModal()"
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
        console.log('DOM loaded, initializing DataTable...');



        // Get all elements
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

        // Manual dropdown functionality
        const filterDropdown = document.getElementById('filter-dropdown');
        const dropdownMenu = document.getElementById('filter-menu');
        const filterArrow = document.getElementById('filter-arrow');

        if (filterDropdown && dropdownMenu && filterArrow) {
            filterDropdown.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const isHidden = dropdownMenu.classList.contains('hidden');

                if (isHidden) {
                    dropdownMenu.classList.remove('hidden');
                    filterArrow.style.transform = 'rotate(180deg)';
                } else {
                    dropdownMenu.classList.add('hidden');
                    filterArrow.style.transform = 'rotate(0deg)';
                }
            });

            document.addEventListener('click', function(e) {
                if (!filterDropdown.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.add('hidden');
                    filterArrow.style.transform = 'rotate(0deg)';
                }
            });

            dropdownMenu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }

        // DataTable variables
        let currentPage = 1;
        let entriesPerPage = 10;
        let filteredRows = [];
        let allRows = [];

        // Initialize rows
        if (tableBody) {
            allRows = Array.from(tableBody.querySelectorAll('tr'));
            filteredRows = [...allRows];
            console.log('Found rows:', allRows.length);
        }

        // Initialize display
        updateDisplay();

        // Search functionality
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                console.log('Search input:', this.value);
                applyFilters();
            });
        }

        // Entries per page
        if (entriesSelect) {
            entriesSelect.addEventListener('change', function() {
                console.log('Entries changed to:', this.value);
                entriesPerPage = parseInt(this.value);
                currentPage = 1;
                updateDisplay();
            });
        }

        // Filter functionality
        filterCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                console.log('Filter changed:', this.value, this.checked);
                handleFilterChange(this);
            });
        });

        // Pagination buttons
        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    updateDisplay();
                }
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                const totalPages = Math.ceil(filteredRows.length / entriesPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    updateDisplay();
                }
            });
        }

        function handleFilterChange(checkbox) {
            const allCheckbox = document.querySelector('.filter-checkbox[value="all"]');
            const profesorCheckbox = document.querySelector('.filter-checkbox[value="profesor"]');
            const doktorCheckbox = document.querySelector('.filter-checkbox[value="doktor"]');
            const magisterCheckbox = document.querySelector('.filter-checkbox[value="magister"]');

            // Handle checkbox logic
            if (checkbox.value === 'all' && checkbox.checked) {
                if (profesorCheckbox) profesorCheckbox.checked = false;
                if (doktorCheckbox) doktorCheckbox.checked = false;
                if (magisterCheckbox) magisterCheckbox.checked = false;
            } else if (checkbox.value !== 'all' && checkbox.checked) {
                if (allCheckbox) allCheckbox.checked = false;
            }

            // If no specific filters, default to all
            const hasSpecificFilter = (profesorCheckbox && profesorCheckbox.checked) ||
                (doktorCheckbox && doktorCheckbox.checked) ||
                (magisterCheckbox && magisterCheckbox.checked);
            if (!hasSpecificFilter && allCheckbox && !allCheckbox.checked) {
                allCheckbox.checked = true;
            }

            applyFilters();
        }

        function applyFilters() {
            const searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
            const allChecked = document.querySelector('.filter-checkbox[value="all"]')?.checked || false;
            const profesorChecked = document.querySelector('.filter-checkbox[value="profesor"]')?.checked || false;
            const doktorChecked = document.querySelector('.filter-checkbox[value="doktor"]')?.checked || false;
            const magisterChecked = document.querySelector('.filter-checkbox[value="magister"]')?.checked || false;

            console.log('Applying filters:', {
                searchTerm,
                allChecked,
                profesorChecked,
                doktorChecked,
                magisterChecked
            });

            filteredRows = allRows.filter(row => {
                const rowCategory = row.getAttribute('data-category');
                const cells = row.querySelectorAll('td');
                if (cells.length < 2) return false;

                const nidnText = cells[0]?.textContent?.toLowerCase().trim() || '';
                const namaText = cells[1]?.textContent?.toLowerCase().trim() || '';
                const text = nidnText + ' ' + namaText;

                // Check if row matches search term
                const matchesSearch = searchTerm === '' || text.includes(searchTerm);

                // Check if row matches category filter
                let matchesCategory = false;

                if (allChecked) {
                    // If "Semua Gelar" is checked, show all categories
                    matchesCategory = true;
                } else {
                    // Check if row's category is in selected categories
                    const selectedCategories = [];
                    if (profesorChecked) selectedCategories.push('profesor');
                    if (doktorChecked) selectedCategories.push('doktor');
                    if (magisterChecked) selectedCategories.push('magister');

                    matchesCategory = selectedCategories.length === 0 || selectedCategories.includes(rowCategory);
                }

                return matchesSearch && matchesCategory;
            });

            console.log('Filtered to:', filteredRows.length, 'rows');
            currentPage = 1;
            updateDisplay();
        }

        function updateDisplay() {
            displayRows();
            updatePagination();
            updateInfo();
        }

        function displayRows() {
            // Hide all rows
            allRows.forEach(row => row.style.display = 'none');

            // Show current page rows
            const startIndex = (currentPage - 1) * entriesPerPage;
            const endIndex = startIndex + entriesPerPage;
            const rowsToShow = filteredRows.slice(startIndex, endIndex);

            // Update row numbers and display
            rowsToShow.forEach((row, index) => {
                row.style.display = '';
                // Update the number in the first cell
                const numberCell = row.querySelector('td:first-child');
                if (numberCell) {
                    numberCell.textContent = startIndex + index + 1;
                }
            });

            console.log('Displaying rows:', startIndex, 'to', endIndex, '/', filteredRows.length);
        }

        function updatePagination() {
            const totalRows = filteredRows.length;
            const totalPages = Math.ceil(totalRows / entriesPerPage);

            if (prevBtn) prevBtn.disabled = currentPage <= 1;
            if (nextBtn) nextBtn.disabled = currentPage >= totalPages || totalPages === 0;

            // Update page numbers
            const pageNumbers = document.getElementById('page-numbers');
            if (pageNumbers) {
                pageNumbers.innerHTML = '';

                if (totalPages > 1) {
                    for (let i = 1; i <= Math.min(totalPages, 10); i++) {
                        const button = document.createElement('button');
                        button.textContent = i;
                        button.className = `px-3 py-1 text-sm border rounded ${
                        i === currentPage 
                            ? 'bg-blue-600 text-white border-blue-600' 
                            : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'
                    }`;

                        if (i !== currentPage) {
                            button.addEventListener('click', function() {
                                currentPage = i;
                                updateDisplay();
                            });
                        }

                        pageNumbers.appendChild(button);
                    }
                }
            }
        }

        function updateInfo() {
            const totalRows = filteredRows.length;
            const startIndex = totalRows > 0 ? (currentPage - 1) * entriesPerPage + 1 : 0;
            const endIndex = Math.min(currentPage * entriesPerPage, totalRows);

            if (startEntry) startEntry.textContent = startIndex;
            if (endEntry) endEntry.textContent = endIndex;
            if (totalEntries) totalEntries.textContent = totalRows;
        }
    });

    // Configuration
    const baseUrl = '<?= base_url() ?>';
    
    // Global modal state
    let isModalOpen = false;

    // Modal functions
    function openDosenModal() {
        // Prevent opening multiple modals
        if (isModalOpen) return;
        
        const modal = document.getElementById('addDosenModal');
        const modalContent = document.getElementById('dosenModalContent');
        
        // Set modal state
        isModalOpen = true;
        
        // Reset form
        document.getElementById('addDosenForm').reset();
        clearDosenErrors();
        
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
            document.getElementById('nidn').focus();
        }, 100);
    }

    function closeDosenModal() {
        const modal = document.getElementById('addDosenModal');
        const modalContent = document.getElementById('dosenModalContent');
        
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
            
            // Force a small delay then reset display
            setTimeout(() => {
                modal.style.display = '';
            }, 50);
        }, 300);
    }

    // Form submission handler
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('addDosenForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('submitDosenBtn');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Menyimpan...
            `;
            
            // Clear previous errors
            clearDosenErrors();
            
            // Get form data
            const formData = new FormData(this);
            
            // Submit via AJAX
            fetch(baseUrl + '/admin/dosen', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    // Close modal
                    closeDosenModal();
                    
                    // Show success message
                    showSuccess('Dosen berhasil ditambahkan!');
                    
                    // Reload page to show new data
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                } else {
                    // Show errors
                    if (result.errors) {
                        Object.keys(result.errors).forEach(field => {
                            showDosenError(field, result.errors[field]);
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
        document.getElementById('addDosenModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDosenModal();
            }
        });

        // Edit form submission handler
        document.getElementById('editDosenForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('updateDosenBtn');
            const originalText = submitBtn.innerHTML;
            const dosenNidn = document.getElementById('edit_nidn').value;
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Mengupdate...
            `;
            
            // Clear previous errors
            clearEditDosenErrors();
            
            // Get form data
            const formData = new FormData(this);
            
            // Submit via AJAX
            fetch(baseUrl + '/admin/dosen/update/' + dosenNidn, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    // Close modal
                    closeEditDosenModal();
                    
                    // Show success message
                    showSuccess('Dosen berhasil diupdate!');
                    
                    // Reload page to show new data
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                } else {
                    // Show errors
                    if (result.errors) {
                        Object.keys(result.errors).forEach(field => {
                            showEditDosenError('edit_' + field, result.errors[field]);
                        });
                    } else if (result.message) {
                        showError('Error: ' + result.message);
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showError('Terjadi kesalahan saat mengupdate data');
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });

        // Close edit modal when clicking backdrop
        document.getElementById('editDosenModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditDosenModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (e.ctrlKey && e.shiftKey) {
                    // Emergency cleanup with Ctrl+Shift+Escape
                    forceCloseAllModals();
                } else {
                    // Normal escape - check which modal is open
                    const addModal = document.getElementById('addDosenModal');
                    const editModal = document.getElementById('editDosenModal');
                    const deleteModal = document.getElementById('deleteDosenModal');
                    
                    if (!addModal.classList.contains('hidden')) {
                        closeDosenModal();
                    } else if (!editModal.classList.contains('hidden')) {
                        closeEditDosenModal();
                    } else if (!deleteModal.classList.contains('hidden')) {
                        closeDeleteDosenModal();
                    }
                }
            }
        });
    });

    // Emergency cleanup function
    function forceCloseAllModals() {
        const addModal = document.getElementById('addDosenModal');
        const editModal = document.getElementById('editDosenModal');
        const deleteModal = document.getElementById('deleteDosenModal');
        const addModalContent = document.getElementById('dosenModalContent');
        const editModalContent = document.getElementById('editDosenModalContent');
        const deleteModalContent = document.getElementById('deleteDosenModalContent');
        
        // Force hide add modal
        if (addModal) {
            addModal.classList.add('hidden');
            addModal.removeAttribute('style');
            addModal.style.display = 'none';
        }
        
        if (addModalContent) {
            addModalContent.removeAttribute('style');
        }
        
        // Force hide edit modal
        if (editModal) {
            editModal.classList.add('hidden');
            editModal.removeAttribute('style');
            editModal.style.display = 'none';
        }
        
        if (editModalContent) {
            editModalContent.removeAttribute('style');
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
        isDeleteDosenModalOpen = false;
        currentDeleteNidn = null;
        
        console.log('Force closed all modals');
    }

    // Helper functions
    function clearDosenErrors() {
        document.getElementById('nidn-error').classList.add('hidden');
        document.getElementById('nama-error').classList.add('hidden');
        document.getElementById('nidn-error').textContent = '';
        document.getElementById('nama-error').textContent = '';
        
        // Reset input styling
        document.getElementById('nidn').className = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors';
        document.getElementById('nama_dosen').className = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors';
    }

    function showDosenError(fieldId, message) {
        const errorElement = document.getElementById(fieldId + '-error');
        let inputElement;
        
        if (fieldId === 'nama') {
            inputElement = document.getElementById('nama_dosen');
        } else {
            inputElement = document.getElementById(fieldId);
        }
        
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
        }
        
        if (inputElement) {
            inputElement.className = 'w-full px-4 py-3 border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors';
        }
    }

    // Edit Dosen Functions
    function editDosen(nidn) {
        // Prevent opening multiple modals
        if (isModalOpen) return;
        
        // Set modal state
        isModalOpen = true;
        
        // Get dosen data
        fetch(baseUrl + '/admin/dosen/' + nidn, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(result => {
            if (result.success && result.data) {
                openEditDosenModal(result.data);
            } else {
                showError('Error: ' + (result.message || 'Gagal mengambil data dosen'));
                isModalOpen = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError('Terjadi kesalahan saat mengambil data');
            isModalOpen = false;
        });
    }

    function openEditDosenModal(data) {
        const modal = document.getElementById('editDosenModal');
        const modalContent = document.getElementById('editDosenModalContent');
        
        // Reset form and populate with data
        document.getElementById('editDosenForm').reset();
        document.getElementById('edit_nidn').value = data.nidn;
        document.getElementById('edit_nidn_display').value = data.nidn;
        document.getElementById('edit_nama_dosen').value = data.nama;
        clearEditDosenErrors();
        
        // Ensure modal is appended to body root
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
            document.getElementById('edit_nama_dosen').focus();
        }, 100);
    }

    function closeEditDosenModal() {
        const modal = document.getElementById('editDosenModal');
        const modalContent = document.getElementById('editDosenModalContent');
        
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
            
            // Force a small delay then reset display
            setTimeout(() => {
                modal.style.display = '';
            }, 50);
        }, 300);
    }

    function clearEditDosenErrors() {
        document.getElementById('edit_nama-error').classList.add('hidden');
        document.getElementById('edit_nama-error').textContent = '';
        
        // Reset input styling
        document.getElementById('edit_nama_dosen').className = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors';
    }

    function showEditDosenError(fieldId, message) {
        const errorElement = document.getElementById(fieldId + '-error');
        let inputElement;
        
        if (fieldId === 'edit_nama') {
            inputElement = document.getElementById('edit_nama_dosen');
        } else {
            inputElement = document.getElementById(fieldId);
        }
        
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
        }
        
        if (inputElement) {
            inputElement.className = 'w-full px-4 py-3 border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors';
        }
    }

    // Delete Modal Functions
    let currentDeleteNidn = null;
    let isDeleteDosenModalOpen = false;

    function deleteDosen(nidn) {
        // Get dosen data first to show in modal
        fetch(baseUrl + '/admin/dosen/' + nidn, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data) {
                const dosen = data.data;
                openDeleteDosenModal(nidn, dosen.nama);
            } else {
                // Fallback jika gagal load data
                openDeleteDosenModal(nidn, 'Dosen');
            }
        })
        .catch(error => {
            console.error('Error loading dosen data:', error);
            // Fallback jika gagal load data
            openDeleteDosenModal(nidn, 'Dosen');
        });
    }

    function openDeleteDosenModal(nidn, nama) {
        if (isDeleteDosenModalOpen) return;
        
        const modal = document.getElementById('deleteDosenModal');
        const modalContent = document.getElementById('deleteDosenModalContent');
        
        // Set modal state
        isDeleteDosenModalOpen = true;
        currentDeleteNidn = nidn;
        
        // Populate modal content
        document.getElementById('deleteDosenName').textContent = nama;
        document.getElementById('deleteDosenNidn').textContent = nidn;
        
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

    function closeDeleteDosenModal() {
        const modal = document.getElementById('deleteDosenModal');
        const modalContent = document.getElementById('deleteDosenModalContent');
        
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
            isDeleteDosenModalOpen = false;
            currentDeleteNidn = null;
            
            // Force a small delay then reset display
            setTimeout(() => {
                modal.style.display = '';
            }, 50);
        }, 300);
    }

    function confirmDeleteDosen() {
        if (!currentDeleteNidn) return;
        
        const confirmBtn = document.getElementById('confirmDeleteDosenBtn');
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
        fetch(baseUrl + '/admin/dosen/' + currentDeleteNidn, {
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
                closeDeleteDosenModal();
                
                // Show success toast
                showToast('Dosen berhasil dihapus!', 'success');
                
                // Reload page to show updated data
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                showToast('Error: ' + (result.message || 'Gagal menghapus dosen'), 'error');
                
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
    document.getElementById('deleteDosenModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteDosenModal();
        }
    });
</script>
<?= $this->endSection() ?>