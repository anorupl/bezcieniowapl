// Defining requirements
var gulp 		= require('gulp'),
	gulpIgnore 	= require('gulp-ignore'),
	del 		= require('del'),
	sourcemap 	= require('gulp-sourcemaps'),
	sequence 	= require('run-sequence'),
	sass		= require('gulp-sass'),
	prefixer 	= require('gulp-autoprefixer'), 
	merge 		= require('merge-stream'),
	imagemin 	= require('gulp-imagemin'),
	changed 	= require('gulp-changed'),
	svgmin 		= require('gulp-svgmin'),
	uglify 		= require('gulp-uglify'),
	concat 		= require('gulp-concat'),
	rename 		= require('gulp-rename'),
	wpPot 		= require('gulp-wp-pot'),
	sort 		= require('gulp-sort'),	
	ftp 		= require('vinyl-ftp'),
    ftp_config 	= require('./ftp.json'),
    gutil 		= require('gulp-util'),
	insert 		= require("gulp-insert"),
    header 		= require('./header.json');    
	browserSync = require('browser-sync');
	
gulp.task('reload', function(){
	browserSync.reload();
});

	
// Base config
var project 	=	'wpg-bezcieniowapl', 			// The directory name for your theme
	node 		=	'node_modules/',
	bower   	=	'bower_assets/vendor/',	// bower packages
	src			=	'./src/',
	dist 		=	'./dist/',	
	project_dir =	dist + project +'/';
	
var config = {
	assets_js: {
		jquery:		bower + 'jquery/dist/jquery.min.js',
    	html5shiv:	bower + 'html5shiv/dist/*.min.js',
    	slider: 	bower + 'flexslider/jquery.flexslider-min.js',    	
    	owl_js:		bower + 'owl.carousel/dist/owl.carousel.min.js',
    	slick_js:	bower + 'slick-carousel/slick/slick.min.js',
    	gallery:	bower + 'justifiedGallery/dist/js/jquery.justifiedGallery.min.js',
    	imagePopup:	bower + 'magnific-popup/dist/jquery.magnific-popup.min.js',
		dist:		project_dir +'/js/assets/',			
		watch:		[bower + '*/{'+dist+'**/*.js, '+dist+'*.js}',bower + '*/{jquery.flexslider.js,jquery.flexslider-min.js}']
	},
	theme:{
		css:{
		    src: 		src + 'assets/sass/', 	//sass   
		    src_css: 	src + '/css/', 			//css   
		    dist: 		project_dir, 			//baseCss
		    dist_css:	project_dir +'/css/'	//extraCss	
		},	
		image:{
			img_screen: src + '/*.{jpg,jpeg,png,gif}',
			dis_screen: project_dir,
			src: 		src + 'assets/img/',
			dist:		project_dir +'/img/',
			svg_src: 	src +'assets/img/svg/',
			svg_dist:	project_dir +'/img/svg/',
			imgType:	'*.{jpg,jpeg,png,gif}'
		},			
		js: {
			src: 	src + 'assets/js/',
			dist:	project_dir +'/js/',
			watch:  src + 'assets/js/**/*.js'
		},
		php: {
			src:	src +'**/*.php', // src and watch
			dist:	project_dir
		},
		customizer_assets: {
			src:	src + 'inc/customizer/assets/**/*{.js,.css,.json}', // src and watch
			dist:	project_dir + 'inc/customizer/assets/'
		},
		fonts:{
			src:	src + 'fonts/**/*.{ttf,woff,eot,svg}', // src and watch
			dist:	project_dir + 'fonts/'			
		},
		lang:{
			src:	src + 'languages/**/*', // src and watch
			dist:	project_dir + 'languages/'				
		} 
	}
};

/////////////////////////////////////////////////////////////////////////

/*
 * 1.	Copy PHP source files to the `build` folder
 * 2.	Copy customizer assets and fonts 
 * 3.	Copy everything under `src/languages` indiscriminately
 * 4.	Generate script
 * 5.	Build stylesheets
 * 6.	Copy images
 */

// Copy PHP source files to the `build` folder
gulp.task('theme-php', function() {
	return gulp.src(config.theme.php.src)
  		.pipe(changed(config.theme.php.dist))
  		.pipe(gulp.dest(config.theme.php.dist));
});

