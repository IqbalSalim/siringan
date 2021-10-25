const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#0EA5E9',
                secondary: '#6366F1',
                warning: '#F59E0B',
                danger: '#EF4444',
                success: '#84CC16',
                info: '#14B8A6',
                default: '#64748B',
            },
            backgroundImage: {
                'hero-pattern': "url('/images/backgrounda.jpg')",
            }
        },
    },

    variants: {
        extend: {
            animation: ['responsive', 'motion-safe', 'motion-reduce']
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
