<?= $this->extend('layout/dosen/main') ?>

<?= $this->section('head') ?>
<style>
    /* Custom Confirm Dialog Styles */
    #confirm-dialog-overlay {
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        z-index: 100000 !important;
    }

    #confirm-dialog {
        z-index: 100001 !important;
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    /* Modal positioning improvements with proper z-index */
    #nilai-modal {
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        z-index: 99999 !important;
    }
    
    #nilai-modal .modal-overlay {
        position: fixed;
        inset: 0;
        background-color: rgba(17, 24, 39, 0.5);
        z-index: 99998 !important;
    }
    
    #nilai-modal .modal-container {
        position: fixed;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        z-index: 99999 !important;
        overflow-y: auto;
    }
    
    #nilai-modal .modal-panel {
        position: relative;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        transform: scale(0.95);
        transition: all 0.3s ease-out;
        max-width: 72rem;
        width: 100%;
        max-height: 90vh;
        display: flex;
        flex-direction: column;
        z-index: 100000 !important;
        margin: auto;
    }
    
    #nilai-modal:not(.hidden) .modal-panel {
        transform: scale(1);
    }
    
    /* Ensure modal content is above everything */
    #nilai-modal .modal-panel * {
        position: relative;
        z-index: 100001 !important;
    }
    
    @media (max-width: 640px) {
        #nilai-modal .modal-container {
            padding: 0.5rem;
        }
        
        #nilai-modal .modal-panel {
            max-height: 95vh;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Header -->
<div class="mb-6 sm:mb-8">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-2">Input Nilai Mahasiswa</h1>
            <p class="text-sm sm:text-base text-gray-600">
                Kelola nilai mahasiswa - NIDN: <span class="font-medium text-yellow-600"><?= session('kode') ?? '-' ?></span>
            </p>
        </div>
    </div>
</div>

<!-- Pilih Jadwal -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Pilih Kelas untuk Input Nilai</h3>
    
    <!-- Info Box -->
    <div class="mb-4 bg-blue-50 border-l-4 border-blue-500 p-3 rounded-r">
        <div class="flex items-start">
            <svg class="h-5 w-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="ml-3 text-sm text-blue-700">
                Jumlah mahasiswa yang ditampilkan adalah mahasiswa per kelas. Klik card untuk input nilai.
            </p>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php if (!empty($jadwal_mengajar)): ?>
            <?php foreach ($jadwal_mengajar as $jadwal): ?>
                <div class="border border-gray-200 rounded-lg p-4 hover:border-yellow-300 hover:shadow-md transition-all cursor-pointer group" onclick="openNilaiModal(<?= $jadwal['id'] ?>)">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-medium text-gray-900 group-hover:text-yellow-700"><?= $jadwal['nama_kelas'] ?></h4>
                        <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">
                            <?= $jadwal['sks'] ?> SKS
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 mb-2"><?= $jadwal['nama_mata_kuliah'] ?></p>
                    <div class="flex items-center text-xs text-gray-500 mb-3">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <?= $jadwal['hari'] ?>, <?= $jadwal['jam'] ?>
                        <span class="mx-2">•</span>
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <?= $jadwal['jumlah_mahasiswa'] ?? '' ?> mahasiswa
                    </div>
                    <div class="flex items-center justify-center py-2 border-t border-gray-100 group-hover:border-yellow-200">
                        <span class="text-xs text-gray-500 group-hover:text-yellow-600 font-medium">Klik untuk input nilai</span>
                        <svg class="w-3 h-3 ml-1 text-gray-400 group-hover:text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada jadwal mengajar</h3>
                <p class="mt-1 text-sm text-gray-500">Anda belum memiliki jadwal mengajar yang terdaftar.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Custom Confirm Dialog -->
<div id="confirm-dialog-overlay" class="fixed inset-0 hidden" style="z-index: 100000 !important;">
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity"></div>
    <div class="fixed inset-0 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4">
            <div id="confirm-dialog" class="relative bg-white rounded-lg shadow-xl max-w-md w-full p-6">
                <div class="flex items-start">
                    <div id="confirm-icon" class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100">
                        <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 id="confirm-title" class="text-lg font-medium text-gray-900 mb-2">
                            Konfirmasi
                        </h3>
                        <p id="confirm-message" class="text-sm text-gray-500">
                            Apakah Anda yakin?
                        </p>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button id="confirm-cancel-btn" type="button" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                        Batal
                    </button>
                    <button id="confirm-ok-btn" type="button" class="px-4 py-2 text-sm font-medium text-white bg-yellow-600 border border-transparent rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                        Ya, Lanjutkan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Input Nilai -->
