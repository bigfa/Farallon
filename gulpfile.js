'use strict';

const gulp = require('gulp');
const babel = require('gulp-babel');
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');
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
    return gulp.src('./images/*.{png,jpg,gif,svg}').pipe(gulp.dest('./build/images/'));
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

// function setting() {
//     return (
//         gulp
//             .src(['./js/setting.js'])
//             .pipe(plumber())
//             //.pipe(webpackstream(webpackconfig, webpack))
//             //.pipe(concat("setting.js"))
//             .pipe(
//                 babel({
//                     presets: ['@babel/preset-env'],
//                 })
//             )
//             .pipe(uglify())
//             //.pipe(plumber())
//             //.pipe(webpackstream(webpackconfig, webpack))
//             //.pipe(concat('all.js'))
//             //.pipe(babel({
//             //presets: ['@babel/preset-env']
//             // }))
//             // .pipe(uglify())
//             .pipe(gulp.dest('./build/js/'))
//     );
// }

// Transpile, concatenate and minify scripts
function scripts() {
    return (
        gulp
            .src(['./js/app.ts', './js/modules/*'])
            //.pipe(webpackstream(webpackconfig, webpack))
            .pipe(
                ts({
                    noImplicitAny: true,
                    outFile: 'app.js',
                })
            )
            //.pipe(uglify())
            //.pipe(plumber())
            //.pipe(webpackstream(webpackconfig, webpack))
            //.pipe(concat('all.js'))
            //.pipe(babel({
            //presets: ['@babel/preset-env']
            // }))
            // .pipe(uglify())
            .pipe(gulp.dest('./build/js/'))
    );
}

// Watch files
function watchFiles() {
    gulp.watch(['./js/modules/*', './js/ts.js'], gulp.series(scripts));
    gulp.watch(['./scss/*', './scss/modules/*', './scss/templates/*'], gulp.series(css));
    //gulp.watch(['./js/setting.js'], gulp.series(setting));
}

// define complex tasks
const js = gulp.series(scripts);
const watch = gulp.parallel(watchFiles);
const build = gulp.parallel(watch, gulp.parallel(css, fonts, js, images));

exports.css = css;
exports.js = js;
//exports.setting = setting;
exports.build = build;
exports.watch = watch;
exports.default = build;
