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
	.js('resources/js/admin.js', 'public/js')
	.autoload({
		jquery:['$','jquery','jQuery','window.jQuery'],
		'popper.js/dist/umd/popper.js':['Popper']
		// 'bootstrap/dist/js/bootstrap.js':['bootstrap']
	})
	.extract(['metismenu','jquery-slimscroll'])
	.copyDirectory('resources/template/admin/assets/img', 'public/assets/img')
	.sass('resources/sass/app.scss', 'public/css')
   	.sass('resources/sass/admin.scss', 'public/css');