<div id="nilai-modal" class="fixed inset-0 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="z-index: 99999 !important;">
    <!-- Background overlay -->
    <div class="modal-overlay" aria-hidden="true" onclick="closeNilaiModal()"></div>
    
    <!-- Modal container -->
    <div class="modal-container">
        <!-- Modal panel -->
        <div class="modal-panel">
            <!-- Modal Header -->
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-class-title">
                                Input Nilai - [Kelas]
                            </h3>
                            <p class="text-sm text-gray-500" id="modal-class-info">
                                Mata Kuliah - Hari, Jam
                            </p>
                        </div>
                    </div>
                    <button onclick="closeNilaiModal()" class="bg-white rounded-md text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 flex-1 overflow-y-auto">
                <!-- Loading State -->
                <div id="modal-loading" class="text-center py-8">
                    <div class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-yellow-600 bg-yellow-100">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-yellow-600" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memuat data mahasiswa...
                    </div>
                </div>

                <!-- Content -->
                <div id="modal-content" class="hidden">
                    <!-- Stats Summary -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-blue-600">Total Mahasiswa</p>
                                    <p class="text-lg font-semibold text-blue-900" id="total-mahasiswa">0</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-green-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-600">Sudah Dinilai</p>
                                    <p class="text-lg font-semibold text-green-900" id="sudah-dinilai">0</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-yellow-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-yellow-600">Belum Dinilai</p>
                                    <p class="text-lg font-semibold text-yellow-900" id="belum-dinilai">0</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-red-50 rounded-lg p-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-600">Tidak Lulus</p>
                                    <p class="text-lg font-semibold text-red-900" id="tidak-lulus">0</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Input Nilai -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIM</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Mahasiswa</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Angka</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Huruf</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody id="modal-mahasiswa-table-body" class="bg-white divide-y divide-gray-200">
                                <!-- Data mahasiswa akan dimuat di sini -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse flex-shrink-0">
                <button onclick="saveNilai()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-yellow-600 text-base font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:ml-3 sm:w-auto sm:text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Nilai
                </button>
                <button onclick="clearAllNilai()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Hapus Semua
                </button>
                <button onclick="closeNilaiModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:mt-0 sm:w-auto sm:text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>



