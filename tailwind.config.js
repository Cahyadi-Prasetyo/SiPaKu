/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/**/*.php",
    "./resources/**/*.js",
    "./public/**/*.html"
  ],
  theme: {
    extend: {
      zIndex: {
        '9999': '9999',
        '99999': '99999'
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}