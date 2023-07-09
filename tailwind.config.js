/** @type {import('tailwindcss').Config} */

const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

module.exports = {
    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'), require('@tailwindcss/aspect-ratio')],
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './vendor/rappasoft/laravel-livewire-tables/resources/views/tailwind/**/*.blade.php',
    ],
    darkMode: 'class', // or 'media' or false
    theme: {
        extend: {},
    },
    variants: {
        extend: {
            backgroundColor: ['responsive', 'dark', 'checked', 'disabled', 'hover', 'focus', 'active', 'even', 'odd'],
            opacity: ['dark'],
            overflow: ['hover'],
        },
    },

}

