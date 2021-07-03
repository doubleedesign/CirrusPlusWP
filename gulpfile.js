const gulp = require('gulp');
const plumber = require('gulp-plumber');
const sass = require('gulp-sass');
const sassGlob = require('gulp-sass-glob');
const rename = require('gulp-rename');
const autoprefixer = require('gulp-autoprefixer');
const minifyCSS       = require('gulp-minify-css');
const uglify          = require('gulp-uglify');
const concat          = require('gulp-concat');
const gutil           = require('gulp-util');
const browsersync     = require('browser-sync').create();
const sourcemaps      = require('gulp-sourcemaps');
const wpPot 			= require('gulp-wp-pot');
const postCSS         = require('gulp-postcss');
const objectFitImages = require('postcss-object-fit-images');


gulp.task('styles',  done =>  {
	gulp.src('sass/base.scss')
		.pipe(sassGlob())
		.pipe(sourcemaps.init())
		.pipe(plumber(function (error) {
			console.log(error);
			this.emit('end');
		}))
		.pipe(sass())
		.pipe(postCSS([objectFitImages]))
		.pipe(autoprefixer({browsers: ['defaults', 'iOS >= 8']}))
		.pipe(minifyCSS())
		.pipe(rename('main.min.css'))
		.pipe(sourcemaps.write('/'))
		.pipe(gulp.dest('dist/css'))
		.pipe(browsersync.stream())
	done();
});

gulp.task('scripts', done => {
	gulp.src('js/[^_]*.js')
		.pipe(concat('main.js'))
		.pipe(rename({suffix: '.min'}))
		.pipe(uglify().on('error', function(error){
			gutil.log(gutil.colors.red('[Error]'), error.toString());
			this.emit('end');
		}))
		.pipe(gulp.dest('dist/js'))
		.pipe(browsersync.stream())
	done();
});

gulp.task('vendor', done => {
	gulp.src('js/vendor/[^_]*.js')
		.pipe(concat('vendor.js'))
		.pipe(rename({suffix: '.min'}))
		.pipe(uglify().on('error', function(error){
			gutil.log(gutil.colors.red('[Error]'), error.toString());
			this.emit('end');
		}))
		.pipe(gulp.dest('dist/js'))
		.pipe(browsersync.stream())
	done();
});

gulp.task('translations', done => {
	let domain = 'legpress';
	gulp.src('./**/*.php')
		.pipe(wpPot({
			domain: domain,
			package: 'LegPress',
			headers: {
				NOTES: 'CMS = content management system',
			},
		}))
		.pipe(gulp.dest('languages/'+domain+'.pot'))
		.pipe(browsersync.stream());
	done();
});

gulp.task('build', function() {
	browsersync.init({
		proxy: {
			target: 'https://legpress.local'
		},
		snippetOptions: {
			whitelist: ['/wp-admin/admin-ajax.php'],
			blacklist: ['/wp-admin/**']
		}
	});

	gulp.watch('sass/**/*.scss', gulp.series('styles'));
	gulp.watch('js/[^_]*.js', gulp.series('scripts'));
	gulp.watch('js/vendor/[^_]*.js', gulp.series('vendor'));
	gulp.watch('./**/*.php', gulp.series('translations'));
	browsersync.reload();

});

gulp.task('default', gulp.parallel(gulp.series('build')));