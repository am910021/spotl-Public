const mix = require('laravel-mix');
const MomentLocalesPlugin = require('moment-locales-webpack-plugin');

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

mix.js('resources/js/app.js', 'public/static/js')
    .sass('resources/sass/app.scss', 'public/static/css');

mix.styles([
    'public/assets/css/test.css',
], 'public/static/css/all.css');

// module.exports = {
//     plugins: [
//         // To strip all locales except “en”
//         new MomentLocalesPlugin(),
//
//         // Or: To strip all locales except “en”, “es-us” and “ru”
//         // (“en” is built into Moment and can’t be removed)
//         new MomentLocalesPlugin({
//             localesToKeep: ['es-us', 'ru'],
//          }),
//     ],
// };

mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/css', 'public/static/fontawesome/css');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/js', 'public/static/fontawesome/js');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/sprites', 'public/static/fontawesome/static/sprites');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/svgs', 'public/static/fontawesome/svgs');
mix.copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/static/fontawesome//webfonts');

mix.copyDirectory('node_modules/bootstrap/dist/css', 'public/static/bootstrap/css');
mix.copyDirectory('node_modules/bootstrap/dist/js', 'public/static/bootstrap/js');

mix.copyDirectory('node_modules/tempusdominus-bootstrap-4/build/js', 'public/static/tempusdominus/js');
mix.copyDirectory('node_modules/tempusdominus-bootstrap-4/build/css', 'public/static/tempusdominus/css');


mix.copy('node_modules/popper.js/dist/umd/popper.js', 'public/static/popper/');
mix.copy('node_modules/popper.js/dist/umd/popper-utils.js', 'public/static/popper/');

mix.copy('node_modules/jquery/dist/jquery.js', 'public/static/js/');

mix.copy('node_modules/moment/min/locales.min.js', 'public/static/moment/');
mix.copy('node_modules/moment/min/moment.min.js', 'public/static/moment/');
mix.copy('node_modules/moment/min/moment-with-locales.min.js', 'public/static/moment/');
mix.copyDirectory('node_modules/moment/locale', 'public/static/moment/locale/');
