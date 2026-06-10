import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                shop: {
                    orange: '#FF6B35',
                    'orange-dark': '#E85A24',
                    dark: '#1A1F2E',
                    'dark-soft': '#2D3344',
                    muted: '#64748B',
                    surface: '#F8FAFC',
                },
                admin: {
                    sidebar: '#343a40',
                    'sidebar-dark': '#2c3136',
                    primary: '#007bff',
                    success: '#28a745',
                    warning: '#ffc107',
                    danger: '#dc3545',
                    body: '#f4f6f9',
                },
            },
            boxShadow: {
                card: '0 4px 24px -4px rgba(15, 23, 42, 0.08)',
                'card-hover': '0 12px 40px -8px rgba(15, 23, 42, 0.15)',
            },
        },
    },

    plugins: [forms, typography],
};
