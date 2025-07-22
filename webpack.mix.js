const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .vue() // ← این خط را اضافه کردیم
   .postCss('resources/css/app.css', 'public/css', [])
   .webpackConfig({
       resolve: {
           alias: {
               'jquery': 'jquery/src/jquery'
           }
       }
   });
