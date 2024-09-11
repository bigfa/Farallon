'use strict';

const gulp = require('gulp');
const uglify = require('gulp-uglify');
const plumber = require('gulp-plumber');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const sass = require('gulp-sass')(require('sass'));
const rename = require('gulp-rename');
const ts = require('gulp-typescript');
function fonts() {
    return gulp.src('./fonts/*').pipe(gulp.dest('./build/fonts/'));
}

function images() {
    return gulp.src('./images/*.{png,jpg,jpeg,gif,svg}').pipe(gulp.dest('./build/images/'));
}

function css() {
    return gulp
        .src('./scss/app.scss')
        .pipe(plumber())
        .pipe(sass({ outputStyle: 'compressed' }))
        .pipe(rename({ suffix: '.min' }))
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(gulp.dest('./build/css/'));
}

function settingCss() {
    return gulp
        .src('./scss/setting.scss')
        .pipe(plumber())
        .pipe(sass({ outputStyle: 'compressed' }))
        .pipe(rename({ suffix: '.min' }))
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(gulp.dest('./build/css/'));
}

function setting() {
    return gulp
        .src(['./js/extensions/*', './js/setting.ts'])
        .pipe(plumber())
        .pipe(
            ts({
                noImplicitAny: true,
                outFile: 'setting.js',
                target: 'es5',
            })
        )
        .pipe(uglify())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('./build/js/'));
}

// Transpile, concatenate and minify scripts
function scripts() {
    return gulp
        .src(['./js/extensions/*', './js/app.ts', './js/modules/*'])
        .pipe(
            ts({
                noImplicitAny: true,
                outFile: 'app.js',
                target: 'es5',
            })
        )
        .pipe(uglify())
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('./build/js/'));
}

// Watch files
function watchFiles() {
    gulp.watch(['./js/modules/*', './js/extensions/*', './js/app.ts'], gulp.series(scripts));
    gulp.watch(['./scss/app.scss', './scss/modules/*', './scss/templates/*'], gulp.series(css));
    gulp.watch(
        ['./scss/setting.scss', './scss/modules/*', './scss/templates/*'],
        gulp.series(settingCss)
    );
    gulp.watch(['./js/setting.ts'], gulp.series(setting));
}

// define complex tasks
const js = gulp.series(scripts);
const watch = gulp.parallel(watchFiles);
const build = gulp.parallel(watch, gulp.parallel(css, fonts, js, images, settingCss, setting));

exports.css = css;
exports.js = js;
exports.build = build;
exports.watch = watch;
exports.default = build;
