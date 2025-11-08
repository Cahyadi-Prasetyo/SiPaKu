<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard Mahasiswa' ?> | SIPAKU</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
    <style>
        /* Sticky Footer Layout */
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .main-wrapper {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .page-content {
            flex: 1;
            min-height: 0;
        }

        footer {
            margin-top: auto;
        }

        /* Responsive adjustments */
        @media (min-width: 1024px) {
            .sidebar-open .main-wrapper {
                margin-left: 16rem;
            }
        }

        /* Mahasiswa specific adjustments - keeping same structure as dosen */

        /* Toast Notification Styles */
        #toast-container {
            pointer-events: none;
            z-index: 2147483650 !important;
        }

        .toast-notification {
            pointer-events: auto;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            margin-bottom: 0.75rem;
        }

        .toast-notification:hover {
            transform: translateY(0) scale(1.02) !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1) !important;
        }

        /* Responsive toast positioning */
        @media (max-width: 640px) {
            #toast-container {
                bottom: 1rem !important;
                right: 1rem !important;
                left: 1rem !important;
                max-width: none !important;
            }
        }

        /* Navbar improvements */
        #user-dropdown {
            animation: slideDown 0.2s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Loading animation */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>
    <?= $this->renderSection('head') ?>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Include Navbar -->
    <?= $this->include('layout/mahasiswa/navbar') ?>

    <!-- Include Sidebar -->
    <?= $this->include('layout/mahasiswa/sidebar') ?>

    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        <!-- Main Content -->
        <main id="main-content" class="content-area transition-all duration-300 ease-in-out lg:ml-64">
            <div class="page-content px-4 sm:px-6 lg:px-8 py-6 lg:py-8">
                <div class="max-w-none">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>

            <!-- Include Footer -->
            <?= $this->include('layout/mahasiswa/footer') ?>
        </main>
    </div>

    <!-- Toast Container -->
    <div id="toast-container" class="fixed bottom-4 right-4 z-[2147483650] flex flex-col-reverse space-y-reverse space-y-3 max-w-sm w-full">
        <!-- Toast notifications will be inserted here -->
    </div>
    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbarToggle = document.getElementById('navbar-toggle');
            const navbarToggleDesktop = document.getElementById('navbar-toggle-desktop');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const mainContent = document.getElementById('main-content');
            const quickInfo = document.getElementById('navbar-quick-info');

            // Track sidebar state - Default open on desktop
            let sidebarOpen = window.innerWidth >= 1024;

            // Initialize proper state on load
            function initializeLayout() {
                updateQuickInfo();

                if (window.innerWidth >= 1024) {
                    if (sidebarOpen) {
                        sidebar.classList.remove('-translate-x-full');
                        mainContent.classList.add('lg:ml-64');
                    } else {
                        sidebar.classList.add('-translate-x-full');
                        mainContent.classList.remove('lg:ml-64');
                    }
                } else {
                    sidebar.classList.add('-translate-x-full');
                    mainContent.classList.remove('lg:ml-64');
                    if (overlay) overlay.classList.add('hidden');
                    sidebarOpen = false;
                }
            }

            initializeLayout();

            // Function to update quick info visibility
            function updateQuickInfo() {
                const breadcrumb = document.getElementById('breadcrumb');

                // Update breadcrumb margin
                if (breadcrumb) {
                    if (sidebarOpen) {
                        breadcrumb.classList.add('lg:ml-64');
                    } else {
                        breadcrumb.classList.remove('lg:ml-64');
                    }
                }
            }

            // Function to toggle sidebar
            function toggleSidebar() {
                if (window.innerWidth < 1024) {
                    if (sidebarOpen) {
                        sidebar.classList.add('-translate-x-full');
                        if (overlay) overlay.classList.add('hidden');
                    } else {
                        sidebar.classList.remove('-translate-x-full');
                        if (overlay) overlay.classList.remove('hidden');
                    }
                } else {
                    if (sidebarOpen) {
                        sidebar.classList.add('-translate-x-full');
                        mainContent.classList.remove('lg:ml-64');
                    } else {
                        sidebar.classList.remove('-translate-x-full');
                        mainContent.classList.add('lg:ml-64');
                    }
                }
                sidebarOpen = !sidebarOpen;
                updateQuickInfo();
            }

            // Navbar Toggle Event Listener
            if (navbarToggle) {
                navbarToggle.addEventListener('click', toggleSidebar);
            }
            
            if (navbarToggleDesktop) {
                navbarToggleDesktop.addEventListener('click', toggleSidebar);
            }

            // Close sidebar when clicking overlay (mobile only)
            if (overlay) {
                overlay.addEventListener('click', function() {
                    if (window.innerWidth < 1024) {
                        sidebar.classList.add('-translate-x-full');
                        overlay.classList.add('hidden');
                        sidebarOpen = false;
                    }
                });
            }

            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    if (overlay) overlay.classList.add('hidden');
                    if (sidebarOpen) {
                        sidebar.classList.remove('-translate-x-full');
                        mainContent.classList.add('lg:ml-64');
                    } else {
                        sidebar.classList.add('-translate-x-full');
                        mainContent.classList.remove('lg:ml-64');
                    }
                } else {
                    if (sidebarOpen) {
                        if (overlay) overlay.classList.remove('hidden');
                    } else {
                        sidebar.classList.add('-translate-x-full');
                        if (overlay) overlay.classList.add('hidden');
                    }
                    mainContent.classList.remove('lg:ml-64');
                }
                updateQuickInfo();
            });
        });
    </script>

    <script>
        // User Dropdown Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const userMenuButton = document.getElementById('user-menu-button');
            const userDropdown = document.getElementById('user-dropdown');

            if (userMenuButton && userDropdown) {
                userMenuButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('hidden');
                });

                document.addEventListener('click', function(event) {
                    if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                        userDropdown.classList.add('hidden');
                    }
                });

                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        userDropdown.classList.add('hidden');
                    }
                });
            }
        });

        function logout() {
            const userDropdown = document.getElementById('user-dropdown');
            if (userDropdown) {
                userDropdown.classList.add('hidden');
            }

            const loadingToast = window.toast.info('⏳ Sedang logout...', 5000);

            setTimeout(() => {
                window.toast.remove(loadingToast);
                window.toast.success('✅ Logout berhasil! Mengalihkan...', 2000);

                setTimeout(() => {
                    window.location.href = '<?= base_url('logout') ?>';
                }, 1500);
            }, 800);
        }
    </script>

    <!-- Real-time Clock -->
    <script>
        function updateClock() {
            const now = new Date();
            const options = {
                timeZone: 'Asia/Jakarta',
                year: 'numeric',
                month: 'short',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            };

            const timeString = now.toLocaleDateString('id-ID', options).replace(',', ',') + ' WIB';
            const clockElement = document.getElementById('current-time');
            if (clockElement) {
                clockElement.textContent = timeString;
            }
        }

        // Update clock every minute
        setInterval(updateClock, 60000);

        // Update immediately on load
        document.addEventListener('DOMContentLoaded', updateClock);
    </script>

    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <!-- Toast Notification System -->
    <script>
        // Toast Notification System
        class ToastNotification {
            constructor() {
                this.container = document.getElementById('toast-container');
                this.toastId = 0;
            }

            show(message, type = 'success', duration = 5000) {
                const toast = this.createToast(message, type);
                this.container.appendChild(toast);

                setTimeout(() => {
                    toast.classList.remove('translate-y-full', 'opacity-0');
                    toast.classList.add('translate-y-0', 'opacity-100');
                }, 10);

                setTimeout(() => {
                    this.remove(toast);
                }, duration);

                return toast;
            }

            createToast(message, type) {
                const toastId = ++this.toastId;
                const toast = document.createElement('div');

                const colors = {
                    success: {
                        bg: 'bg-green-500',
                        border: 'border-green-600'
                    },
                    error: {
                        bg: 'bg-red-500',
                        border: 'border-red-600'
                    },
                    warning: {
                        bg: 'bg-yellow-500',
                        border: 'border-yellow-600'
                    },
                    info: {
                        bg: 'bg-blue-500',
                        border: 'border-blue-600'
                    }
                };

                const icons = {
                    success: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>`,
                    error: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>`,
                    warning: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>`,
                    info: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>`
                };

                const colorScheme = colors[type];

                toast.className = `toast-notification transform transition-all duration-300 ease-in-out translate-y-full opacity-0 w-full ${colorScheme.bg} ${colorScheme.border} border-l-4 text-white rounded-lg shadow-lg cursor-pointer relative overflow-hidden`;
                toast.innerHTML = `
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                ${icons[type]}
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium leading-5">${message}</p>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <button onclick="window.toast.remove(this.closest('.toast-notification'))" class="inline-flex text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 rounded-full p-1 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                `;

                return toast;
            }

            remove(toast) {
                if (toast && toast.parentNode) {
                    toast.classList.remove('translate-y-0', 'opacity-100');
                    toast.classList.add('translate-y-full', 'opacity-0');

                    setTimeout(() => {
                        if (toast.parentNode) {
                            toast.parentNode.removeChild(toast);
                        }
                    }, 300);
                }
            }

            success(message, duration = 4000) {
                return this.show(message, 'success', duration);
            }

            error(message, duration = 5000) {
                return this.show(message, 'error', duration);
            }

            warning(message, duration = 5000) {
                return this.show(message, 'warning', duration);
            }

            info(message, duration = 5000) {
                return this.show(message, 'info', duration);
            }
        }

        // Initialize global toast instance
        window.toast = new ToastNotification();

        // Helper functions
        function showToast(message, type = 'success', duration = 5000) {
            return window.toast.show(message, type, duration);
        }

        function showSuccess(message, duration = 5000) {
            return window.toast.success(message, duration);
        }

        function showError(message, duration = 5000) {
            return window.toast.error(message, duration);
        }

        function showWarning(message, duration = 5000) {
            return window.toast.warning(message, duration);
        }

        function showInfo(message, duration = 5000) {
            return window.toast.info(message, duration);
        }
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>
