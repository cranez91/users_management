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
mix.js([
		'resources/assets/js/app.js',
	   ], 'public/js/app.js')
	.styles([
		'resources/assets/css/myCSS.css',
		'resources/assets/css/sweetalert2.min.css'
	], 'public/css/app.css')
   .browserSync({
    	proxy: 'localhost:8000'
	});
