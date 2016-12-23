var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    minifycss = require('gulp-minify-css'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    rename = require('gulp-rename'),
    notify = require('gulp-notify'),
    livereload = require('gulp-livereload'),
    cache = require('gulp-cache'),
    vinylPaths = require('vinyl-paths'),
    del = require('del');

var devdir = '../../laravel4/app/dist/';
var styledevdir = devdir + 'style/';
var scriptdevdir = devdir + 'script/';
var libdevdir = devdir + 'lib/';
var fontdevdir = devdir + 'font/';
var imgdevdir = devdir + 'img/';

function swallowError (error) {

    //If you want details of the error in the console
    console.log(error.toString());

    this.emit('end');
}

/**
 * Compile sass based style and put on temporary dir
 */
gulp.task('style:sass-compile', function() {
    return sass(styledevdir + 'raw/', ({ style: 'expanded', trace: true }))
	    .on('error', swallowError)
        .pipe(rename({ extname: '.max.css' }))
        .pipe(gulp.dest(styledevdir + 'temp'));
});

/**
 * Compile (copy) css and put on temporary dir
 */
gulp.task('style:css-compile', function() {
    return gulp.src(styledevdir + 'raw/*.css')
        .pipe(rename({ extname: '.max.css' }))
        .pipe(gulp.dest(styledevdir + 'temp'));
});

/**
 * Minify compiled sass (already css-typed) and put on temp dir too
 */
gulp.task('style:minify', ['style:sass-compile', 'style:css-compile'], function() {
    return gulp.src(styledevdir + 'temp/*.max.css')
        .pipe(rename({ extname: '' }))
        .pipe(rename({ extname: '.min.css' }))
        // See bug https://github.com/jonathanepollack/gulp-minify-css/issues/61
        .pipe(minifycss({ processImport: false }))
        .pipe(gulp.dest(styledevdir + 'temp/'));
});

/**
 * Move all ready-to-deploy style into public dir
 */
gulp.task('style:move-ready-to-deploy', function() {
    return gulp.src(styledevdir + 'deploy/*.css')
        .pipe(gulp.dest('./style'));
});

/**
 * Concatenate all style and put on public dir
 */
gulp.task('styles', ['style:minify', 'style:move-ready-to-deploy'], function() {
    // See bug https://github.com/jonathanepollack/gulp-minify-css/issues/61
    var vp = vinylPaths();

    return gulp.src(styledevdir + 'temp/*.min.css')
        .pipe(concat('styles.min.css'))
        .pipe(gulp.dest('./style'))
        .on('end', function () {
            del(vp.paths, { force: true });
        });
});

/**
 * Minify script
 */
gulp.task('script:minify', function() {
    return gulp.src(scriptdevdir + 'raw/*.js')
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(scriptdevdir + 'temp'));
});

/**
 * Move all ready-to-deploy script (inside 'deploy/') into public dir
 */
gulp.task('script:move-ready-to-deploy', ['script:minify'], function() {
    return gulp.src(scriptdevdir + 'deploy/*.js')
        .pipe(gulp.dest('./script'));
});

/**
 * Move scripts and put on public dir
 */
gulp.task('scripts', ['script:minify', 'script:move-ready-to-deploy'], function() {
    return gulp.src(scriptdevdir + 'temp/*.min.js')
        .pipe(gulp.dest('./script'));
});

/**
 * Copy libs, scripts, fonts, images
 */
gulp.task('libs', function() {
    return gulp.src(libdevdir + '**/*')
        .pipe(cache(gulp.dest('./lib')));
});

gulp.task('fonts', function() {
    return gulp.src(fontdevdir + '**/*')
        .pipe(cache(gulp.dest('./font')));
});

gulp.task('imgs', function() {
    return gulp.src(imgdevdir + '**/*')
        .pipe(cache(gulp.dest('./img')));
});

gulp.task('htmls', function() {
    return gulp.src(devdir + '**/*.html')
        .pipe(cache(gulp.dest('./')));
});

gulp.task('others', function() {
    return gulp.src(devdir + '*')
        .pipe(cache(gulp.dest('./')));
});

gulp.task('libs:nocache', function() {
    return gulp.src(libdevdir + '**/*')
        .pipe(gulp.dest('./lib'));
});

gulp.task('fonts:nocache', function() {
    return gulp.src(fontdevdir + '**/*')
        .pipe(gulp.dest('./font'));
});

gulp.task('imgs:nocache', function() {
    return gulp.src(imgdevdir + '**/*')
        .pipe(gulp.dest('./img'));
});

gulp.task('htmls:nocache', function() {
    return gulp.src(devdir + '**/*.html')
        .pipe(gulp.dest('./'));
});

gulp.task('others:nocache', function() {
    return gulp.src(devdir + '*')
        .pipe(gulp.dest('./'));
});

function syncAll() {
    gulp.start('styles');
    gulp.start('scripts');
    gulp.start('libs');
    gulp.start('imgs');
    gulp.start('htmls');
    gulp.start('others');
}

/**
 * Helper for lost file while checking out accross branch
 */
gulp.task('init', function() {
    gulp.start('styles');
    gulp.start('scripts');
    gulp.start('libs:nocache');
    gulp.start('imgs:nocache');
    gulp.start('htmls:nocache');
    gulp.start('others:nocache');
});

/**
 * Watch for change event
 */
gulp.task('watch', function() {
    syncAll();
    gulp.watch(styledevdir + 'raw/*', ['styles']);
    gulp.watch(scriptdevdir + 'raw/*.js', ['scripts']);
    gulp.watch(libdevdir + '**/*', ['libs']);
    gulp.watch(imgdevdir + '**/*', ['imgs']);
    gulp.watch(devdir + '**/*.html', ['htmls']);
    gulp.watch(devdir + '*', ['others']);

    // Buat server livereload
    livereload.listen({
        port: 9000
    });
    gulp.watch(['**/*']).on('change', livereload.changed);
    gulp.watch(['../../laravel4/app/views/**/*.blade.php']).on('change', livereload.changed);
});

gulp.task('default', function() {
    syncAll();
});