// Copy customizer assets and fonts 
gulp.task('copy-assets', function() {
	
	//customizer assets
	gulp.src(config.theme.customizer_assets.src)
		.pipe(changed(config.theme.customizer_assets.dist))
  		.pipe(gulp.dest(config.theme.customizer_assets.dist)); 
  		
	// Copy all custom fonts
    gulp.src(config.theme.fonts.src)
    	.pipe(changed(config.theme.fonts.dist))
        .pipe(gulp.dest(config.theme.fonts.dist));  		
});

// Copy everything under `src/languages` indiscriminately
gulp.task('theme-lang', function() {
  return gulp.src(config.theme.lang.dist)
  .pipe(gulp.dest(config.theme.lang.dist));
});

// Generate script
gulp.task('theme-js',function(){

	// Copy Js assets : silder, html5shiv
	gulp.src([config.assets_js.html5shiv,config.assets_js.slick_js])
		.pipe(changed(config.assets_js.dist))
        .pipe(gulp.dest(config.assets_js.dist)); 
    
    // Copy Js for gallery and images    
	gulp.src([config.assets_js.imagePopup])
		.pipe(changed(config.assets_js.dist))
		.pipe(concat('imgGallery.js'))
		.pipe(uglify())
		.pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(config.assets_js.dist));               
   
    // Copy theme js file   
 	gulp.src(config.theme.js.src + '**/*.min.js')
 		.pipe(changed(config.theme.js.dist))
        .pipe(gulp.dest(config.theme.js.dist));          
	
	// Copy theme js file and minify
 	gulp.src(['!'+ config.theme.js.src + '**/*.min.js',config.theme.js.src + '**/*.js'])
 		.pipe(changed(config.theme.js.dist))
 		.pipe(uglify())
 		.pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest(config.theme.js.dist));    

    //.pipe(browserSync.stream());
	
});

// Build stylesheets
gulp.task('sass', function(){
	
	// Base theme style
	var style = gulp.src(config.theme.css.src + 'style.scss')
  		//.pipe(sourcemap.init())
  		.pipe(changed(config.theme.css.dist))
		//Default: nested Values: nested, expanded, compact, compressed
		.pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
		//.pipe(sourcemap.write())
		.pipe(prefixer({
			browsers: ['Chrome 33', 'Firefox 10', 'IE 8', 'Edge 12']
		}))
	.pipe(gulp.dest(config.theme.css.dist));
	
	
	var css = gulp.src(config.theme.css.src_css + '*.css')
  		.pipe(changed(config.theme.css.dist_css))
		.pipe(sass().on('error', function(error){
      		console.log(error);
      		this.emit('end');	  	
	  	}))
	.pipe(gulp.dest(config.theme.css.dist_css));
	
	var ie8 = gulp.src(config.theme.css.src + 'ie8.scss')
		.pipe(sass().on('error', function(error){
      		console.log(error);
      		this.emit('end');	  	
	  	}))
	.pipe(gulp.dest(config.theme.css.dist_css));	
	
	//var slick = gulp.src(config.theme.css.src + 'slick.scss')
  		//.pipe(changed(config.theme.css.dist_css))
		//.pipe(sass().on('error', function(error){
      		//console.log(error);
      		//this.emit('end');	  	
	  	///}))
	//.pipe(gulp.dest(config.theme.css.dist_css));
	
	 return merge(style,css,ie8);
});

//Copy images and svg from: assets/img/
gulp.task('images',function(){
	
	var imagesFile = gulp.src(config.theme.image.src + '**/' + config.theme.image.imgType)
	.pipe(changed(config.theme.image.dist))
	.pipe(imagemin())
	.pipe(gulp.dest(config.theme.image.dist));
	
	
	var screenFile = gulp.src(config.theme.image.img_screen)
		.pipe(imagemin())
		.pipe(gulp.dest(config.theme.image.dis_screen));
	
	var svgFile = gulp.src(config.theme.image.svg_src + '**/*.svg')
	.pipe(changed(config.theme.image.svg_dist))
	.pipe(svgmin())
	.pipe(gulp.dest(config.theme.image.svg_dist));	
	
	return merge(imagesFile, svgFile, screenFile);
});




// Generate pot-files for WordPress localization

gulp.task('language', function () {
   var langpot = gulp.src(config.theme.php.src)
        .pipe(sort())
        .pipe(wpPot( {
            domain: 'wpg_theme',
            destFile: project +'.pot',
            package: project,
            bugReport: 'http://code.zerebny.ovh',
        } ))
        .pipe(gulp.dest(config.theme.lang.dist));
   
   var langpo = gulp.src(config.theme.lang.src)   
       .pipe(gulp.dest(config.theme.lang.dist));
        
        
  	return merge(langpot, langpo);
      
});


