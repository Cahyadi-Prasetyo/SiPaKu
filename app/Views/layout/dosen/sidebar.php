<!-- Sidebar -->
<aside id="sidebar" class="fixed left-0 top-16 w-64 bg-white shadow-lg h-full transform transition-transform duration-300 ease-in-out z-40">

    <div class="p-6">
        <nav class="space-y-2">
            <a href="<?= base_url('dosen/dashboard') ?>"
                class="flex items-center px-4 py-3 text-gray-700 <?= (strpos(current_url(), 'dosen/dashboard')) ? 'bg-yellow-50 border-r-4 border-yellow-400 text-gray-700' : 'hover:bg-gray-50' ?> rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                </svg>
                Dashboard
            </a>

            <a href="<?= base_url('dosen/jadwal') ?>"
                class="flex items-center px-4 py-3 text-gray-600 <?= (strpos(current_url(), 'dosen/jadwal') !== false) ? 'bg-yellow-50 border-r-4 border-yellow-400 text-gray-700' : 'hover:bg-gray-50' ?> rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Jadwal Mengajar
            </a>

            <a href="<?= base_url('dosen/nilai') ?>"
                class="flex items-center px-4 py-3 text-gray-600 <?= (strpos(current_url(), 'dosen/nilai') !== false) ? 'bg-yellow-50 border-r-4 border-yellow-400 text-gray-700' : 'hover:bg-gray-50' ?> rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                Input Nilai
            </a>

            <a href="<?= base_url('dosen/riwayat') ?>" onclick="showDevelopmentToast('Riwayat Mengajar'); return false;"
                class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Riwayat Mengajar
            </a>

            <a href="<?= base_url('dosen/laporan') ?>" onclick="showDevelopmentToast('Laporan'); return false;"
                class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
                Laporan
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