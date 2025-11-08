<!-- Sidebar -->
<aside id="sidebar" class="fixed left-0 top-16 w-64 bg-white shadow-lg h-full transform transition-transform duration-300 ease-in-out z-40">

    <div class="p-6">
        <nav class="space-y-2">
            <a href="<?= base_url('mahasiswa/dashboard') ?>"
                class="flex items-center px-4 py-3 text-gray-700 <?= (strpos(current_url(), 'mahasiswa/dashboard')) ? 'bg-blue-50 border-r-4 border-blue-500 text-gray-700' : 'hover:bg-gray-50' ?> rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                </svg>
                Dashboard
            </a>

            <a href="<?= base_url('mahasiswa/jadwal') ?>"
                class="flex items-center px-4 py-3 text-gray-600 <?= (strpos(current_url(), 'mahasiswa/jadwal') !== false) ? 'bg-blue-50 border-r-4 border-blue-500 text-gray-700' : 'hover:bg-gray-50' ?> rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Jadwal Kuliah
            </a>

            <a href="<?= base_url('mahasiswa/nilai') ?>"
                class="flex items-center px-4 py-3 text-gray-600 <?= (strpos(current_url(), 'mahasiswa/nilai') !== false) ? 'bg-blue-50 border-r-4 border-blue-500 text-gray-700' : 'hover:bg-gray-50' ?> rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                Nilai & Transkrip
            </a>

            <a href="<?= base_url('mahasiswa/krs') ?>"
                class="flex items-center px-4 py-3 text-gray-600 <?= (strpos(current_url(), 'mahasiswa/krs') !== false) ? 'bg-blue-50 border-r-4 border-blue-500 text-gray-700' : 'hover:bg-gray-50' ?> rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Rencana Studi (KRS)
            </a>

            <a href="<?= base_url('mahasiswa/hasil-studi') ?>"
                class="flex items-center px-4 py-3 text-gray-600 <?= (strpos(current_url(), 'mahasiswa/hasil-studi') !== false) ? 'bg-blue-50 border-r-4 border-blue-500 text-gray-700' : 'hover:bg-gray-50' ?> rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Hasil Studi
            </a>

            <a href="<?= base_url('mahasiswa/presensi') ?>" onclick="showDevelopmentToast('Presensi'); return false;"
                class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Presensi
            </a>

            <a href="<?= base_url('mahasiswa/pembayaran') ?>" onclick="showDevelopmentToast('Pembayaran'); return false;"
                class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Pembayaran
            </a>
        </nav>
    </div>
</aside>

<!-- Sidebar Overlay for Mobile -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden"></div>

<script>
    // Development toast function
    function showDevelopmentToast(featureName) {
        const message = `🚧 ${featureName} sedang dalam tahap pengembangan dan akan segera tersedia!`;
        if (window.toast) {
            window.toast.info(message, 4000);
        }
    }
</script>
