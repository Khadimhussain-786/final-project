const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [])
   .webpackConfig({
       resolve: {
           alias: {
               'jquery': 'jquery/src/jquery'
           }
       }
   });
