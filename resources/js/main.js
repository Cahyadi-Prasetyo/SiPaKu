/**
 * SIPAKU Main JavaScript
 * Handles global functionality and component initialization
 */

// Global SIPAKU object
window.SIPAKU = window.SIPAKU || {
    version: '1.0.0',
    debug: true
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 SIPAKU v' + window.SIPAKU.version + ' loaded');
    
    // Initialize components
    initializeComponents();
    
    // Initialize global event listeners
    initializeGlobalEvents();
});

/**
 * Initialize all components
 */
function initializeComponents() {
    // Initialize DataTables if present
    initializeDataTables();
    
    // Initialize modals if present
    initializeModals();
    
    // Initialize dropdowns
    initializeDropdowns();
    
    // Initialize tooltips
    initializeTooltips();
}

/**
 * Initialize DataTables
 */
function initializeDataTables() {
    // Custom DataTable initialization will go here
    if (window.SIPAKU.debug) {
        console.log('📊 DataTables initialized');
    }
}

/**
 * Initialize Modals
 */
function initializeModals() {
    // Modal functionality will go here
    if (window.SIPAKU.debug) {
        console.log('🪟 Modals initialized');
    }
}

/**
 * Initialize Dropdowns
 */
function initializeDropdowns() {
    // Dropdown functionality
    const dropdowns = document.querySelectorAll('[data-dropdown]');
    dropdowns.forEach(dropdown => {
        // Dropdown logic here
    });
    
    if (window.SIPAKU.debug && dropdowns.length > 0) {
        console.log('📋 Dropdowns initialized:', dropdowns.length);
    }
}

/**
 * Initialize Tooltips
 */
function initializeTooltips() {
    // Tooltip functionality
    const tooltips = document.querySelectorAll('[data-tooltip]');
    
    if (window.SIPAKU.debug && tooltips.length > 0) {
        console.log('💬 Tooltips initialized:', tooltips.length);
    }
}

/**
 * Initialize global event listeners
 */
function initializeGlobalEvents() {
    // Global click handler for dynamic elements
    document.addEventListener('click', function(e) {
        // Handle dynamic button clicks
        if (e.target.matches('[data-action]')) {
            handleActionClick(e);
        }
    });
    
    // Global form submission handler
    document.addEventListener('submit', function(e) {
        if (e.target.matches('[data-ajax-form]')) {
            handleAjaxForm(e);
        }
    });
    
    if (window.SIPAKU.debug) {
        console.log('🎯 Global events initialized');
    }
}

/**
 * Handle action button clicks
 */
function handleActionClick(e) {
    const action = e.target.getAttribute('data-action');
    const target = e.target.getAttribute('data-target');
    
    switch(action) {
        case 'delete':
            handleDeleteAction(e.target, target);
            break;
        case 'edit':
            handleEditAction(e.target, target);
            break;
        case 'view':
            handleViewAction(e.target, target);
            break;
        default:
            console.warn('Unknown action:', action);
    }
}

/**
 * Handle delete action
 */
function handleDeleteAction(element, target) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        // Delete logic here
        console.log('Delete action for:', target);
    }
}

/**
 * Handle edit action
 */
function handleEditAction(element, target) {
    // Edit logic here
    console.log('Edit action for:', target);
}

/**
 * Handle view action
 */
function handleViewAction(element, target) {
    // View logic here
    console.log('View action for:', target);
}

/**
 * Handle AJAX form submission
 */
function handleAjaxForm(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    const url = form.getAttribute('action') || window.location.href;
    const method = form.getAttribute('method') || 'POST';
    
    // AJAX submission logic here
    console.log('AJAX form submission:', url, method);
}

/**
 * Utility function to show notifications
 */
window.SIPAKU.showNotification = function(message, type = 'info', duration = 5000) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    // Add to page
    document.body.appendChild(notification);
    
    // Auto remove
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, duration);
    
    console.log(`📢 Notification (${type}):`, message);
};

/**
 * Utility function for AJAX requests
 */
window.SIPAKU.ajax = function(url, options = {}) {
    const defaults = {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        }
    };
    
    const config = Object.assign(defaults, options);
    
    return fetch(url, config)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .catch(error => {
            console.error('AJAX Error:', error);
            window.SIPAKU.showNotification('Terjadi kesalahan pada server', 'error');
            throw error;
        });
};

// Export for module usage if needed
if (typeof module !== 'undefined' && module.exports) {
    module.exports = window.SIPAKU;
}