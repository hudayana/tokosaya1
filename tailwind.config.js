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
                cream: '#FDFBF7',
                espresso: '#3E2723',
                terracotta: {
                    50: '#FBF0E9',
                    100: '#F7E0D2',
                    200: '#F0C2A8',
                    300: '#E8A17B',
                    400: '#DE8051',
                    500: '#D96A2D',
                    600: '#D35400',
                    700: '#B74900',
                    800: '#963C00',
                    900: '#763100',
                    950: '#4C2100',
                },
                blue: {
                    50: '#FBF0E9',
                    100: '#F7E0D2',
                    200: '#F0C2A8',
                    300: '#E8A17B',
                    400: '#DE8051',
                    500: '#D96A2D',
                    600: '#D35400',
                    700: '#B74900',
                    800: '#963C00',
                    900: '#763100',
                    950: '#4C2100',
                },
                indigo: {
                    50: '#FBF0E9',
                    100: '#F7E0D2',
                    200: '#F0C2A8',
                    300: '#E8A17B',
                    400: '#DE8051',
                    500: '#D96A2D',
                    600: '#D35400',
                    700: '#B74900',
                    800: '#963C00',
                    900: '#763100',
                    950: '#4C2100',
                },
                gray: {
                    50: '#FAF7F1',
                    100: '#F2ECE3',
                    200: '#E7DDD2',
                    300: '#D6C8BB',
                    400: '#B6A394',
                    500: '#8D776A',
                    600: '#70594D',
                    700: '#563D32',
                    800: '#3E2723',
                    900: '#321E1A',
                    950: '#24130F',
                },
                slate: {
                    50: '#FAF7F1',
                    100: '#F2ECE3',
                    200: '#E7DDD2',
                    300: '#D6C8BB',
                    400: '#B6A394',
                    500: '#8D776A',
                    600: '#70594D',
                    700: '#563D32',
                    800: '#3E2723',
                    900: '#321E1A',
                    950: '#24130F',
                },
            },
        },
    },

    plugins: [forms],
};
