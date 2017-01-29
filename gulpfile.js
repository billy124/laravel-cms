const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

var paths = {
    'bower' : './bower_components/',
    'npm' : './node_modules/',
    'assets_js' : './resources/assets/js/'
};

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix
        // app styles
        .sass('app.scss')

        // app scripts
        .scripts([ 
            paths.assets_js + 'vendor/iframe-transport.js',
            paths.assets_js + 'vendor/fileupload.js',
            paths.assets_js + 'vendor/history.js',
            paths.assets_js + 'app'
        ], 'public/js/app.js')

        // app libraries
        .combine([
            paths.bower + 'jquery/dist/jquery.min.js',
            paths.bower + 'jquery-ui/jquery-ui.min.js',
            paths.bower + 'flexslider/jquery.flexslider-min.js',
            paths.bower + 'sly/dist/sly.min.js',
            paths.bower + 'aos/dist/aos.js',
            paths.npm + 'bootstrap-sass/assets/javascripts/bootstrap.min.js'
        ], 'public/js/libs.js');

});
