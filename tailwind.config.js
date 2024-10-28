/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
  "./src/**/*.{html,js,php}",
  "./src/**/**/**/*.{html,js,php}",
  "./*.html",
  "./pages/**/*.{html,js,php}",
  "./components/**/*.{html,js,php}",
  "./public/*.{html,js,php}"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('daisyui'), 
  ],
}

