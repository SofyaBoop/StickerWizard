const gulp = require('gulp');
const browsersync = require('browser-sync').create();

//HTML и PHP
const fileInclude = require('gulp-file-include');
const htmlclean = require('gulp-htmlclean');
const webpHTML = require('gulp-webp-html');
const merge = require('merge-stream');

//SASS
const sass = require('gulp-sass')(require('sass'));
const sassGlob = require('gulp-sass-glob');
const groupMedia = require('gulp-group-css-media-queries');
const autoprefixer = require('gulp-autoprefixer');
const csso = require('gulp-csso');
const webpCSS = require('gulp-webp-css');

const server = require('gulp-server-livereload');
const clean = require('gulp-clean');
const fs = require('fs');
const sourceMaps = require('gulp-sourcemaps');
const plumber = require('gulp-plumber');
const notify = require('gulp-notify');
const webpack = require('webpack-stream');
const babel = require('gulp-babel');

//Images
const imagemin = require('gulp-imagemin');
const webp = require('gulp-webp');

const changed = require('gulp-changed');



gulp.task('clean:docs', function(done){
    if (fs.existsSync('./docs/')){
        return gulp.src('./docs/', {read: false}).pipe(clean({force: true}));
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

gulp.task('html:docs', function(){
    return gulp
        .src(['./src/html/**/*.html','./src/html/blocks/*.html'])
        .pipe(changed('./docs/'))
        .pipe(plumber(plumberNotify('HTML')))
        .pipe(fileInclude(fileIncludeSettings))
        .pipe(webpHTML())
        .pipe(htmlclean())
        .pipe(gulp.dest('./docs/'))
});

gulp.task('php:docs', function(){
    function processFiles(source, destination) {
        return gulp
            .src(source)
            .pipe(changed(destination, {hasChanged: changed.compareContents}))
            .pipe(plumber(plumberNotify('PHP')))
            .pipe(fileInclude(fileIncludeSettings))
            .pipe(gulp.dest(destination))
    }

    var markupTask = processFiles(['./src/markup/**/*.php', './src/markup/blocks/*.php', './src/markup/admin/*.php'], './docs/');
    var databaseTask = processFiles('./src/database/*.php', './docs/database');
    var controllersTask = processFiles('./src/controllers/*.php', './docs/controllers');
    var helpsTask = processFiles('./src/helps/*.php', './docs/helps');
    var rootPathTask = processFiles('./src/root_path.php', './docs/');
    return merge(markupTask, databaseTask, controllersTask, helpsTask, rootPathTask);
});

gulp.task('sass:docs', function(){
    return gulp
        .src('./src/scss/*.scss')
        .pipe(changed('./docs/css/'))
        .pipe(plumber(plumberNotify('SCSS')))
        .pipe(sourceMaps.init())
        .pipe(autoprefixer())
        .pipe(sassGlob())
        .pipe(webpCSS())
        .pipe(groupMedia())
        .pipe(sass())
        .pipe(csso())
        .pipe(sourceMaps.write())
        .pipe(gulp.dest('./docs/css/'))
});

gulp.task('images:docs', function(){
    return gulp
    .src('./src/img/**/*')
    .pipe(changed('./docs/img/'))
    .pipe(webp())
    .pipe(gulp.dest('./docs/img/'))
    .pipe(gulp.src('./src/img/**/*'))
    .pipe(changed('./docs/img/'))
    .pipe(imagemin({ verbose: true}))
    .pipe(gulp.dest('./docs/img/'))
});

gulp.task('fonts:docs', function(){
    return gulp
    .src('./src/fonts/**/*')
    .pipe(changed('./docs/fonts/'))
    .pipe(gulp.dest('./docs/fonts/'))
});

gulp.task('files:docs', function(){
    return gulp
    .src('./src/maket_files/**/*')
    .pipe(changed('./docs/maket_files/'))
    .pipe(gulp.dest('./docs/maket_files/'))
});

gulp.task('js:docs', function(){
    return gulp
        .src('./src/js/*.js')
        .pipe(changed('./docs/js'))
        .pipe(plumber(plumberNotify('JS')))
        .pipe(babel())
        .pipe(webpack(require('./../webpack.config.js')))
        .pipe(gulp.dest('./docs/js'))
});

// const serverOptions = {
//     livereload: true,
//     open: true
// };

// gulp.task('server:docs', function(){
//     return gulp.src('./docs/').pipe(server(serverOptions));
// });

// gulp.task('server:docs', function(){
//     browsersync.init({
//         server:{
//             baseDir: "./docs"
//         }
//     });
//     browsersync.watch('docs', browsersync.reload)
// });

gulp.task('server:docs', function(){
    browsersync.init({
            proxy: 'http://StickerWizardDocs.localhost',
            host: 'StickerWizardDocs.localhost',
            open: 'external',
            notify: false
    });
    //browsersync.watch('built', browsersync.reload)
});