<script>
    let selectedJadwalId = null;
    let mahasiswaData = [];

    // Custom Confirm Dialog
    function showConfirmDialog(options = {}) {
        return new Promise((resolve) => {
            const overlay = document.getElementById('confirm-dialog-overlay');
            const title = document.getElementById('confirm-title');
            const message = document.getElementById('confirm-message');
            const okBtn = document.getElementById('confirm-ok-btn');
            const cancelBtn = document.getElementById('confirm-cancel-btn');
            const icon = document.getElementById('confirm-icon');

            // Set content
            title.textContent = options.title || 'Konfirmasi';
            message.textContent = options.message || 'Apakah Anda yakin?';
            okBtn.textContent = options.confirmText || 'Ya, Lanjutkan';
            cancelBtn.textContent = options.cancelText || 'Batal';

            // Set icon color based on type
            if (options.type === 'danger') {
                icon.className = 'flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100';
                icon.innerHTML = `<svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>`;
                okBtn.className = 'px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors';
            } else {
                icon.className = 'flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-yellow-100';
                icon.innerHTML = `<svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>`;
                okBtn.className = 'px-4 py-2 text-sm font-medium text-white bg-yellow-600 border border-transparent rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors';
            }

            // Show dialog
            overlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            // Handle buttons
            const handleOk = () => {
                cleanup();
                resolve(true);
            };

            const handleCancel = () => {
                cleanup();
                resolve(false);
            };

            const cleanup = () => {
                overlay.classList.add('hidden');
                document.body.style.overflow = '';
                okBtn.removeEventListener('click', handleOk);
                cancelBtn.removeEventListener('click', handleCancel);
            };

            okBtn.addEventListener('click', handleOk);
            cancelBtn.addEventListener('click', handleCancel);

            // ESC key to cancel
            const handleEsc = (e) => {
                if (e.key === 'Escape') {
                    handleCancel();
                    document.removeEventListener('keydown', handleEsc);
                }
            };
            document.addEventListener('keydown', handleEsc);
        });
    }

    // Modal Functions
    function openNilaiModal(jadwalId) {
        selectedJadwalId = jadwalId;
        
        // Show modal with animation
        const modal = document.getElementById('nilai-modal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        
        // Trigger animation
        requestAnimationFrame(() => {
            modal.style.opacity = '1';
        });
        
        // Show loading state
        document.getElementById('modal-loading').classList.remove('hidden');
        document.getElementById('modal-content').classList.add('hidden');
        
        // Load mahasiswa data from server
        loadMahasiswaData(jadwalId);
    }

    function closeNilaiModal() {
        const modal = document.getElementById('nilai-modal');
        
        // Animate out
        modal.style.opacity = '0';
        
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
            selectedJadwalId = null;
            mahasiswaData = [];
        }, 300);
    }

    // ESC key to close modal
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeNilaiModal();
        }
    });

    function loadMahasiswaData(jadwalId) {
        fetch(`<?= base_url('dosen/nilai/mahasiswa/') ?>${jadwalId}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data); // Debug log
                
                if (data.success) {
                    // Normalize data - convert null to empty string
                    mahasiswaData = (data.mahasiswa || []).map(m => ({
                        ...m,
                        nilai_angka: m.nilai_angka === null ? '' : m.nilai_angka,
                        nilai_huruf: m.nilai_huruf === null ? '' : m.nilai_huruf
                    }));
                    
                    console.log('Normalized mahasiswa data:', mahasiswaData); // Debug log
                    
                    if (mahasiswaData.length === 0) {
                        window.toast.warning('⚠️ Tidak ada mahasiswa yang terdaftar di kelas ini', 3000);
                        closeNilaiModal();
                        return;
                    }
                    
                    renderModalContent();
                    updateModalClassInfo(data.jadwal);
                } else {
                    window.toast.error('❌ ' + (data.message || 'Gagal memuat data mahasiswa'), 4000);
                    closeNilaiModal();
                }
            })
            .catch(error => {
                console.error('Error loading mahasiswa:', error);
                window.toast.error('❌ Terjadi kesalahan saat memuat data mahasiswa', 4000);
                closeNilaiModal();
            });
    }



    function updateModalClassInfo(jadwal) {
        if (jadwal && jadwal.nama_kelas) {
            const title = jadwal.nama_kelas || 'Kelas';
            const info = `${jadwal.nama_mata_kuliah} (${jadwal.sks} SKS) - ${jadwal.hari}, ${jadwal.jam}`;

            document.getElementById('modal-class-title').textContent = 'Input Nilai - ' + title;
            document.getElementById('modal-class-info').textContent = info;
        } else {
            // Fallback for sample data
            document.getElementById('modal-class-title').textContent = 'Input Nilai - ' + jadwal.title;
            document.getElementById('modal-class-info').textContent = jadwal.info;
        }
    }

    function renderModalContent() {
        // Hide loading, show content
        document.getElementById('modal-loading').classList.add('hidden');
        document.getElementById('modal-content').classList.remove('hidden');

        // Update stats
        updateStats();

        // Render table
        renderMahasiswaTable();
    }

    function updateStats() {
        const total = mahasiswaData.length;
        const sudahDinilai = mahasiswaData.filter(m => m.nilai_angka !== null && m.nilai_angka !== '' && m.nilai_angka !== undefined).length;
        const belumDinilai = total - sudahDinilai;
        const tidakLulus = mahasiswaData.filter(m => {
            if (m.nilai_angka === null || m.nilai_angka === '' || m.nilai_angka === undefined) return false;
            const nilai = parseFloat(m.nilai_angka);
            return nilai < 55;
        }).length;

        document.getElementById('total-mahasiswa').textContent = total;
        document.getElementById('sudah-dinilai').textContent = sudahDinilai;
        document.getElementById('belum-dinilai').textContent = belumDinilai;
        document.getElementById('tidak-lulus').textContent = tidakLulus;
    }

    function renderMahasiswaTable() {
        const tbody = document.getElementById('modal-mahasiswa-table-body');
        tbody.innerHTML = '';

        mahasiswaData.forEach((mahasiswa, index) => {
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50 transition-colors';
            
            // Handle null or undefined nilai_angka
            const nilaiAngkaValue = (mahasiswa.nilai_angka === null || mahasiswa.nilai_angka === undefined) ? '' : mahasiswa.nilai_angka;
            const nilaiHurufValue = (mahasiswa.nilai_huruf === null || mahasiswa.nilai_huruf === undefined) ? '' : mahasiswa.nilai_huruf;

            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${index + 1}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${mahasiswa.nim}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mahasiswa.nama}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <input type="number" 
                           min="0" 
                           max="100" 
                           value="${nilaiAngkaValue}"
                           onchange="updateNilai(${index}, this.value)"
                           placeholder="0-100"
                           class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 text-sm transition-colors">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span id="nilai-huruf-${index}" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition-colors ${getNilaiHurufClass(nilaiHurufValue)}">
                        ${nilaiHurufValue || '-'}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span id="status-${index}" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition-colors ${getStatusClass(mahasiswa.nilai_angka)}">
                        ${getStatus(mahasiswa.nilai_angka)}
                    </span>
                </td>
            `;

            tbody.appendChild(row);
        });
    }

    function updateNilai(index, nilaiAngka) {
        mahasiswaData[index].nilai_angka = nilaiAngka;
        mahasiswaData[index].nilai_huruf = convertToHuruf(nilaiAngka);

        // Update display
        const nilaiHurufSpan = document.getElementById(`nilai-huruf-${index}`);
        nilaiHurufSpan.textContent = mahasiswaData[index].nilai_huruf || '-';
        nilaiHurufSpan.className = `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition-colors ${getNilaiHurufClass(mahasiswaData[index].nilai_huruf)}`;

        // Update status
        const statusSpan = document.getElementById(`status-${index}`);
        statusSpan.textContent = getStatus(nilaiAngka);
        statusSpan.className = `inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition-colors ${getStatusClass(nilaiAngka)}`;

        // Update stats
        updateStats();
    }

    function convertToHuruf(nilaiAngka) {
        if (!nilaiAngka || nilaiAngka === '') return '';

        const nilai = parseFloat(nilaiAngka);
        // Sesuaikan dengan tabel nilai_mutu
        // A = 4.00, A- = 3.50, B = 3.00, B- = 2.50, C = 2.00, D = 1.00, E = 0.00
        if (nilai >= 85) return 'A';      // 85-100
        if (nilai >= 80) return 'A-';     // 80-84
        if (nilai >= 70) return 'B';      // 70-79
        if (nilai >= 65) return 'B-';     // 65-69
        if (nilai >= 55) return 'C';      // 55-64 (Batas Lulus)
        if (nilai >= 40) return 'D';      // 40-54
        return 'E';                        // 0-39
    }

    function getNilaiHurufClass(nilaiHuruf) {
        switch (nilaiHuruf) {
            case 'A':
            case 'A-':
                return 'bg-green-100 text-green-800';
            case 'B':
            case 'B-':
                return 'bg-blue-100 text-blue-800';
            case 'C':
                return 'bg-yellow-100 text-yellow-800';
            case 'D':
                return 'bg-orange-100 text-orange-800';
            case 'E':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }

    function getStatus(nilaiAngka) {
        if (nilaiAngka === null || nilaiAngka === '' || nilaiAngka === undefined) return 'Belum Diisi';
        const nilai = parseFloat(nilaiAngka);
        // Batas lulus adalah C (55)
        return nilai >= 55 ? 'Lulus' : 'Tidak Lulus';
    }

    function getStatusClass(nilaiAngka) {
        if (nilaiAngka === null || nilaiAngka === '' || nilaiAngka === undefined) return 'bg-gray-100 text-gray-800';
        const nilai = parseFloat(nilaiAngka);
        // Batas lulus adalah C (55)
        return nilai >= 55 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
    }

    async function clearAllNilai() {
        // Check if there are any grades to clear
        const hasGrades = mahasiswaData.some(m => m.nilai_angka !== null && m.nilai_angka !== '' && m.nilai_angka !== undefined);
        
        if (!hasGrades) {
            window.toast.warning('⚠️ Tidak ada nilai yang perlu dihapus', 2000);
            return;
        }

        // Check if any nilai is already saved in database (has nilai_angka from server)
        const hasSavedGrades = mahasiswaData.some(m => {
            // If nilai_angka exists and is not empty, it means it was loaded from database
            return m.nilai_angka !== null && m.nilai_angka !== '' && m.nilai_angka !== undefined;
        });

        let message = 'Apakah Anda yakin ingin menghapus semua nilai yang telah diinput?\n\n';
        if (hasSavedGrades) {
            message += '⚠️ PERHATIAN: Nilai yang sudah tersimpan akan dihapus secara permanen!';
        } else {
            message += 'Tindakan ini hanya menghapus nilai di form yang belum disimpan.';
        }

        const confirmed = await showConfirmDialog({
            title: 'Hapus Semua Nilai',
            message: message,
            confirmText: 'Ya, Hapus Semua',
            cancelText: 'Batal',
            type: 'danger'
        });

        if (!confirmed) {
            return;
        }

        // If there are saved grades, we need to delete from database
        if (hasSavedGrades) {
            const loadingToast = window.toast.info('🗑️ Menghapus nilai...', 10000);

            // Prepare data to delete (set nilai to null for ALL mahasiswa that have grades)
            const nilaiToDelete = mahasiswaData
                .filter(m => m.nilai_angka !== null && m.nilai_angka !== '' && m.nilai_angka !== undefined)
                .map(m => ({
                    nim: m.nim,
                    nilai_angka: null,
                    nilai_huruf: null
                }));

            console.log('Deleting nilai for:', nilaiToDelete); // Debug log
            console.log('Total to delete:', nilaiToDelete.length); // Debug log

            // Check if there's actually data to delete
            if (nilaiToDelete.length === 0) {
                window.toast.remove(loadingToast);
                window.toast.warning('⚠️ Tidak ada nilai yang tersimpan', 2000);
                return;
            }

            const requestData = {
                jadwal_id: selectedJadwalId,
                nilai: nilaiToDelete
            };
            
            console.log('Request data:', JSON.stringify(requestData)); // Debug log

            try {
                const response = await fetch('<?= base_url('dosen/nilai/save') ?>', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(requestData)
                });

                const data = await response.json();
                window.toast.remove(loadingToast);

                if (data.success) {
                    window.toast.success('✅ Semua nilai berhasil dihapus', 3000);
                    
                    // Reload data from server
                    setTimeout(() => {
                        loadMahasiswaData(selectedJadwalId);
                    }, 1500);
                } else {
                    window.toast.error('❌ Gagal menghapus nilai: ' + (data.message || 'Terjadi kesalahan'), 4000);
                }
            } catch (error) {
                window.toast.remove(loadingToast);
                console.error('Error deleting nilai:', error);
                window.toast.error('❌ Terjadi kesalahan saat menghapus nilai', 4000);
            }
        } else {
            // Just clear from form (not saved yet)
            mahasiswaData.forEach((mahasiswa) => {
                mahasiswa.nilai_angka = '';
                mahasiswa.nilai_huruf = '';
            });

            // Re-render table to update display
            renderMahasiswaTable();
            updateStats();
            window.toast.success('✅ Semua nilai telah dihapus dari form', 2000);
        }
    }

    function saveNilai() {
        // Validate that at least some grades are entered
        const hasGrades = mahasiswaData.some(m => m.nilai_angka !== null && m.nilai_angka !== '' && m.nilai_angka !== undefined);

        if (!hasGrades) {
            window.toast.warning('⚠️ Harap isi minimal satu nilai sebelum menyimpan', 4000);
            return;
        }

        // Filter only mahasiswa with nilai
        const nilaiToSave = mahasiswaData
            .filter(m => m.nilai_angka !== null && m.nilai_angka !== '' && m.nilai_angka !== undefined)
            .map(m => ({
                nim: m.nim,
                nilai_angka: parseFloat(m.nilai_angka),
                nilai_huruf: m.nilai_huruf
            }));

        console.log('Saving nilai:', nilaiToSave); // Debug log

        // Show loading
        const loadingToast = window.toast.info('💾 Menyimpan nilai...', 10000);

        // Send data to server
        fetch('<?= base_url('dosen/nilai/save') ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    jadwal_id: selectedJadwalId,
                    nilai: nilaiToSave
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                window.toast.remove(loadingToast);
                
                console.log('Save response:', data); // Debug log
                
                if (data.success) {
                    window.toast.success('✅ ' + data.message, 3000);

                    if (data.errors && data.errors.length > 0) {
                        data.errors.forEach(error => {
                            window.toast.warning('⚠️ ' + error, 4000);
                        });
                    }

                    // Reload data to show updated values
                    setTimeout(() => {
                        loadMahasiswaData(selectedJadwalId);
                    }, 1500);
                } else {
                    window.toast.error('❌ ' + (data.message || 'Gagal menyimpan nilai'), 4000);
                }
            })
            .catch(error => {
                window.toast.remove(loadingToast);
                console.error('Error saving nilai:', error);
                window.toast.error('❌ Terjadi kesalahan saat menyimpan nilai', 4000);
            });
    }
</script>
<?= $this->endSection() ?>