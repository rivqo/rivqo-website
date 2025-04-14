var gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
var rtlcss = require('gulp-rtlcss');
var rename = require("gulp-rename");
const errorHandler = require('gulp-error-handle');
//var sourcemaps = require('gulp-sourcemaps');
var concat = require('gulp-concat');
var gutil = require('gulp-util');
var lec = require('gulp-line-ending-corrector');
//const cleanCSS = require('gulp-clean-css');

//main task
gulp.task('default', function(){
	// gulp.watch('scss/**/*.scss', ['mascot-core-sass-elementor','mascot-core-rtl-elementor']);
	gulp.watch('scss/**/*.scss', gulp.series(['mascot-core-sass-elementor','mascot-core-rtl-elementor']));
})

//gulp.task('develop', gulp.series('sass-elementor', 'rtl-elementor'))


//Task 1 - scss to css
gulp.task('mascot-core-sass-elementor', function(){
	return gulp.src(
		[
		'scss/**/*.scss',
		]
	)
	.pipe(errorHandler())
	.pipe(sass()) // Using gulp-sass
	.pipe(lec()) // gulp-line-ending-corrector
	.pipe(gulp.dest('assets/css'))
});


//Task 2 - css to rtl-css
gulp.task('mascot-core-rtl-elementor', function () {
	return gulp.src(
		[
		'assets/css/**/*.css',
		'!assets/css/**/*.rtl.css',
		]
	)
	.pipe(rtlcss())
	.pipe(rename({ suffix: '.rtl' }))
	.pipe(lec()) // gulp-line-ending-corrector
	.pipe(gulp.dest('assets/css/'));
});



/*gulp.task('minify-css', () => {
  return gulp.src('assets/css/shortcodes/*.css')
    .pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(gulp.dest('dist'));
});*/