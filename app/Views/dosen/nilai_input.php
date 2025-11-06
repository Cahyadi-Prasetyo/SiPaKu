<?= $this->extend('layout/dosen/main') ?>

<?= $this->section('head') ?>
<style>
    /* Modal positioning improvements */
    #nilai-modal {
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
    }
    
    #nilai-modal .modal-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 1rem;
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
    }
    
    #nilai-modal:not(.hidden) .modal-panel {
        transform: scale(1);
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
                        <?= $jadwal['jumlah_mahasiswa'] ?? '0' ?> mahasiswa
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

<!-- Modal Input Nilai -->
<div id="nilai-modal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Background overlay -->
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity" aria-hidden="true" onclick="closeNilaiModal()"></div>
    
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
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    mahasiswaData = data.mahasiswa || [];
                    renderModalContent();
                    updateModalClassInfo(data.jadwal);
                } else {
                    window.toast.error('❌ ' + (data.message || 'Gagal memuat data mahasiswa'));
                    closeNilaiModal();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Fallback to sample data for development
                loadSampleData(jadwalId);
            });
    }

    function loadSampleData(jadwalId) {
        // Sample data as fallback
        const sampleData = {
            1: {
                title: 'Pemrograman Web A',
                info: 'Pemrograman Web (3 SKS) - Senin, 08:00-10:30',
                mahasiswa: [
                    { nim: '2021001', nama: 'Ahmad Rizki Pratama', nilai_angka: '', nilai_huruf: '' },
                    { nim: '2021002', nama: 'Siti Nurhaliza', nilai_angka: '85', nilai_huruf: 'A' },
                    { nim: '2021003', nama: 'Budi Santoso', nilai_angka: '', nilai_huruf: '' },
                    { nim: '2021004', nama: 'Dewi Sartika', nilai_angka: '78', nilai_huruf: 'B+' },
                    { nim: '2021005', nama: 'Eko Prasetyo', nilai_angka: '', nilai_huruf: '' }
                ]
            },
            2: {
                title: 'Basis Data B',
                info: 'Sistem Basis Data (3 SKS) - Rabu, 13:00-15:30',
                mahasiswa: [
                    { nim: '2021006', nama: 'Fitri Handayani', nilai_angka: '90', nilai_huruf: 'A' },
                    { nim: '2021007', nama: 'Gilang Ramadhan', nilai_angka: '', nilai_huruf: '' },
                    { nim: '2021008', nama: 'Hana Pertiwi', nilai_angka: '72', nilai_huruf: 'B' },
                    { nim: '2021009', nama: 'Indra Kusuma', nilai_angka: '', nilai_huruf: '' }
                ]
            },
            3: {
                title: 'Algoritma C',
                info: 'Algoritma dan Pemrograman (2 SKS) - Jumat, 10:00-11:40',
                mahasiswa: [
                    { nim: '2021010', nama: 'Joko Widodo', nilai_angka: '', nilai_huruf: '' },
                    { nim: '2021011', nama: 'Kartika Sari', nilai_angka: '65', nilai_huruf: 'B-' },
                    { nim: '2021012', nama: 'Lestari Wulan', nilai_angka: '', nilai_huruf: '' }
                ]
            }
        };

        const selectedData = sampleData[jadwalId] || sampleData[1];
        mahasiswaData = selectedData.mahasiswa;

        renderModalContent();
        updateModalClassInfo(selectedData);
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
        const sudahDinilai = mahasiswaData.filter(m => m.nilai_angka !== '').length;
        const belumDinilai = total - sudahDinilai;
        const tidakLulus = mahasiswaData.filter(m => {
            const nilai = parseFloat(m.nilai_angka);
            return m.nilai_angka !== '' && nilai < 55;
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

            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${index + 1}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${mahasiswa.nim}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${mahasiswa.nama}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <input type="number" 
                           min="0" 
                           max="100" 
                           value="${mahasiswa.nilai_angka}"
                           onchange="updateNilai(${index}, this.value)"
                           class="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 text-sm transition-colors">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span id="nilai-huruf-${index}" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition-colors ${getNilaiHurufClass(mahasiswa.nilai_huruf)}">
                        ${mahasiswa.nilai_huruf || '-'}
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
        if (nilai >= 85) return 'A';
        if (nilai >= 80) return 'A-';
        if (nilai >= 75) return 'B+';
        if (nilai >= 70) return 'B';
        if (nilai >= 65) return 'B-';
        if (nilai >= 60) return 'C+';
        if (nilai >= 55) return 'C';
        if (nilai >= 50) return 'C-';
        if (nilai >= 45) return 'D+';
        if (nilai >= 40) return 'D';
        return 'E';
    }

    function getNilaiHurufClass(nilaiHuruf) {
        switch (nilaiHuruf) {
            case 'A':
            case 'A-':
                return 'bg-green-100 text-green-800';
            case 'B+':
            case 'B':
            case 'B-':
                return 'bg-blue-100 text-blue-800';
            case 'C+':
            case 'C':
            case 'C-':
                return 'bg-yellow-100 text-yellow-800';
            case 'D+':
            case 'D':
                return 'bg-orange-100 text-orange-800';
            case 'E':
                return 'bg-red-100 text-red-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }

    function getStatus(nilaiAngka) {
        if (!nilaiAngka || nilaiAngka === '') return 'Belum Diisi';
        const nilai = parseFloat(nilaiAngka);
        return nilai >= 55 ? 'Lulus' : 'Tidak Lulus';
    }

    function getStatusClass(nilaiAngka) {
        if (!nilaiAngka || nilaiAngka === '') return 'bg-gray-100 text-gray-800';
        const nilai = parseFloat(nilaiAngka);
        return nilai >= 55 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
    }

    function clearAllNilai() {
        if (!confirm('Apakah Anda yakin ingin menghapus semua nilai?')) {
            return;
        }

        mahasiswaData.forEach(mahasiswa => {
            mahasiswa.nilai_angka = '';
            mahasiswa.nilai_huruf = '';
        });

        renderMahasiswaTable();
        updateStats();
        window.toast.info('🗑️ Semua nilai telah dihapus', 2000);
    }

    function saveNilai() {
        // Validate that at least some grades are entered
        const hasGrades = mahasiswaData.some(m => m.nilai_angka !== '');

        if (!hasGrades) {
            window.toast.warning('⚠️ Harap isi minimal satu nilai sebelum menyimpan', 4000);
            return;
        }

        // Show loading
        const loadingToast = window.toast.info('💾 Menyimpan nilai...', 10000);

        // Send data to server
        fetch('<?= base_url('dosen/nilai/save') ?>', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                },
                body: JSON.stringify({
                    jadwal_id: selectedJadwalId,
                    nilai: mahasiswaData
                })
            })
            .then(response => response.json())
            .then(data => {
                window.toast.remove(loadingToast);
                
                if (data.success) {
                    window.toast.success('✅ ' + data.message, 3000);

                    if (data.errors && data.errors.length > 0) {
                        data.errors.forEach(error => {
                            window.toast.warning('⚠️ ' + error, 4000);
                        });
                    }

                    // Close modal after successful save
                    setTimeout(() => {
                        closeNilaiModal();
                    }, 2000);
                } else {
                    window.toast.error('❌ ' + (data.message || 'Gagal menyimpan nilai'));
                }
            })
            .catch(error => {
                window.toast.remove(loadingToast);
                console.error('Error:', error);
                window.toast.error('❌ Terjadi kesalahan saat menyimpan nilai');
            });
    }
</script>
<?= $this->endSection() ?>