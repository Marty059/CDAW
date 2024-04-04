const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/game.js', 'public/js')
    .js('resources/js/stats.js', 'public/js')
    .js('resources/js/leaderboard.js', 'public/js') // Add this line to include game.js
    .js('resources/js/admin.js', 'public/js')
    .js('resources/js/lobby.js', 'public/js') 
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps();
