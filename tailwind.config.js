import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
             colors: {
        'tutor': {
          'purple': '#6366f1',
          'blue': '#3b82f6', 
          'orange': '#f59e0b',
          'pink': '#ec4899',
          'coral': '#f97316'
        }
      }
        },
    },

    plugins: [forms],
};
