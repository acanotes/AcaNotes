const { watch, series, src, dest } = require('gulp');
const gulpif = require('gulp-if');
const uglify = require('gulp-uglify'); // minify js
const babel = require('gulp-babel'); // babelify
const rename = require('gulp-rename');
const concat = require('gulp-concat'); // concatencates all files into one .pipe(concat('all.js'))
//const autoprefixer = require('gulp-autoprefixer'); // auto prefix
const autoprefixer = require('autoprefixer');
const postcss = require('gulp-postcss'); // help autoprefixer
const cleanCSS = require('gulp-clean-css'); // minify css

function isJavaScript(file) {
  // Check if file extension is '.js'
  return file.extname === '.js';
}
function compileCSS(cb) {
  return src('public/styles/**/*.css')
  .pipe(postcss([ autoprefixer() ]))
    .pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(rename({ extname: '.min.css' }))
    .pipe(dest('public/build/styles'));
  cb();
}

/**
 * Compiles javascript, react and normal and minifies it
 *
*/
function compileJavaScript(cb) {
  return src('../scripts/**/*.js')
    .pipe(babel({presets: ["@babel/preset-env", "@babel/preset-react"]}))
    //.pipe(uglify())
    .pipe(rename({ extname: '.min.js' }))
    .pipe(dest('../build/scripts'));
  cb();
}
exports.compileJavaScript = compileJavaScript;
exports.compileCSS = compileCSS;
exports.default = function(){
  watch('public/scripts/**/*.js', series(compileJavaScript));
  watch('public/styles/**/*.css', series(compileCSS));
}
