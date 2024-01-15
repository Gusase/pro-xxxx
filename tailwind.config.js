/** @type {import('tailwindcss').Config} */
export default {
	content: [
		"./resources/**/*.blade.php",
		"./resources/**/*.js",
		"./resources/**/*.vue",
	],
	theme: {
		extend: {
			fontFamily: {
				mona: "Mona Sans, ui-serif",
				poppins: "Poppins, ui-serif",
			},
		},
	},
	plugins: [],
};
