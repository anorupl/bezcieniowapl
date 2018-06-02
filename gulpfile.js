// Defining requirements
var gulp       = require('gulp'),
	del        = require('del'),
	gulpIgnore = require('gulp-ignore'),
	merge      = require('merge-stream'),
	sequence   = require('run-sequence'),
	changed    = require('gulp-changed'),
	concat     = require('gulp-concat'),
	uglify     = require('gulp-uglify'),
	rename     = require('gulp-rename'),
	sort       = require('gulp-sort');

//Image
var imagemin   = require('gulp-imagemin'),
	svgmin     = require('gulp-svgmin');

// css
var sass       = require('gulp-sass'),
	compass    = require('compass-importer'),
	prefixer   = require('gulp-autoprefixer'),
	header     = require('gulp-header');

//WordPress
var wpPot      = require('gulp-wp-pot');

/*
 * ftp

var	ftp        = require('vinyl-ftp'),
	ftp_config = require('./ftp.json'),
	gutil      = require('gulp-util');

*/

//////////////////////////////////////////////////////////////////////////////////
// Base config
//////////////////////////////////////////////////////////////////////////////////
var project     = 'wpg-bezcieniowapl', // The directory name for your theme
	node        = 'node_modules/',
	src         = './src/',
	dist        = './dist/',
	project_dir = dist + project + '/';

// Config assets_js
var html5shiv      = node + 'html5shiv/dist/*.min.js',
	slider         = node + 'slick-carousel/slick/slick.min.js',
	imgPopup       = node + 'magnific-popup/dist/jquery.magnific-popup.min.js';
	minf_gallery   = [imgPopup],
	dist_assets_js = 'js/assets/';

//Config theme
var theme = {
	css: {
		src:      src + 'assets/sass/',
		src_css:  src + '/css/',
		dist:     project_dir,
		dist_css: project_dir + '/css/'
	},
	image: {
		img_screen: src + '/*.{jpg,jpeg,png,gif}',
		dis_screen: project_dir,

		src:        src + 'assets/img/',
		dist:       project_dir + '/img/',

		svg_src:    src + 'assets/img/svg/',
		svg_dist:   project_dir + '/img/svg/',

		imgType:    '*.{jpg,jpeg,png,gif}'
	},
	js: {
		src:  src + 'assets/js/',
		dist: project_dir + '/js/'
	},
	php: {
		src:  src + '**/*.php',
		dist: project_dir
	},
	customizer_assets: {
		src:  src + 'inc/customizer/assets/**/*{.js,.css,.json}',
		dist: project_dir + '/inc/customizer/assets/'
	},
	fonts: {
		src:  src + 'fonts/**/*.{ttf,woff,eot,svg}',
		dist: project_dir + '/fonts/'
	},
	lang: {
		src:  src + 'languages/**/*',
		dist: project_dir + 'languages/'
	}
};


//////////////////////////////////////////////////////////////////////////////////
// Task
//////////////////////////////////////////////////////////////////////////////////

//Copy PHP source files to the `build` folder
gulp.task('theme-php', function() {
	return gulp.src(theme.php.src)
		.pipe(changed(theme.php.dist))
		.pipe(gulp.dest(theme.php.dist));
});


//Copy customizer assets and fonts
gulp.task('copy-assets', function() {
	//Customizer assets
	gulp.src(theme.customizer_assets.src)
		.pipe(changed(theme.customizer_assets.dist))
		.pipe(gulp.dest(theme.customizer_assets.dist));
	//Copy all custom fonts
	gulp.src(theme.fonts.src)
		.pipe(changed(theme.fonts.dist))
		.pipe(gulp.dest(theme.fonts.dist));
});


//Generate script
gulp.task('theme-js', function() {
	//Copy Js assets: silder, html5shiv
	gulp.src([slider, html5shiv])
		.pipe(changed(project_dir + dist_assets_js))
		.pipe(gulp.dest(project_dir + dist_assets_js));
	//Copy Js for gallery and images
	gulp.src(minf_gallery)
		.pipe(changed(project_dir + dist_assets_js))
		.pipe(concat('imgGallery.js'))
		.pipe(uglify())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest(project_dir + dist_assets_js));
	//Copy js file
	gulp.src(theme.js.src + '**/*.min.js')
		.pipe(changed(theme.js.dist))
		.pipe(gulp.dest(theme.js.dist));
	//Copy and minify js
	gulp.src(['!' + theme.js.src + '**/*.min.js', theme.js.src + '**/*.js'])
		.pipe(changed(theme.js.dist))
		.pipe(uglify()).pipe(rename({suffix: '.min'	}))
		.pipe(gulp.dest(theme.js.dist));
});


//Build style sheets
gulp.task('sass', function() {
	//Base theme style sass
	var style = gulp.src(theme.css.src + 'style.scss')
		.pipe(changed(theme.css.dist))
		//Default:nestedValues:nested,expanded,compact,compressed
		.pipe(sass({outputStyle: 'compressed' }).on('error', sass.logError))
		.pipe(prefixer({
			browsers: ['> 1%', 'last 4 versions', 'Firefox ESR']
		}))
		.pipe(gulp.dest(theme.css.dist));
	//copy css
	var css = gulp.src(theme.css.src_css + '*.css').pipe(changed(theme.css.dist_css))
		.pipe(sass().on('error', function(error) {
			console.log(error);
			this.emit('end');
		}))
		.pipe(gulp.dest(theme.css.dist_css));

	var ie = gulp.src(theme.css.src + 'ie8.scss').pipe(changed(theme.css.dist_css))
		.pipe(sass().on('error', function(error) {
			console.log(error);
			this.emit('end');
		}))
		.pipe(gulp.dest(theme.css.dist_css));

	return merge(style, css, ie);
});


