/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
  purge: [
    './vendor/rappasoft/laravel-livewire-tables/resources/views/tailwind/**/*.blade.php',
  ]
}

