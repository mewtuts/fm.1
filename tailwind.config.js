/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      screens : {
        'fl-2xl': {'max': '1535px'},
      // => @media (max-width: 1535px) { ... }

        'fl-xl': {'max': '1279px'},
        // => @media (max-width: 1279px) { ... }

        'fl-lg': {'max': '1023px'},
        // => @media (max-width: 1023px) { ... }

        'fl-md': {'max': '767px'},
        // => @media (max-width: 767px) { ... }

        'fl-sm': {'max': '639px'},
        // => @media (max-width: 639px) { ... }
        'fl-xsm': {'max': '400px'},
        // => @media (max-width: 639px) { ... }
      },
      fontFamily : {
        'poppins' : ['poppins'],
      },
      width : {
        'register-box' : '32rem',
      },
      height : {
        'caption-box' : '45.5rem',
        'flf' : '35rem',
        'home-height' : '39rem',
      }
    },
  },
  plugins: [],
}
