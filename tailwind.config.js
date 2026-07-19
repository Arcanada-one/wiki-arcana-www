/** @type {import('tailwindcss').Config} */
// Design canon shared with the Arcanada landing (arcanada.ai): void/violet/gold/mint
// palette, Cinzel/DM Sans/JetBrains Mono type ramp, and the float/glow/fade-up
// animation set. Kept in sync by hand so arcanada.wiki reads as one family with
// the rest of the ecosystem sites.
module.exports = {
  darkMode: 'class',
  content: [
    './index.php',
    './pages/**/*.php',
    './templates/**/*.php',
    './content/**/*.php',
  ],
  theme: {
    extend: {
      fontFamily: {
        display: ['Cinzel', 'serif'],
        body: ['DM Sans', 'sans-serif'],
        mono: ['JetBrains Mono', 'monospace'],
      },
      colors: {
        void: {
          50: '#f5f4f7',
          100: '#eeedf2',
          200: '#d8d6de',
          300: '#c2bfcc',
          400: '#8b79b8',
          500: '#6b549e',
          600: '#574284',
          700: '#47356c',
          800: '#1a1528',
          900: '#0c0c1d',
          950: '#06060e',
        },
        violet: {
          50: '#f3eeff',
          100: '#e9deff',
          200: '#d5bfff',
          300: '#b794f6',
          400: '#9f6ef7',
          500: '#8b4cf0',
          600: '#7c3aed',
          700: '#6d28d9',
          800: '#5b21b6',
          900: '#4c1d95',
        },
        gold: {
          50: '#fdf9ed',
          100: '#faf0cc',
          200: '#f4de94',
          300: '#edc85c',
          400: '#e8b730',
          500: '#d4a030',
          600: '#b8860b',
          700: '#946a08',
          800: '#7a560c',
          900: '#644610',
        },
        mint: {
          50: '#ecfdf8',
          100: '#d1fae9',
          200: '#a7f3d5',
          300: '#6ee7b7',
          400: '#34d399',
          500: '#10b981',
          600: '#059669',
          700: '#047857',
          800: '#065f46',
          900: '#064e3b',
        },
      },
      animation: {
        float: 'float 6s ease-in-out infinite',
        'float-delayed': 'float 6s ease-in-out 2s infinite',
        'glow-pulse': 'glowPulse 4s ease-in-out infinite',
        'fade-up': 'fadeUp 0.8s ease-out forwards',
        'fade-up-1': 'fadeUp 0.8s ease-out 0.1s forwards',
        'fade-up-2': 'fadeUp 0.8s ease-out 0.2s forwards',
        'fade-up-3': 'fadeUp 0.8s ease-out 0.3s forwards',
        'fade-up-4': 'fadeUp 0.8s ease-out 0.4s forwards',
        'rotate-slow': 'rotateSlow 120s linear infinite',
      },
      keyframes: {
        float: {
          '0%, 100%': { transform: 'translateY(0px)' },
          '50%': { transform: 'translateY(-12px)' },
        },
        glowPulse: {
          '0%, 100%': { opacity: '0.4' },
          '50%': { opacity: '0.8' },
        },
        fadeUp: {
          '0%': { opacity: '0', transform: 'translateY(30px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        rotateSlow: {
          '0%': { transform: 'rotate(0deg)' },
          '100%': { transform: 'rotate(360deg)' },
        },
      },
    },
  },
  plugins: [],
};
