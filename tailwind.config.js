/** @type {import('tailwindcss').Config} */
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.php", "./assets/**/*.js"],
  theme: {
    extend: {
      colors: {
        /* --------------------
         * BRAND COLORS (match mockup vibe)
         * -------------------- */
        brand: {
          blue: {
            50: "#EFF6FF",
            100: "#DBEAFE",
            200: "#BFDBFE",
            300: "#93C5FD",
            400: "#60A5FA",     // soft blue
            500: "#3B82F6",     // DEFAULT blue
            600: "#2563EB",     // darker blue
            700: "#1D4ED8",
            800: "#1E40AF",
            900: "#1E3A8A",     // dark blue for backgrounds
            DEFAULT: "#3B82F6",
          },
          orange: {
            50: "#FFF7ED",
            100: "#FFEDD5",
            200: "#FED7AA",
            300: "#FDBA74",
            400: "#FB923C",     // soft orange
            500: "#F97316",     // DEFAULT orange
            600: "#EA580C",     // vivid orange
            700: "#C2410C",     // dark orange
            800: "#9A3412",
            900: "#7C2D12",
            DEFAULT: "#F97316",
          },
        },
        /* --------------------
         * SURFACES (slate stack with custom values)
         * -------------------- */
        surface: {
          950: "#020617",  // slate-950 (deepest black)
          900: "#0F172A",  // slate-900 (main dark)
          850: "#141B2E",  // custom dark blue-slate
          800: "#1E293B",  // slate-800 (cards)
          750: "#283548",  // custom mid-slate
          700: "#334155",  // slate-700
          600: "#475569",  // slate-600
          500: "#64748B",  // slate-500
        },
        border: {
          DEFAULT: "#334155",  // slate-700 for borders
        },
        /* --------------------
         * TEXT (slate-based with semantic names)
         * -------------------- */
        text: {
          primary: "#F8FAFC",   // slate-50 (brightest)
          secondary: "#E2E8F0", // slate-200
          tertiary: "#CBD5E1",  // slate-300
          muted: "#94A3B8",     // slate-400
          faint: "#64748B",     // slate-500
          disabled: "#475569",  // slate-600
          // Additional semantic names used in templates
          strong: "#F8FAFC",    // slate-50 (brightest, for headings)
          base: "#E2E8F0",      // slate-200 (base text)
        },
      },
      /* --------------------
       * BACKGROUND GRADIENTS
       * -------------------- */
      backgroundImage: {
        'gradient-main': 'linear-gradient(135deg, #0F172A 0%, #1E3A8A 50%, #0F172A 100%)',
        'gradient-card': 'linear-gradient(180deg, #1E293B 0%, #0F172A 100%)',
        'gradient-blue': 'linear-gradient(135deg, #3B82F6 0%, #2563EB 100%)',
        'gradient-orange': 'linear-gradient(135deg, #F97316 0%, #EA580C 100%)',
        'gradient-blue-orange': 'linear-gradient(135deg, #3B82F6 0%, #F97316 100%)',
      },
      /* --------------------
       * BOX SHADOWS
       * -------------------- */
      boxShadow: {
        'glow-blue': '0 0 20px rgba(59, 130, 246, 0.4)',
        'glow-blue-lg': '0 0 40px rgba(59, 130, 246, 0.5)',
        'glow-orange': '0 0 20px rgba(249, 115, 22, 0.4)',
        'glow-orange-lg': '0 0 40px rgba(249, 115, 22, 0.5)',
        'card': '0 20px 60px rgba(0, 0, 0, 0.5)',
        'card-hover': '0 25px 70px rgba(0, 0, 0, 0.6)',
      },
      /* --------------------
       * BACKDROP BLUR
       * -------------------- */
      backdropBlur: {
        xs: '2px',
      },
      /* --------------------
       * SPACING (for consistent gaps)
       * -------------------- */
      spacing: {
        '18': '4.5rem',
        '88': '22rem',
        '100': '25rem',
        '112': '28rem',
        '128': '32rem',
      },
      /* --------------------
       * BORDER RADIUS (rounded variations)
       * -------------------- */
      borderRadius: {
        '4xl': '2rem',
        '5xl': '2.5rem',
      },
      /* --------------------
       * ANIMATION & TRANSITIONS
       * -------------------- */
      transitionDuration: {
        '400': '400ms',
        '600': '600ms',
      },
      /* --------------------
       * Z-INDEX (organized layers)
       * -------------------- */
      zIndex: {
        'content': '10',
        'header': '20',
        'menu': '30',
        'modal': '40',
        'tooltip': '50',
      },
      /* --------------------
       * LETTER SPACING
       * -------------------- */
      letterSpacing: {
        'ultra-wide': '0.3em',
        'extra-wide': '0.2em',
      },
    },
  },
  plugins: [],
  /* --------------------
   * SAFELIST (if using dynamic classes)
   * -------------------- */
  safelist: [
    'text-brand-orange',
    'text-brand-blue',
    'bg-gradient-blue',
    'bg-gradient-orange',
  ],
};