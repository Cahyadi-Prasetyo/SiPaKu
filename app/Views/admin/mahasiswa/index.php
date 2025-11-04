<?= $this->extend('layout/admin/main') ?>

<?php

// Helper function untuk mendapatkan angkatan dari NIM
function getAngkatanFromNIM($nim)
{
    if (!$nim || strlen($nim) < 2) return '00';

    // Ambil 2 digit pertama dari NIM
    return substr($nim, 0, 2);
}
?>

<?= $this->section('head') ?>
<style>
    /* Custom styles untuk Modal Delete dan Toast */
    .admin-modal {
        backdrop-filter: blur(4px);
    }
    
    .modal-content {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    /* Modal body scroll lock */
    body.modal-open {
        overflow: hidden !important;
    }
    
    /* Delete modal specific styles */
    #deleteMahasiswaModal .modal-content {
        border-top: 4px solid #ef4444;
    }
    
    /* Custom DataTable styles */
    .hs-datatable-search {
        padding: 0.75rem 1rem;
        padding-left: 2.5rem;
        border: 1px solid #d1d5db;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        background-color: #ffffff;
        transition: all 0.15s ease-in-out;
    }
    
    .hs-datatable-search:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .hs-datatable-entries {
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        background-color: #ffffff;
    }
    
    .hs-datatable-filter {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        background-color: #ffffff;
        transition: all 0.15s ease-in-out;
    }
    
    .hs-datatable-filter:hover {
        background-color: #f9fafb;
    }
    
    .hs-dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        z-index: 10;
        margin-top: 0.25rem;
        min-width: 12rem;
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        padding: 0.5rem 0;
    }
    
    .action-button {
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: 0.375rem;
        transition: all 0.15s ease-in-out;
        text-decoration: none;
    }
    
    .action-button:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }
    
    .action-button.delete:hover {
        background-color: rgba(239, 68, 68, 0.1);
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
                <h2 class="text-xl font-semibold text-gray-800">Data Mahasiswa</h2>
                <p class="text-sm text-gray-600">Kelola data mahasiswa</p>
            </div>

            <div>
                <div class="inline-flex gap-x-2">
                    <button type="button" onclick="openModal()" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14" />
                            <path d="M12 5v14" />
                        </svg>
                        Tambah Mahasiswa
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
                                <span class="ml-2 text-sm text-gray-700">Semua Angkatan</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded cursor-pointer">
                                <input type="checkbox" class="filter-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="25">
                                <span class="ml-2 text-sm text-gray-700">Angkatan 2025</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded cursor-pointer">
                                <input type="checkbox" class="filter-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="24">
                                <span class="ml-2 text-sm text-gray-700">Angkatan 2024</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded cursor-pointer">
                                <input type="checkbox" class="filter-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="23">
                                <span class="ml-2 text-sm text-gray-700">Angkatan 2023</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded cursor-pointer">
                                <input type="checkbox" class="filter-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="22">
                                <span class="ml-2 text-sm text-gray-700">Angkatan 2022</span>
                            </label>
                            <label class="flex items-center px-3 py-2 hover:bg-gray-50 rounded cursor-pointer">
                                <input type="checkbox" class="filter-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" value="20">
                                <span class="ml-2 text-sm text-gray-700">Angkatan 2020</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-hidden">
            <table class="hs-datatable-table" id="mahasiswa-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <?php if (!empty($mahasiswa)): ?>
                        <?php foreach ($mahasiswa as $index => $mhs): ?>
                            <?php
                            $angkatan = getAngkatanFromNIM($mhs['nim']);
                            ?>
                            <tr data-angkatan="<?= $angkatan ?>" class="hover:bg-gray-50" data-index="<?= $index + 1 ?>">
                                <td class="font-medium text-center"><?= $index + 1 ?></td>
                                <td class="font-medium text-gray-900"><?= esc($mhs['nim']) ?></td>
                                <td class="text-gray-900"><?= esc($mhs['nama']) ?></td>
                                <td>
                                    <div class="flex space-x-2">
                                        <button onclick="editMahasiswa('<?= esc($mhs['nim']) ?>')"
                                            class="action-button text-blue-600 hover:text-blue-800">
                                            Edit
                                        </button>
                                        <button onclick="deleteMahasiswa('<?= esc($mhs['nim']) ?>')"
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
                                Tidak ada data mahasiswa
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="hs-datatable-pagination">
            <div class="hs-datatable-info">
                Showing <span id="start-entry">1</span> to <span id="end-entry"><?= count($mahasiswa ?? []) ?></span> of <span id="total-entries"><?= count($mahasiswa ?? []) ?></span> entries
            </div>
            <div class="hs-datatable-nav">
                <button id="prev-btn" disabled>Previous</button>
                <div id="page-numbers" class="flex gap-1"></div>
                <button id="next-btn" disabled>Next</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Mahasiswa -->
<div id="addMahasiswaModal" class="admin-modal fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0 relative" id="modalContent">
        <!-- Modal Header -->
        <div class="flex justify-between items-center p-6 border-b border-gray-200">
            <h3 id="modalTitle" class="text-xl font-semibold text-gray-900">Tambah Mahasiswa</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Modal Body -->
        <div class="p-6">
            <form id="addMahasiswaForm">
                <input type="hidden" id="original_nim" name="original_nim">
                
                <!-- NIM Field -->
                <div class="mb-5">
                    <label for="nim" class="block text-sm font-semibold text-gray-700 mb-2">
                        NIM <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nim" name="nim" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="Masukkan NIM mahasiswa">
                    <div id="nim-error" class="text-red-500 text-sm mt-2 hidden"></div>
                </div>

                <!-- Nama Field -->
                <div class="mb-6">
                    <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="nama" name="nama" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                        placeholder="Masukkan nama lengkap mahasiswa">
                    <div id="nama-error" class="text-red-500 text-sm mt-2 hidden"></div>
                </div>
            </form>
        </div>
        
        <!-- Modal Footer -->
        <div class="flex justify-end space-x-3 p-6 border-t border-gray-200">
            <button type="button" onclick="closeModal()"
                class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                Batal
            </button>
            <button type="submit" form="addMahasiswaForm" id="submitBtn"
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
<div id="deleteMahasiswaModal" class="admin-modal fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="modal-content bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0 relative" id="deleteModalContent">
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
            <button onclick="closeDeleteModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-2 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Modal Body -->
        <div class="p-6">
            <div class="text-center">
                <p class="text-gray-600 mb-2">Apakah Anda yakin ingin menghapus mahasiswa:</p>
                <p class="font-semibold text-gray-900 mb-1" id="deleteStudentName">-</p>
                <p class="text-sm text-gray-500 mb-4">NIM: <span id="deleteStudentNim">-</span></p>
                <p class="text-sm text-red-600">Data yang dihapus tidak dapat dikembalikan!</p>
            </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="flex justify-end space-x-3 p-6 border-t border-gray-200">
            <button type="button" onclick="confirmDeleteMahasiswa()" id="confirmDeleteBtn"
                class="px-6 py-2.5 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Hapus
            </button>
            <button type="button" onclick="closeDeleteModal()"
                class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-colors">
                Batal
            </button>
        </div>
    </div>
</div>



<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Configuration
    const baseUrl = '<?= base_url() ?>';

    // Global variables
    let isModalOpen = false;
    let isEditMode = false;
    let currentEditNim = null;
    let currentPage = 1;
    let entriesPerPage = 10;
    let filteredRows = [];
    let allRows = [];

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
        const filterCheckboxes = document.querySelectorAll('.filter-checkbox');
        const tableBody = document.getElementById('table-body');

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

        // Initialize data after DOM elements are ready
        allRows = Array.from(tableBody.querySelectorAll('tr'));
        filteredRows = allRows;

        // Define functions first
        function updateFilteredRows() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedColumns = Array.from(filterCheckboxes)
                .filter(cb => cb.checked && cb.value !== 'all')
                .map(cb => cb.value);

            filteredRows = allRows.filter(row => {
                const cells = row.querySelectorAll('td');

                // If no search term, show all rows
                if (searchTerm === '') {
                    return true;
                }

                // If "Semua" is checked or no specific columns selected, search in all columns
                if (document.querySelector('.filter-checkbox[value="all"]').checked || selectedColumns.length === 0) {
                    const text = row.textContent.toLowerCase();
                    return text.includes(searchTerm);
                }

                // Search only in selected columns
                let matchesFilter = false;

                selectedColumns.forEach(column => {
                    if (column === 'nim' && cells[0]) {
                        const nimText = cells[0].textContent.toLowerCase();
                        if (nimText.includes(searchTerm)) {
                            matchesFilter = true;
                        }
                    } else if (column === 'nama' && cells[1]) {
                        const namaText = cells[1].textContent.toLowerCase();
                        if (namaText.includes(searchTerm)) {
                            matchesFilter = true;
                        }
                    }
                });

                return matchesFilter;
            });
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

            // Show the rows for current page
            rowsToShow.forEach(row => {
                row.style.display = '';
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



        // Initialize
        updateFilteredRows();
        updatePagination();
        displayRows();

        // Search functionality
        searchInput.addEventListener('input', function() {
            updateFilteredRows();
            currentPage = 1;
            updatePagination();
            displayRows();
        });

        // Entries per page
        entriesSelect.addEventListener('change', function() {
            entriesPerPage = parseInt(this.value);
            currentPage = 1;
            updatePagination();
            displayRows();
        });

        // Filter functionality
        filterCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (this.value === 'all') {
                    if (this.checked) {
                        filterCheckboxes.forEach(cb => {
                            if (cb.value !== 'all') cb.checked = false;
                        });
                        filteredRows = allRows;
                    }
                } else {
                    if (this.checked) {
                        document.querySelector('.filter-checkbox[value="all"]').checked = false;
                    }

                    const selectedAngkatan = Array.from(filterCheckboxes)
                        .filter(cb => cb.checked && cb.value !== 'all')
                        .map(cb => cb.value);

                    if (selectedAngkatan.length === 0) {
                        document.querySelector('.filter-checkbox[value="all"]').checked = true;
                        filteredRows = allRows;
                    } else {
                        filteredRows = allRows.filter(row => {
                            const angkatan = row.getAttribute('data-angkatan');
                            return selectedAngkatan.includes(angkatan);
                        });
                    }
                }

                currentPage = 1;
                updatePagination();
                displayRows();
            });
        });

        // Pagination buttons
        prevBtn.addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                updatePagination();
                displayRows();
            }
        });

        nextBtn.addEventListener('click', function() {
            const totalPages = Math.ceil(filteredRows.length / entriesPerPage);
            if (currentPage < totalPages) {
                currentPage++;
                updatePagination();
                displayRows();
            }
        });


    });

    // Modal functions
    function openModal(nim = null) {
        // Prevent opening multiple modals
        if (isModalOpen) return;
        
        const modal = document.getElementById('addMahasiswaModal');
        const modalContent = document.getElementById('modalContent');
        
        // Set modal state
        isModalOpen = true;
        isEditMode = nim !== null;
        currentEditNim = nim;
        
        // Reset form
        document.getElementById('addMahasiswaForm').reset();
        clearErrors();
        
        // Set modal title and button based on mode
        const modalTitle = document.getElementById('modalTitle');
        const submitBtn = document.getElementById('submitBtn');
        const submitText = document.getElementById('submitText');
        const submitIcon = document.getElementById('submitIcon');
        const nimField = document.getElementById('nim');
        
        if (isEditMode) {
            modalTitle.textContent = 'Edit Mahasiswa';
            submitText.textContent = 'Update';
            submitBtn.className = 'px-6 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors';
            submitIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>';
            
            // Make NIM field readonly in edit mode
            nimField.readOnly = true;
            nimField.className = 'w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-600 cursor-not-allowed';
            
            // Load mahasiswa data
            loadMahasiswaData(nim);
        } else {
            modalTitle.textContent = 'Tambah Mahasiswa';
            submitText.textContent = 'Simpan';
            submitBtn.className = 'px-6 py-2.5 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors';
            submitIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>';
            
            // Make NIM field editable in add mode
            nimField.readOnly = false;
            nimField.className = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors';
        }
        

        
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
            document.getElementById('nim').focus();
        }, 100);
    }

    function closeModal() {
        const modal = document.getElementById('addMahasiswaModal');
        const modalContent = document.getElementById('modalContent');
        
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
            currentEditNim = null;
            
            // Force a small delay then reset display
            setTimeout(() => {
                modal.style.display = '';
            }, 50);
        }, 300);
    }

    // Form submission handler
    document.getElementById('addMahasiswaForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('submitBtn');
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
        clearErrors();
        
        // Get form data
        const formData = new FormData(this);
        
        // Determine URL and method based on mode
        let url = baseUrl + '/admin/mahasiswa';
        let method = 'POST';
        
        if (isEditMode && currentEditNim) {
            url = baseUrl + '/admin/mahasiswa/update/' + currentEditNim;
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
                closeModal();
                
                // Show success message
                const successMessage = isEditMode ? 'Mahasiswa berhasil diupdate!' : 'Mahasiswa berhasil ditambahkan!';
                showSuccess(successMessage);
                
                // Reload page to show new data
                setTimeout(() => {
                    window.location.reload();
                }, 500);
            } else {
                // Show errors
                if (result.errors) {
                    Object.keys(result.errors).forEach(field => {
                        showError(field, result.errors[field]);
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





    // Emergency cleanup function
    function forceCloseAllModals() {
        const modal = document.getElementById('addMahasiswaModal');
        const modalContent = document.getElementById('modalContent');
        const deleteModal = document.getElementById('deleteMahasiswaModal');
        const deleteModalContent = document.getElementById('deleteModalContent');
        
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
        currentEditNim = null;
        isDeleteModalOpen = false;
        
        console.log('Force closed all modals');
    }

    // Helper functions
    function clearErrors() {
        document.getElementById('nim-error').classList.add('hidden');
        document.getElementById('nama-error').classList.add('hidden');
        document.getElementById('nim-error').textContent = '';
        document.getElementById('nama-error').textContent = '';
        
        // Reset input styling
        document.getElementById('nim').className = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors';
        document.getElementById('nama').className = 'w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors';
    }

    function showError(fieldId, message) {
        const errorElement = document.getElementById(fieldId + '-error');
        const inputElement = document.getElementById(fieldId);
        
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
        }
        
        if (inputElement) {
            inputElement.className = 'w-full px-4 py-3 border border-red-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-colors';
        }
    }

    // Close modal when clicking backdrop
    document.getElementById('addMahasiswaModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
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
                const modal = document.getElementById('addMahasiswaModal');
                const deleteModal = document.getElementById('deleteMahasiswaModal');
                
                if (!modal.classList.contains('hidden')) {
                    closeModal();
                } else if (!deleteModal.classList.contains('hidden')) {
                    closeDeleteModal();
                }
            }
            }
        });

    // Edit and Delete functions
    function editMahasiswa(nim) {
        console.log('Edit Mahasiswa clicked for NIM:', nim);
        openModal(nim);
    }

    // Load mahasiswa data for editing
    function loadMahasiswaData(nim) {
        console.log('Loading mahasiswa data for NIM:', nim);
        
        fetch(baseUrl + '/admin/mahasiswa/' + nim, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Mahasiswa data loaded:', data);
            if (data.success && data.data) {
                const mahasiswa = data.data;
                
                // Populate form fields
                document.getElementById('original_nim').value = mahasiswa.nim || '';
                document.getElementById('nim').value = mahasiswa.nim || '';
                document.getElementById('nama').value = mahasiswa.nama || '';
            } else {
                showError('Gagal memuat data mahasiswa');
            }
        })
        .catch(error => {
            console.error('Error loading mahasiswa data:', error);
            showError('Terjadi kesalahan saat memuat data mahasiswa');
        });
    }



    // Delete Modal Functions
    let currentDeleteNim = null;
    let isDeleteModalOpen = false;

    function deleteMahasiswa(nim) {
        // Get mahasiswa data first to show in modal
        fetch(baseUrl + '/admin/mahasiswa/' + nim, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data) {
                const mahasiswa = data.data;
                openDeleteModal(nim, mahasiswa.nama);
            } else {
                // Fallback jika gagal load data
                openDeleteModal(nim, 'Mahasiswa');
            }
        })
        .catch(error => {
            console.error('Error loading mahasiswa data:', error);
            // Fallback jika gagal load data
            openDeleteModal(nim, 'Mahasiswa');
        });
    }

    function openDeleteModal(nim, nama) {
        if (isDeleteModalOpen) return;
        
        const modal = document.getElementById('deleteMahasiswaModal');
        const modalContent = document.getElementById('deleteModalContent');
        
        // Set modal state
        isDeleteModalOpen = true;
        currentDeleteNim = nim;
        
        // Populate modal content
        document.getElementById('deleteStudentName').textContent = nama;
        document.getElementById('deleteStudentNim').textContent = nim;
        
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

    function closeDeleteModal() {
        const modal = document.getElementById('deleteMahasiswaModal');
        const modalContent = document.getElementById('deleteModalContent');
        
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
            isDeleteModalOpen = false;
            currentDeleteNim = null;
            
            // Force a small delay then reset display
            setTimeout(() => {
                modal.style.display = '';
            }, 50);
        }, 300);
    }

    function confirmDeleteMahasiswa() {
        if (!currentDeleteNim) return;
        
        const confirmBtn = document.getElementById('confirmDeleteBtn');
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
        fetch(baseUrl + '/admin/mahasiswa/' + currentDeleteNim, {
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
                closeDeleteModal();
                
                // Show success toast
                showToast('Mahasiswa berhasil dihapus!', 'success');
                
                // Reload page to show updated data
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                showToast('Error: ' + (result.message || 'Gagal menghapus mahasiswa'), 'error');
                
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
    document.getElementById('deleteMahasiswaModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>

<?= $this->endSection() ?>