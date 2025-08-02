import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    safelist: [
        'text-emerald-500',
        'text-red-500',
        'text-yellow-500',
        'text-sky-500',

        'bg-emerald-50',
        'border-emerald-200',
        'bg-red-50',
        'border-red-200',
        'bg-yellow-50',
        'border-yellow-200',
        'bg-sky-50',
        'border-sky-200',

        'border',
        'rounded-xl',
        'p-4',
        'shadow-lg',
        'max-w-sm',

        'flex',
        'items-start',
        'space-x-3',
        'flex-1',
        'text-sm',
        'font-medium',
        'text-slate-800',
        'text-slate-400',
        'hover:text-slate-600',

        'mt-3',
        'h-1',
        'bg-slate-200',
        'rounded-full',
        'overflow-hidden',
        'h-full',
        'bg-gradient-to-r',
        'from-sky-500',
        'to-blue-500',
        'animate-toast-progress',
    ],

    plugins: [forms],
};
