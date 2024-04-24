/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./**/*.php"],
    theme: {
        extend: {
            fontFamily: {
                RolanDisplay: "Rolan Display",
                lora: "lora",
                lato: "lato",
                poppins: "poppins",
            },
        },
    },
    plugins: [],
};
