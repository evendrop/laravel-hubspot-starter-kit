/** @type {import('tailwindcss').Config} */
module.exports = {
  mode: "jit",
  purge: ["./resources/**/*.blade.php", "./resources/**/*.vue"],
  theme: {
    screens: {
      sm: '480px',
      md: '768px',
      lg: '976px',
      xl: '1440px',
    }
  },
  variants: {},
  plugins: [
    {divideStyle: true}
  ],
}