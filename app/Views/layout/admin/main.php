<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard Admin' ?> | SIPAKU</title>
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
            /* Important for flex child */
        }

        /* Ensure footer stays at bottom */
        footer {
            margin-top: auto;
        }

        /* Responsive adjustments */
        @media (min-width: 1024px) {
            .sidebar-open .main-wrapper {
                margin-left: 16rem;
                /* 64 * 0.25rem */
            }
        }
    </style>
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

        /* Toast Notification Styles */
        #toast-container {
            pointer-events: none;
            z-index: 2147483650 !important; /* Higher than modals */
        }

        .toast-notification {
            pointer-events: auto;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            margin-bottom: 0.75rem; /* Space between toasts */
        }

        .toast-notification:hover {
            transform: translateY(0) scale(1.02) !important;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1) !important;
        }

        .toast-progress {
            transition: width 5s ease-linear;
        }

        /* Ensure toast doesn't interfere with footer */
        .toast-notification {
            margin-bottom: 0.75rem;
        }

        /* Better stacking for bottom positioning */
        #toast-container .toast-notification:last-child {
            margin-bottom: 0;
        }

        /* Responsive toast positioning */
        @media (max-width: 640px) {
            #toast-container {
                bottom: 1rem !important;
                right: 1rem !important;
                left: 1rem !important;
                max-width: none !important;
            }
            
            .toast-notification {
                margin-bottom: 0.5rem;
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

        /* Session indicator pulse animation */
        #session-indicator {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
        }

        /* Tablet positioning */
        @media (min-width: 641px) and (max-width: 1024px) {
            #toast-container {
                bottom: 1.5rem !important;
                right: 1.5rem !important;
                max-width: 20rem !important;
            }
        }

        /* Modal specific styles - Ensure highest priority */
        .admin-modal {
            z-index: 2147483647 !important;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            width: 100vw !important;
            height: 100vh !important;
            backdrop-filter: blur(2px) !important;
        }

        .admin-modal.hidden {
            backdrop-filter: none !important;
        }

        .modal-content {
            z-index: 2147483647 !important;
            position: relative !important;
        }

        /* Ensure modal is above everything */
        body.modal-open {
            overflow: hidden !important;
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
    <?= $this->include('layout/admin/navbar') ?>

    <!-- Include Sidebar -->
    <?= $this->include('layout/admin/sidebar') ?>

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
            <?= $this->include('layout/admin/footer') ?>
        </main>
    </div>
    <div id="toast-container" class="fixed bottom-4 right-4 z-[2147483650] flex flex-col-reverse space-y-reverse space-y-3 max-w-sm w-full">
        <!-- Toast notifications will be inserted here -->
    </div>
    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbarToggle = document.getElementById('navbar-toggle');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const mainContent = document.getElementById('main-content');
            const mainWrapper = document.querySelector('.main-wrapper');
            const breadcrumb = document.getElementById('breadcrumb');

            // Track sidebar state - Default open on desktop
            let sidebarOpen = window.innerWidth >= 1024;

            // Initialize proper state on load
            function initializeLayout() {
                if (window.innerWidth >= 1024) {
                    if (sidebarOpen) {
                        // Desktop: start with sidebar open (default)   
                        sidebar.classList.remove('-translate-x-full');
                        mainContent.classList.add('lg:ml-64');
                        if (breadcrumb) breadcrumb.classList.add('lg:ml-64');
                    } else {
                        // Desktop: collapsed state
                        sidebar.classList.add('-translate-x-full');
                        mainContent.classList.remove('lg:ml-64');
                        if (breadcrumb) breadcrumb.classList.remove('lg:ml-64');
                    }
                } else {
                    // Mobile: always start with sidebar closed
                    sidebar.classList.add('-translate-x-full');
                    mainContent.classList.remove('lg:ml-64');
                    if (breadcrumb) breadcrumb.classList.remove('lg:ml-64');
                    if (overlay) overlay.classList.add('hidden');
                    sidebarOpen = false;
                }
            }

            // Initialize on load
            initializeLayout();

            // Function to toggle sidebar
            function toggleSidebar() {
                if (window.innerWidth < 1024) {
                    // Mobile behavior: toggle sidebar with overlay
                    if (sidebarOpen) {
                        // Close sidebar
                        sidebar.classList.add('-translate-x-full');
                        if (overlay) overlay.classList.add('hidden');
                    } else {
                        // Open sidebar
                        sidebar.classList.remove('-translate-x-full');
                        if (overlay) overlay.classList.remove('hidden');
                    }
                } else {
                    // Desktop behavior: toggle sidebar and adjust content
                    if (sidebarOpen) {
                        // Close sidebar
                        sidebar.classList.add('-translate-x-full');
                        mainContent.classList.remove('lg:ml-64');
                        if (breadcrumb) breadcrumb.classList.remove('lg:ml-64');
                    } else {
                        // Open sidebar
                        sidebar.classList.remove('-translate-x-full');
                        mainContent.classList.add('lg:ml-64');
                        if (breadcrumb) breadcrumb.classList.add('lg:ml-64');
                    }
                }

                sidebarOpen = !sidebarOpen;
            }

            // Navbar Toggle Event Listener
            if (navbarToggle) {
                navbarToggle.addEventListener('click', toggleSidebar);
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

            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 1024) {
                    // Desktop: hide overlay
                    if (overlay) overlay.classList.add('hidden');

                    // Maintain sidebar state but ensure proper classes
                    if (sidebarOpen) {
                        sidebar.classList.remove('-translate-x-full');
                        mainContent.classList.add('lg:ml-64');
                        if (breadcrumb) breadcrumb.classList.add('lg:ml-64');
                    } else {
                        sidebar.classList.add('-translate-x-full');
                        mainContent.classList.remove('lg:ml-64');
                        if (breadcrumb) breadcrumb.classList.remove('lg:ml-64');
                    }
                } else {
                    // Mobile: always close sidebar and show overlay if needed
                    if (sidebarOpen) {
                        if (overlay) overlay.classList.remove('hidden');
                    } else {
                        sidebar.classList.add('-translate-x-full');
                        if (overlay) overlay.classList.add('hidden');
                    }
                    mainContent.classList.remove('lg:ml-64');
                    if (breadcrumb) breadcrumb.classList.remove('lg:ml-64');
                }
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

                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    if (!userMenuButton.contains(event.target) && !userDropdown.contains(event.target)) {
                        userDropdown.classList.add('hidden');
                    }
                });

                // Close dropdown when pressing Escape
                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Escape') {
                        userDropdown.classList.add('hidden');
                    }
                });
            }
        });

        function logout() {
            // Close dropdown first
            const userDropdown = document.getElementById('user-dropdown');
            if (userDropdown) {
                userDropdown.classList.add('hidden');
            }
            
            // Show confirmation with better styling
            if (confirm('🔐 Apakah Anda yakin ingin logout?\n\nSesi Anda akan berakhir dan Anda perlu login kembali.')) {
                // Show loading state
                const button = event.target;
                const originalText = button.innerHTML;
                button.innerHTML = `
                    <svg class="w-4 h-4 mr-3 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Logging out...
                `;
                button.disabled = true;
                
                // Redirect after short delay for UX
                setTimeout(() => {
                    window.location.href = '<?= base_url('logout') ?>';
                }, 500);
            }
        }
    </script>
    <!-- Load compiled JavaScript -->
    <!-- Toast Notification Container -->

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

                // Animate in
                setTimeout(() => {
                    toast.classList.remove('translate-y-full', 'opacity-0');
                    toast.classList.add('translate-y-0', 'opacity-100');
                }, 10);

                // Auto remove after duration
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
                        border: 'border-green-600',
                        progress: 'bg-green-300'
                    },
                    error: {
                        bg: 'bg-red-500',
                        border: 'border-red-600',
                        progress: 'bg-red-300'
                    },
                    warning: {
                        bg: 'bg-yellow-500',
                        border: 'border-yellow-600',
                        progress: 'bg-yellow-300'
                    },
                    info: {
                        bg: 'bg-blue-500',
                        border: 'border-blue-600',
                        progress: 'bg-blue-300'
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

        // Helper functions for backward compatibility
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
    
    <!-- Session Timeout Warning System -->
    <script>
        // Session Timeout Management
        class SessionManager {
            constructor() {
                this.warningShown = false;
                this.checkInterval = 60000; // Check every minute
                this.warningTime = 300; // 5 minutes before timeout
                this.sessionTimeout = 1800; // 30 minutes
                
                this.init();
            }

            init() {
                // Check session status periodically
                setInterval(() => {
                    this.checkSessionStatus();
                }, this.checkInterval);

                // Reset activity on user interaction
                this.resetActivityTimer();
            }

            checkSessionStatus() {
                // Check if user is logged in
                <?php if (session()->get('isLoggedIn')): ?>
                    const sessionWarning = <?= session()->get('session_warning') ? 'true' : 'false' ?>;
                    const timeRemaining = <?= session()->get('time_remaining') ?? 0 ?>;

                    if (sessionWarning && !this.warningShown) {
                        this.showSessionWarning(timeRemaining);
                    }
                <?php endif; ?>
            }

            showSessionWarning(timeRemaining) {
                this.warningShown = true;
                const minutes = Math.floor(timeRemaining / 60);
                const seconds = timeRemaining % 60;
                
                // Show session indicator in navbar
                const sessionIndicator = document.getElementById('session-indicator');
                const sessionTime = document.getElementById('session-time');
                if (sessionIndicator && sessionTime) {
                    sessionIndicator.classList.remove('hidden');
                    sessionTime.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                    
                    // Update countdown every second
                    const countdown = setInterval(() => {
                        const newTimeRemaining = timeRemaining - (Date.now() - Date.now()) / 1000;
                        if (newTimeRemaining <= 0) {
                            clearInterval(countdown);
                            sessionIndicator.classList.add('hidden');
                            return;
                        }
                        const mins = Math.floor(newTimeRemaining / 60);
                        const secs = Math.floor(newTimeRemaining % 60);
                        sessionTime.textContent = `${mins}:${secs.toString().padStart(2, '0')}`;
                    }, 1000);
                }
                
                const warningToast = window.toast.warning(
                    `⏰ Sesi Anda akan berakhir dalam ${minutes} menit. Klik di sini untuk memperpanjang sesi.`,
                    15000 // Show for 15 seconds
                );

                // Add click handler to extend session
                warningToast.addEventListener('click', () => {
                    this.extendSession();
                    window.toast.remove(warningToast);
                    if (sessionIndicator) {
                        sessionIndicator.classList.add('hidden');
                    }
                });
            }

            extendSession() {
                // Make AJAX request to extend session
                fetch('<?= base_url('extend-session') ?>', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.warningShown = false;
                        window.toast.success('Sesi berhasil diperpanjang');
                    } else {
                        window.toast.error('Gagal memperpanjang sesi');
                    }
                }).catch(error => {
                    console.error('Error extending session:', error);
                    window.toast.error('Terjadi kesalahan saat memperpanjang sesi');
                });
            }

            resetActivityTimer() {
                // Reset activity on various user interactions
                const events = ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart', 'click'];
                
                events.forEach(event => {
                    document.addEventListener(event, () => {
                        this.warningShown = false;
                    }, { passive: true });
                });
            }
        }

        // Initialize session manager for logged in users
        <?php if (session()->get('isLoggedIn')): ?>
            document.addEventListener('DOMContentLoaded', function() {
                window.sessionManager = new SessionManager();
            });
        <?php endif; ?>
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>