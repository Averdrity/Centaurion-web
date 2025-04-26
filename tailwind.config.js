/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{html,js,php}",
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: '#3B82F6',
        secondary: '#1E40AF',
        light: {
          bg: '#F3F4F6',      // Light gray background
          card: '#FFFFFF',     // White card background
          text: '#1F2937',    // Dark gray text
          muted: '#6B7280',   // Muted text
          border: '#E5E7EB',  // Light border
        },
        dark: {
          bg: '#111827',      // Current dark background
          card: '#1F2937',    // Current card background
          text: '#F3F4F6',    // Current light text
          muted: '#9CA3AF',   // Current muted text
          border: '#374151',  // Current border
        }
      },
    },
  },
  plugins: [],
} 