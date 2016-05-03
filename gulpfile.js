var elixir = require('laravel-elixir')

require('laravel-elixir-browser-sync');
require('laravel-elixir-scss-lint');
require('laravel-elixir-header');
require('laravel-elixir-footer');
require('laravel-elixir-ng-html2js');
require('laravel-elixir-jshint');
require('laravel-elixir-phpcs');
require('laravel-elixir-spritesmith');
require('laravel-elixir-imagemin');
require('laravel-elixir-css-url-adjuster');

var paths = {
    'jquery': './vendor/bower_components/jquery/',
    'bootstrap': './vendor/bower_components/bootstrap-sass-official/assets/',
    'font_awesome': './vendor/bower_components/components-font-awesome/',
    'angular': './vendor/bower_components/angular/',
    'moment': './vendor/bower_components/moment/min/',
    'datepicker': './vendor/bower_components/eonasdan-bootstrap-datetimepicker/',
    'src': 'resources/assets',
    'dest': 'public/assets'
};

// gulp --production to minify
// gulp --development to unminify

elixir(function (mix) {
    mix
        // Compile sass and include bootstrap
        .less(paths.src + '/less/app.less', paths.dest + '/css', {
            includePaths: [
                paths.datepicker + 'src/less/bootstrap-datetimepicker-build.less'
            ]
        })

        // Compile bootstrap and jquery scripts
        .scripts([
            paths.jquery + "dist/jquery.js",
            paths.bootstrap + "javascripts/bootstrap.js",
            paths.angular + "angular.js",
            paths.moment + "moment.min.js",
            paths.datepicker + "build/js/bootstrap-datetimepicker.min.js",
        ], paths.dest + '/js/vendor.js', './')

        // Load all scripts in dir
        .scriptsIn(paths.src + '/js', paths.dest + '/js/app.js')

        // Scan scss for errors
        .scssLint()

        // Copy fonts over to public dir
        .copy(paths.bootstrap + 'fonts/bootstrap/**', paths.dest + '/fonts/bootstrap')
        .copy(paths.font_awesome + 'fonts/**', paths.dest + '/fonts')


        // Move images over
        .copy(paths.src + '/img', paths.dest + '/img')


        // Version all of the files
        .version([
            //paths.dest + '/css/app.css',
            paths.dest + '/js/vendor.js',
            paths.dest + '/js/app.js'
            //paths.dest + '/css/sprite.css'
        ]);
});