/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            borderRadius: {
                '2xl': '20px',
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
            },
            colors: {
                sky:    { DEFAULT: '#0EA5E9' },
                brand: {
                    blue:   '#0EA5E9',
                    purple: '#8B5CF6',
                    amber:  '#F59E0B',
                    green:  '#10B981',
                    red:    '#EF4444',
                    pink:   '#EC4899',
                },
            },
        },
    },
    safelist: [
        // pastikan warna kategori dynamic tidak di-purge
        { pattern: /bg-(sky|purple|amber|green|red|pink)-(100|50)/ },
        { pattern: /text-(sky|purple|amber|green|red|pink)-(600|700|800)/ },
        { pattern: /border-(sky|purple|amber|green|red|pink)-(200|300)/ },
    ],
    plugins: [
        require('@tailwindcss/typography'),
    ],
};
