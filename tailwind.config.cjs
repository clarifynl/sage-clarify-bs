// https://tailwindcss.com/docs/configuration
module.exports = {
  content: [
    "./index.php",
    "./app/**/*.php",
    "./resources/!(icons)/**/*.{php,vue,js}",
    "./node_modules/tw-elements/dist/js/**/*.js"
  ],
  theme: {
    extend: {
      colors: {},
      backgroundImage: {
        'logo': "url('@images/logo-placeholder.svg')"
      }
    }
  },
  plugins: [
    require("tw-elements/dist/plugin")
  ]
};
