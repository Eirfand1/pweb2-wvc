/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/**/*.{php,html,js}",  // Tambah semua file di app
    "./app/Views/**/*.{php,html,js,vue}",
    "./public/**/*.{php,html,js}",
    "./config/**/*.php",  // Tambah config jika ada template di sana
    "*.{php,html,js}",  // Tambah root files
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('daisyui'),
  ],
  daisyui: {
    base: true, 
    styled: true, 
    utils: true,
    themes: ['light','dark','garden']
  },
}

