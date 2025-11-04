module.exports = {
  // Preline UI configuration
  content: [
    "./app/Views/**/*.php",
    "./resources/**/*.js",
    "./public/**/*.html"
  ],
  
  // Default theme configuration
  theme: {
    extend: {
      colors: {
        // Custom colors for SIPAKU
        primary: {
          50: '#eff6ff',
          100: '#dbeafe', 
          200: '#bfdbfe',
          300: '#93c5fd',
          400: '#60a5fa',
          500: '#3b82f6',
          600: '#2563eb',
          700: '#1d4ed8',
          800: '#1e40af',
          900: '#1e3a8a',
        }
      }
    }
  },
  
  // Plugin configuration
  plugins: {
    // Enable all Preline components
    dropdown: true,
    modal: true,
    tabs: true,
    accordion: true,
    tooltip: true,
    popover: true,
    carousel: true,
    collapse: true,
    overlay: true,
    scrollspy: true,
    select: true,
    stepper: true,
    toggle: true,
    inputNumber: true,
    fileUpload: true,
    datatable: true
  }
};