<!-- Sidebar -->
<aside id="sidebar" class="fixed left-0 top-16 w-64 bg-white shadow-lg h-full transform transition-transform duration-300 ease-in-out z-40">

    <!-- Sidebar Header -->
    <div class="flex items-center p-2.5 border-b border-gray-200">
        <div class="flex items-center bg-blue-50 text-blue-700 px-3 py-1.5 rounded-lg border border-blue-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="font-medium">
                <span class="">Tahun Ajaran: </span>
                <?= date('Y') ?>/<?= date('Y') + 1 ?>
            </span>
        </div>
    </div>

    <div class="p-6">
        <nav class="space-y-2">
            <a href="<?= base_url('admin/dashboard') ?>"
                class="flex items-center px-4 py-3 text-gray-700 <?= (strpos(current_url(), 'admin/dashboard')) ? 'bg-yellow-50 border-r-4 border-yellow-400 text-gray-700' : 'hover:bg-gray-50' ?> rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                </svg>
                Dashboard
            </a>

            <a href="<?= base_url('admin/mahasiswa') ?>"
                class="flex items-center px-4 py-3 text-gray-600 <?= (strpos(current_url(), 'mahasiswa') !== false) ? 'bg-yellow-50 border-r-4 border-yellow-400 text-gray-700' : 'hover:bg-gray-50' ?> rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
                Mahasiswa
            </a>

            <a href="<?= base_url('admin/dosen') ?>"
                class="flex items-center px-4 py-3 text-gray-600 <?= (strpos(current_url(), 'dosen') !== false) ? 'bg-yellow-50 border-r-4 border-yellow-400 text-gray-700' : 'hover:bg-gray-50' ?> rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Dosen
            </a>

            <a href="<?= base_url('admin/ruangan') ?>"
                class="flex items-center px-4 py-3 text-gray-600 <?= (strpos(current_url(), 'ruangan') !== false) ? 'bg-yellow-50 border-r-4 border-yellow-400 text-gray-700' : 'hover:bg-gray-50' ?> rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Ruangan
            </a>

            <a href="<?= base_url('admin/jadwal') ?>"
                class="flex items-center px-4 py-3 text-gray-600 <?= (strpos(current_url(), 'jadwal') !== false) ? 'bg-yellow-50 border-r-4 border-yellow-400 text-gray-700' : 'hover:bg-gray-50' ?> rounded-l-lg transition duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Jadwal
            </a>
        </nav>
    </div>
</aside>

<!-- Sidebar Overlay for Mobile -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden"></div>