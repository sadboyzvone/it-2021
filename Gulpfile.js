const gulp = require('gulp');
const sass = require('gulp-sass');
const cleanCSS = require('gulp-clean-css');
const sassGlob = require('gulp-sass-glob');

gulp.task('build:sass', function () {
    return gulp
        .src('public_html/scss/**/*.scss')
        .pipe(sassGlob())
        .pipe(sass({}).on('error', sass.logError))
        .pipe(cleanCSS())
        .pipe(gulp.dest('public_html/css/'));
});

gulp.task('watch:sass', function () {
    return gulp
        .watch('public_html/scss/**/*.scss', gulp.series('build:sass'));
});

gulp.task('default', gulp.series('build:sass', 'watch:sass'));