//Add header tag to base stylesheets
gulp.task('css', ['sass'], function() {
	return gulp.src(project_dir + 'style.css')
	.pipe(header(
'/*\n\
Theme Name:Bezcieniowa.pl\n\
Theme URI:http://code.zerebny.ovh\n\
Author:anorupl\n\
Author URI:\n\
Description:WPG will make your WordPress look beautiful everywhere :)\n\
Version:1.0.1\n\
Licence: GPL-2.0\n\
Licence URI:http://www.gnu.org/licenses/gpl-2.0.html\n\
Tags:one-column,responsive-layout,custom-menu,featured-images,microformats,threaded-comments,translation-ready\n\
Text Domain:wpg_theme\n\
*/\n'))
	.pipe(gulp.dest(project_dir));
});


//Copy images
gulp.task('images', function() {
	var imagesFile = gulp.src(theme.image.src + '**/' + theme.image.imgType)
		.pipe(changed(theme.image.dist))
		.pipe(imagemin())
		.pipe(gulp.dest(theme.image.dist));
	var svgFile = gulp.src(theme.image.svg_src + '**/*.svg')
		.pipe(changed(theme.image.svg_dist))
		.pipe(svgmin())
		.pipe(gulp.dest(theme.image.svg_dist));
	var screenFile = gulp.src(theme.image.img_screen)
		.pipe(imagemin())
		.pipe(gulp.dest(theme.image.dis_screen));
	return merge(imagesFile, svgFile, screenFile);
});


//Copy everything under`src/languages`indiscriminately
gulp.task('theme-lang', function() {
	return gulp.src(theme.lang.dist).pipe(gulp.dest(theme.lang.dist));
});


//Generate pot-files for WordPress localization
gulp.task('language', function() {
	var langpot = gulp.src(theme.php.src)
		.pipe(sort()).pipe(wpPot({
			domain: 'wpg_theme',
			destFile: 'wpg-theme.pot',
			package: 'wpg theme',
			bugReport: 'http://wordpress.org/themes'
		}))
		.pipe(gulp.dest(theme.lang.dist));
	var langpo = gulp.src(theme.lang.src)
		.pipe(gulp.dest(theme.lang.dist));
	return merge(langpot, langpo);
});

//////////////////////Build////////////////////////////////////////////////
//Remove distributon folder
gulp.task('clean', function() {
	return del(dist);
});
gulp.task('build', ['clean'], function() {
	sequence('theme-php', 'copy-assets', 'theme-lang', 'theme-js', 'css', 'images', 'language');
});

//////////////////////Watch////////////////////////////////////////////////
gulp.task('watch-all', function() {
	//1.Copy PHP source files to the `build`folder
	gulp.watch(theme.php.src, ['theme-php']);
	//2.Copy customizer assets and fonts
	gulp.watch(theme.customizer_assets.src, ['copy-assets']);
	//3.Copy customizer assets and fonts
	gulp.watch(theme.fonts.src, ['copy-assets']);
	//4.Copy everything under `src/languages`indiscriminately
	gulp.watch(theme.lang.src, ['theme-lang']);
	//6.Generate script theme js
	gulp.watch(theme.js.src + '**/*.js', ['theme-js']);
	//7.Build stylesheets
	gulp.watch(theme.css.src + '/**/*.scss', ['css']);
	//8.Copy images
	gulp.watch([theme.image.src + '**/' + theme.image.imgType, theme.image.svg_src + '**/*.svg'], ['image']);
});
gulp.task('watch-code', function() {

	//Copy PHP source files to the `build`folder
	gulp.watch(theme.php.src, ['theme-php']);
	//Copy customizer assets and fonts
	gulp.watch(theme.customizer_assets.src, ['copy-assets']);
	//Generate script theme js
	gulp.watch([node + '*/{' + dist + '**/*.js,' + dist + '*.js}'], ['theme-js']);
	//Generate script theme js
	gulp.watch(theme.js.src + '**/*.js', ['theme-js']);
	//Build stylesheets
	gulp.watch(theme.css.src + '/**/*.scss', ['css']);
});
gulp.task('watcha', function() {
	//Copy PHP source files to the `build`folder
	gulp.watch(theme.php.src, ['theme-php']);
	//Build stylesheets
	gulp.watch(theme.css.src + '/**/*.scss', ['css']);
	//gulp.watch(theme.js.src+'**/*.js',['theme-js']);
});

//////////////////////FTP////////////////////////////////////////////////
gulp.task('ftp', function() {
	var conn = ftp.create({
		host: ftp_config.host,
		user: ftp_config.user,
		password: ftp_config.password,
		parallel: 10,
		log: gutil.log
	});
	return gulp.src(dist + '**', {
		base: dist,
		buffer: false
	}).pipe(conn.newer(ftp_config.path)).pipe(conn.dest(ftp_config.path));
});
gulp.task('ftp-watch', function() {
	var conn = ftp.create({
		host: ftp_config.host,
		user: ftp_config.user,
		password: ftp_config.password,
		parallel: 10,
		log: gutil.log
	});
	//Copy PHP source files to the `build`folder
	gulp.watch(theme.php.src, ['theme-php']);
	//Build stylesheets
	gulp.watch(theme.css.src + '/**/*.scss', ['css']);
	//Watch dist
	gulp.watch(['./dist/**/*']).on('change', function(event) {
		console.log('Changesdetected!Uploadingfile"' + event.path + '",' + event.type);
		return gulp.src([event.path], {
			base: dist,
			buffer: false
		}).pipe(conn.newer(ftp_config.path)).pipe(conn.dest(ftp_config.path));;
	});
});
