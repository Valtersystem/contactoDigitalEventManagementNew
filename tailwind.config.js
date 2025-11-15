import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'background': 'rgb(var(--color-background) / <alpha-value>)',
                'surface': 'rgb(var(--color-surface) / <alpha-value>)',
                'primary': 'rgb(var(--color-primary) / <alpha-value>)',
                'secondary': 'rgb(var(--color-secondary) / <alpha-value>)',
                'text-primary': 'rgb(var(--color-text-primary) / <alpha-value>)',
                'text-secondary': 'rgb(var(--color-text-secondary) / <alpha-value>)',
                'action': 'rgb(var(--color-action) / <alpha-value>)',
            },
        },
    },

    plugins: [forms],
};