gulp.task('css', ['sass'], function () {
 
    var headers = "";

    for(var key in header){
        headers += "\t" + key + ": " + header[key] + "\n";
    }
 
    return gulp.src(project_dir + 'style.css')
        .pipe(insert.prepend('/*\n' + headers + '\n*/\n'))
        .pipe(gulp.dest(project_dir));
});


////////////////////// Build ////////////////////////////////////////////////


// Remove distributon folder
gulp.task('clean', function(){
	return del(dist);
});

gulp.task('build',['clean'], function(){
	sequence('theme-php','copy-assets','theme-lang','theme-js','css','images','language');
});

////////////////////// Watch ////////////////////////////////////////////////


gulp.task('watch-all', function() {
/*
 * 1.	Copy PHP source files to the `build` folder
 * 2.	Copy customizer assets and fonts 
 * 3.	Copy everything under `src/languages` indiscriminately
 * 4.	Generate script
 * 5.	Build stylesheets
 * 6.	Copy images	
 */
	// 1.	Copy PHP source files to the `build` folder
	gulp.watch(config.theme.php.src, ['theme-php']);
	// 2.	Copy customizer assets and fonts 
	gulp.watch(config.theme.customizer_assets.src, ['copy-assets']);
	// 2.	Copy customizer assets and fonts 	
	gulp.watch(config.theme.fonts.src, ['copy-assets']);
	//3.	Copy everything under `src/languages` indiscriminately		
	gulp.watch(config.theme.lang.src, ['theme-lang']);
	// 4.	Generate script bower js
	gulp.watch([bower + '*/{'+dist+'**/*.js, '+dist+'*.js}',bower + '*/{jquery.flexslider.js,jquery.flexslider-min.js}'], ['theme-js']);
	// 4.	Generate script theme js
	gulp.watch(config.theme.js.src + '**/*.js', ['theme-js']);
	// 5.	Build stylesheets	
	gulp.watch(config.theme.css.src +'/**/*.scss', ['sass']);
 	//6.	Copy images
	gulp.watch([config.theme.image.src + '**/' + config.theme.image.imgType,config.theme.image.svg_src + '**/*.svg'], ['image']);
});

gulp.task('watch-code', function() {
	
	browserSync({
			proxy: "http://kamilzerebny.ayz.pl/beta/wedding/"
	}); 	

	/*
	 * 1.	Copy PHP source files to the `build` folder
	 * 2.	Copy customizer assets and fonts 
	 * 3.	Copy everything under `src/languages` indiscriminately
	 * 4.	Generate script
	 * 5.	Build stylesheets
	 * 6.	Copy images	
	 */
	
	// 1.	Copy PHP source files to the `build` folder
	gulp.watch(config.theme.php.src, ['theme-php']);
	// 2.	Copy customizer assets and fonts 
	gulp.watch(config.theme.customizer_assets.src, ['copy-assets']);
	// 4.	Generate script bower js
	gulp.watch([bower + '*/{'+dist+'**/*.js, '+dist+'*.js}',bower + '*/{jquery.flexslider.js,jquery.flexslider-min.js}'], ['theme-js']);
	// 4.	Generate script theme js
	gulp.watch(config.theme.js.src + '**/*.js', ['theme-js']);
	// 5.	Build stylesheets	
	gulp.watch(config.theme.css.src +'/**/*.scss', ['sass']);
});
gulp.task('watcha', function() {
	// 1.	Copy PHP source files to the `build` folder
	gulp.watch(config.theme.php.src, ['theme-php']);	
	// 5.	Build stylesheets	
	gulp.watch(config.theme.css.src +'/**/*.scss', ['sass']);	
		
	gulp.watch(config.theme.js.src + '**/*.js', ['theme-js']);
	
});


gulp.task('ftp', function () {
	

	
    var conn = ftp.create({
        host: ftp_config.host,
        user: ftp_config.user,
        password: ftp_config.password,
        parallel: 10,
        log: gutil.log
    });
 
    return gulp.src( dist + '**', {
            base: dist,
            buffer: false
        })
        .pipe(conn.newer(ftp_config.path))
        .pipe(conn.dest(ftp_config.path));
 
});


