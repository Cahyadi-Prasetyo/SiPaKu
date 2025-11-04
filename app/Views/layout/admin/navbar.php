<!-- Top Navigation -->
<nav id="navbar" class="bg-blue-800 shadow-lg fixed w-full top-0 z-50">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Side -->
            <div class="flex items-center">
                <div class="hidden lg:flex items-center">
                    <!-- Logo - Always visible on desktop -->
                    <div id="navbar-logo" class="flex items-center">
                        <div class="w-8 h-7 bg-yellow-400 rounded-full flex items-center justify-center mr-3">
                            <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="text-white text-lg font-bold">SIPAKU</span>
                            <div class="text-yellow-400 text-xs">Sistem Informasi Akademik</div>
                        </div>
                    </div>
                </div>
                <!-- Toggle Button - Visible when sidebar is closed -->
                <button id="navbar-toggle" class="text-white hover:bg-blue-700 p-2 rounded-lg mr-4 transition-all duration-300 cursor-pointer">
                    <svg class="w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-2 sm:space-x-4">
                <!-- Session Status Indicator (Hidden by default, shown when warning) -->
                <div id="session-indicator" class="hidden">
                    <div class="flex items-center bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span id="session-time">30:00</span>
                    </div>
                </div>

                <!-- User Profile Dropdown -->
                <div class="relative">
                    <button id="user-menu-button" class="flex items-center text-white hover:bg-blue-700 px-3 py-2 rounded-lg transition duration-300">
                        <div class="w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center mr-2">
                            <span class="text-gray-800 font-semibold text-sm">
                                <?= strtoupper(substr(session()->get('nama_user') ?? 'U', 0, 1)) ?>
                            </span>
                        </div>
                        <div class="text-left">
                            <div class="text-sm font-medium"><?= session()->get('nama_user') ?? 'User' ?></div>
                            <div class="text-xs text-yellow-400"><?= ucfirst(session()->get('role') ?? 'Guest') ?></div>
                        </div>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg py-2 z-50 border border-gray-200">
                        <!-- User Info Header -->
                        <div class="px-4 py-3 border-b border-gray-100">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-yellow-400 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-gray-800 font-semibold">
                                        <?= strtoupper(substr(session()->get('nama_user') ?? 'U', 0, 1)) ?>
                                    </span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900"><?= session()->get('nama_user') ?? 'User' ?></div>
                                    <div class="text-xs text-gray-500"><?= session()->get('kode') ?? '' ?></div>
                                    <div class="text-xs text-blue-600 font-medium"><?= ucfirst(session()->get('role') ?? 'Guest') ?></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Menu Items -->
                        <div class="py-1">
                            <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profile Saya
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 transition-colors">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Pengaturan
                            </a>
                        </div>
                        
                        <hr class="my-1">
                        
                        <!-- Logout Button -->
                        <div class="py-1">
                            <button onclick="logout()" class="flex items-center w-full px-4 py-2 text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Breadcrumb Navigation -->
<div id="breadcrumb" class="bg-white border-b border-gray-200 mt-16 transition-all duration-300 ease-in-out lg:ml-64">
    <div class="px-4 sm:px-6 lg:px-8 py-5">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 lg:gap-4">

            <!-- Right Side - Breadcrumb Navigation -->
            <nav class="flex items-center space-x-2 text-sm order-2 lg:order-2">
                <a href="<?= base_url('admin/dashboard') ?>" class="text-blue-600 hover:text-blue-800 transition duration-200">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span class="hidden sm:inline">Home</span>
                </a>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-gray-700 font-medium"><?= $breadcrumb ?? '' ?></span>
            </nav>
        </div>
    </div>
</div>