import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                lora : ["Lora"],
                Inter: ['Inter', 'sans-serif'],
                roboto : ["Roboto"]
            },
            colors: {
                red1:'#C95C66',
                merah2:'#B03440',
                gray:'#505050',
                gray2:'#868686'
                
            }
        },
    },
    plugins: [],
};
