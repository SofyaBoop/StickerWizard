const gulp = require('gulp');
const browsersync = require('browser-sync').create();
const fileInclude = require('gulp-file-include');
const sass = require('gulp-sass')(require('sass'));
const sassGlob = require('gulp-sass-glob');
const server = require('gulp-server-livereload');
const clean = require('gulp-clean');
const fs = require('fs');
const sourceMaps = require('gulp-sourcemaps');
const plumber = require('gulp-plumber');
const notify = require('gulp-notify');
const webpack = require('webpack-stream');
const babel = require('gulp-babel');
const imagemin = require('gulp-imagemin');
const changed = require('gulp-changed');



gulp.task('clean:dev', function(done){
    if (fs.existsSync('./built/')){
        return gulp.src('./built/', {read: false}).pipe(clean({force: true}));
    }
    done()
});

const fileIncludeSettings = {
    prefix: '@@',
    basepath: '@file'
};

const plumberNotify = (title) => {
    return{
        errorHandler: notify.onError({
            title: title,
            message: 'Error <%= error.message %>',
            sound: false
        })
    };
}

gulp.task('html:dev', function(){
    return gulp
        .src(['./src/html/**/*.html','./src/html/blocks/*.html'])
        .pipe(changed('./built/', {hasChanged: changed.compareContents}))
        .pipe(plumber(plumberNotify('HTML')))
        .pipe(fileInclude(fileIncludeSettings))
        .pipe(gulp.dest('./built/'))
        .on('end', browsersync.reload)
});

gulp.task('sass:dev', function(){
    return gulp
        .src('./src/scss/*.scss')
        .pipe(changed('./built/css/'))
        .pipe(plumber(plumberNotify('SCSS')))
        .pipe(sourceMaps.init())
        .pipe(sassGlob())
        .pipe(sass())
        .pipe(sourceMaps.write())
        .pipe(gulp.dest('./built/css/'))
        .pipe(browsersync.reload({stream: true}))
});

gulp.task('images:dev', function(){
    return gulp
    .src('./src/img/**/*')
    .pipe(changed('./built/img/'))
    //.pipe(imagemin({ verbose: true}))
    .pipe(gulp.dest('./built/img/'))
    .pipe(browsersync.reload({stream: true}))
});

gulp.task('fonts:dev', function(){
    return gulp
    .src('./src/fonts/**/*')
    .pipe(changed('./built/fonts/'))
    .pipe(gulp.dest('./built/fonts/'))
    .pipe(browsersync.reload({stream: true}))
});

gulp.task('files:dev', function(){
    return gulp
    .src('./src/files/**/*')
    .pipe(changed('./built/files/'))
    .pipe(gulp.dest('./built/files/'))
    .pipe(browsersync.reload({stream: true}))
});

gulp.task('js:dev', function(){
    return gulp
        .src('./src/js/*.js')
        .pipe(changed('./built/js'))
        .pipe(plumber(plumberNotify('JS')))
        //.pipe(babel())
        .pipe(webpack(require('./../webpack.config.js')))
        .pipe(gulp.dest('./built/js'))
        .pipe(browsersync.reload({stream: true}))
});

// const serverOptions = {
//     livereload: true,
//     open: true
// };

// gulp.task('server:dev', function(){
//     return gulp.src('./built/').pipe(server(serverOptions));
// });

gulp.task('server:dev', function(){
    browsersync.init({
        server:{
            baseDir: "./built"
        }
    });
    //browsersync.watch('built', browsersync.reload)
});

gulp.task('watch:dev', function(){
    gulp.watch('./src/scss/**/*.scss', gulp.parallel('sass:dev'));
    gulp.watch('./src/**/*.html', gulp.parallel('html:dev'));
    gulp.watch('./src/img/**/*', gulp.parallel('images:dev'));
    gulp.watch('./src/fonts/**/*', gulp.parallel('fonts:dev'));
    gulp.watch('./src/files/**/*', gulp.parallel('files:dev'));
    gulp.watch('./src/js/**/*.js', gulp.parallel('js:dev'))
});