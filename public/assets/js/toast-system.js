/**
 * Universal Toast Notification System
 * Compatible dengan semua layout (Admin, Dosen, Mahasiswa)
 */

class UniversalToast {
    constructor() {
        this.container = null;
        this.toastId = 0;
        this.init();
    }

    init() {
        // Create toast container if not exists
        if (!document.getElementById('toast-container')) {
            this.createContainer();
        }
        this.container = document.getElementById('toast-container');
    }

    createContainer() {
        const container = document.createElement('div');
        container.id = 'toast-container';
        container.className = 'fixed bottom-4 right-4 z-[9999] flex flex-col-reverse space-y-reverse space-y-3 max-w-sm w-full pointer-events-none';
        
        // Add responsive styles
        const style = document.createElement('style');
        style.textContent = `
            @media (max-width: 640px) {
                #toast-container {
                    bottom: 1rem !important;
                    right: 1rem !important;
                    left: 1rem !important;
                    max-width: none !important;
                }
            }
            
            .toast-notification {
                pointer-events: auto;
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                margin-bottom: 0.75rem;
                transform: translateY(100%);
                opacity: 0;
                transition: all 0.3s ease-in-out;
            }
            
            .toast-notification.show {
                transform: translateY(0);
                opacity: 1;
            }
            
            .toast-notification:hover {
                transform: translateY(0) scale(1.02) !important;
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2), 0 10px 10px -5px rgba(0, 0, 0, 0.1) !important;
            }
        `;
        document.head.appendChild(style);
        document.body.appendChild(container);
    }

    show(message, type = 'info', duration = 5000) {
        const toast = this.createToast(message, type);
        this.container.appendChild(toast);

        // Animate in
        setTimeout(() => {
            toast.classList.add('show');
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
                icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>`
            },
            error: {
                bg: 'bg-red-500',
                border: 'border-red-600',
                icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>`
            },
            warning: {
                bg: 'bg-yellow-500',
                border: 'border-yellow-600',
                icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>`
            },
            info: {
                bg: 'bg-blue-500',
                border: 'border-blue-600',
                icon: `<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>`
            }
        };

        const colorScheme = colors[type];
        
        toast.className = `toast-notification w-full ${colorScheme.bg} ${colorScheme.border} border-l-4 text-white rounded-lg shadow-lg cursor-pointer relative overflow-hidden`;
        toast.innerHTML = `
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        ${colorScheme.icon}
                    </div>
                    <div class="ml-3 flex-1">
                        <p class="text-sm font-medium leading-5">${message}</p>
                    </div>
                    <div class="ml-4 flex-shrink-0">
                        <button onclick="universalToast.remove(this.closest('.toast-notification'))" class="inline-flex text-white hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50 rounded-full p-1 transition-colors">
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
            toast.classList.remove('show');
            
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
window.universalToast = new UniversalToast();

// Helper functions
function showToast(message, type = 'info', duration = 5000) {
    return window.universalToast.show(message, type, duration);
}

function showSuccess(message, duration = 4000) {
    return window.universalToast.success(message, duration);
}

function showError(message, duration = 5000) {
    return window.universalToast.error(message, duration);
}

function showWarning(message, duration = 5000) {
    return window.universalToast.warning(message, duration);
}

function showInfo(message, duration = 5000) {
    return window.universalToast.info(message, duration);
}

// Development Toast Function
function showDevelopmentToast(featureName) {
    const message = `🚧 ${featureName} sedang dalam tahap pengembangan dan akan segera tersedia!`;
    return window.universalToast.info(message, 4000);
}

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    if (!window.universalToast) {
        window.universalToast = new UniversalToast();
    }
});