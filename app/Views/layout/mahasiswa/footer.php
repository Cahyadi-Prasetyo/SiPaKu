<!-- Footer -->
<footer class="bg-white border-t border-gray-200 mt-auto">
    <div class="max-w-7xl mx-auto py-6 px-8 sm:px-8 lg:px-8">
        <div class="flex flex-col sm:flex-row justify-between items-center space-y-2 sm:space-y-0">
            <div class="flex items-center">
                <p class="text-sm text-gray-500">
                    © <?= date('Y') ?> SIPAKU. Portal Mahasiswa - Sistem Informasi Akademik.
                </p>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-xs text-gray-400">Version 1.0.0</span>
                <span class="text-xs text-gray-400 hidden sm:inline">|</span>
                <a href="#" onclick="showDevelopmentToast('Bantuan'); return false;" class="text-xs text-blue-600 hover:text-blue-800">Bantuan</a>
                <span class="text-xs text-gray-400 hidden sm:inline">|</span>
                <a href="#" onclick="showDevelopmentToast('Kontak'); return false;" class="text-xs text-blue-600 hover:text-blue-800">Kontak</a>
            </div>
        </div>
        
    </div>
</footer>

<style>
    /* Custom Toast Styles */
    .custom-toast {
        position: fixed;
        top: 20px;
        right: 20px;
        min-width: 300px;
        max-width: 500px;
        padding: 16px 20px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        gap: 12px;
        z-index: 9999;
        animation: slideInRight 0.3s ease-out, fadeOut 0.3s ease-in 2.7s;
        backdrop-filter: blur(10px);
    }
    
    .custom-toast.success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }
    
    .custom-toast.error {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    
    .custom-toast.warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }
    
    .custom-toast.info {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }
    
    .toast-icon {
        flex-shrink: 0;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    
    .toast-content {
        flex: 1;
        font-size: 14px;
        font-weight: 500;
        line-height: 1.4;
    }
    
    .toast-close {
        flex-shrink: 0;
        width: 20px;
        height: 20px;
        border: none;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        transition: background 0.2s;
    }
    
    .toast-close:hover {
        background: rgba(255, 255, 255, 0.3);
    }
    
    @keyframes slideInRight {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }
    
    /* Custom Confirm Modal */
    .confirm-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        animation: fadeIn 0.2s ease-out;
    }
    
    .confirm-modal {
        background: white;
        border-radius: 16px;
        padding: 24px;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: scaleIn 0.3s ease-out;
    }
    
    .confirm-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 16px;
    }
    
    .confirm-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
    }
    
    .confirm-icon.warning {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #d97706;
    }
    
    .confirm-icon.danger {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #dc2626;
    }
    
    .confirm-title {
        font-size: 18px;
        font-weight: 600;
        color: #1f2937;
        margin: 0;
    }
    
    .confirm-message {
        color: #6b7280;
        font-size: 14px;
        line-height: 1.5;
        margin-bottom: 24px;
    }
    
    .confirm-buttons {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }
    
    .confirm-btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
    }
    
    .confirm-btn-cancel {
        background: #f3f4f6;
        color: #6b7280;
    }
    
    .confirm-btn-cancel:hover {
        background: #e5e7eb;
    }
    
    .confirm-btn-confirm {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
    }
    
    .confirm-btn-confirm:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    }
    
    .confirm-btn-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
    }
    
    .confirm-btn-danger:hover {
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    @keyframes scaleIn {
        from {
            transform: scale(0.9);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>

<script>
    // Enhanced Toast System
    window.toast = {
        container: null,
        
        init() {
            if (!this.container) {
                this.container = document.createElement('div');
                this.container.id = 'toast-container';
                this.container.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999;';
                document.body.appendChild(this.container);
            }
        },
        
        show(message, type = 'info', duration = 3000) {
            this.init();
            
            const icons = {
                success: '✓',
                error: '✕',
                warning: '⚠',
                info: 'ℹ'
            };
            
            const toast = document.createElement('div');
            toast.className = `custom-toast ${type}`;
            toast.innerHTML = `
                <div class="toast-icon">${icons[type]}</div>
                <div class="toast-content">${message}</div>
                <button class="toast-close" onclick="this.parentElement.remove()">×</button>
            `;
            
            this.container.appendChild(toast);
            
            // Auto remove after duration
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.style.animation = 'fadeOut 0.3s ease-in';
                    setTimeout(() => toast.remove(), 300);
                }
            }, duration);
            
            return toast;
        },
        
        success(message, duration = 3000) {
            return this.show(message, 'success', duration);
        },
        
        error(message, duration = 4000) {
            return this.show(message, 'error', duration);
        },
        
        warning(message, duration = 3500) {
            return this.show(message, 'warning', duration);
        },
        
        info(message, duration = 3000) {
            return this.show(message, 'info', duration);
        }
    };
    
    // Custom Confirm Dialog
    window.confirmDialog = function(options) {
        return new Promise((resolve) => {
            const {
                title = 'Konfirmasi',
                message = 'Apakah Anda yakin?',
                confirmText = 'Ya',
                cancelText = 'Batal',
                type = 'warning', // warning, danger
                confirmClass = 'confirm-btn-confirm'
            } = options;
            
            const icon = type === 'danger' ? '⚠️' : 'ℹ️';
            
            const overlay = document.createElement('div');
            overlay.className = 'confirm-overlay';
            overlay.innerHTML = `
                <div class="confirm-modal">
                    <div class="confirm-header">
                        <div class="confirm-icon ${type}">${icon}</div>
                        <h3 class="confirm-title">${title}</h3>
                    </div>
                    <p class="confirm-message">${message}</p>
                    <div class="confirm-buttons">
                        <button class="confirm-btn confirm-btn-cancel" data-action="cancel">${cancelText}</button>
                        <button class="confirm-btn ${confirmClass}" data-action="confirm">${confirmText}</button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(overlay);
            
            // Handle button clicks
            overlay.addEventListener('click', (e) => {
                if (e.target.dataset.action === 'confirm') {
                    overlay.style.animation = 'fadeOut 0.2s ease-in';
                    setTimeout(() => {
                        overlay.remove();
                        resolve(true);
                    }, 200);
                } else if (e.target.dataset.action === 'cancel' || e.target === overlay) {
                    overlay.style.animation = 'fadeOut 0.2s ease-in';
                    setTimeout(() => {
                        overlay.remove();
                        resolve(false);
                    }, 200);
                }
            });
            
            // Focus on confirm button
            setTimeout(() => {
                overlay.querySelector('[data-action="confirm"]').focus();
            }, 100);
        });
    };
    
    // Development toast function
    function showDevelopmentToast(featureName) {
        const message = `🚧 ${featureName} sedang dalam tahap pengembangan dan akan segera tersedia!`;
        window.toast.info(message, 4000);
    }
</script>
