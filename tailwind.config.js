import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'selector',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'bg-primary': '#ffffff',
                'bg-secondary': '#f3f4f6',
                'bg-dark-primary': '#000000',
                'bg-dark-secondary': '#111827',
                'primary': '#111827',
                'secondary': '#6b7280',
                'hover': '#374151',
                'dark-primary': '#f3f4f6',
                'dark-secondary': '#6b7280',
                'dark-hover': '#d1d5db'
            }
        },
    },

    plugins: [forms],
};
