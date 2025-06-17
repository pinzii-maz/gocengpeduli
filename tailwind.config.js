import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                PlayfairDisplay: [
                    "Playfair Display",
                    ...defaultTheme.fontFamily.serif,
                    ,
                ],
            },

            colors: {
                primary: "#FBFBFB",
                secondary: "#E8F9FF",
                tertiary: "#C4D9FF",
                quaternary: "#C5BAFF",
                quinary: "#3674B5",
                senary: "#3674B5",
            },

            backgroundOpacity: {
                90: "0.9",
                95: "0.95",
            },

            transitionProperty: {
                all: "all",
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
