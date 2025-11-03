/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                birumuda: "#f59e0b",
                merahmuda: "#ec4899",
                hijautosca: "#10A19D",
                merahorange: "#FF7000",
            },
        },
    },
    plugins: [],
};
