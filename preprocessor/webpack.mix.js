const mix  = require('laravel-mix');
mix.setPublicPath('../resources/views/admin');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('js/dashboard.js', 'v_1/js/base.js').options({
      processCssUrls: false
   })
   .less('less/v_1/dashboard.less', 'v_1/css/base.css').options({
      processCssUrls: false
   });