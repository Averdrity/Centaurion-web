const mix = require('laravel-mix');

mix.js('src/js/app.js', 'public/js')
   .postCss('src/assets/css/app.css', 'public/css', [
     require('tailwindcss'),
   ])
   .copy('src/assets/images', 'public/images')
   .copy('src/assets/icons', 'public/icons')
   .copy('node_modules/@tabler/icons/icons', 'public/icons/tabler'); 