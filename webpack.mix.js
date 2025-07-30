const mix = require('laravel-mix');
const path = require('path');

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
// Mix v6



mix 
    .babelConfig({
        plugins: ['@babel/plugin-syntax-dynamic-import'],
    })
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    //.css('resources/css/app.css', 'public/css')
    .js('node_modules/popper.js/dist/popper.js', 'public/js').sourceMaps()
    .vue()   
    .copy('node_modules/material-icons/css/material-icons.min.css', 'public/css/material-icons.min.css')
    .extract()
    .alias({
         '@': path.resolve('resources/js'),
        //ziggy: path.resolve('vendor/tightenco/ziggy/dist/vue')
     });

