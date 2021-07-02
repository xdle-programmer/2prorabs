const { src, dest, series, watch } = require('gulp');
const sourcemaps = require('gulp-sourcemaps');
const sass = require('gulp-sass');
const sassDataURI = require('lib-sass-data-uri');

const webpack = require('webpack');
//const webpackConfig = require("./webpack.config.js");

sass.compiler = require('node-sass');

const scss = () => {
    return src(['./local/templates/stroygip/scss/index.scss'])
        .pipe(sourcemaps.init())
        .pipe(
            sass({
                outputStyle: 'expanded',
                functions: Object.assign(sassDataURI, { })
            })
                .on('error', sass.logError)
        )
        .pipe(sourcemaps.write('./'))
        .pipe(dest('./local/templates/stroygip'));
};

const watchScss = series(scss, () => {
    return watch([
        'local/templates/stroygip/scss/**/*.scss',
        'local/templates/stroygip/general.scss'
    ], scss);
});

const runWebpack = () => {
    return new Promise(resolve => webpack(webpackConfig, (err, stats) => {
        if (err) {
            console.log('Webpack', err);
        }

        console.log(stats.toString({
            colors: true,
            //chunks: false,
            stats: 'minimal',
        }));
        resolve();
    }))
};

const buildDev = series(/*runWebpack, */watchScss);

module.exports = {
    'build:dev': buildDev,
    scss: scss,
    watchScss: watchScss,
    webpack: runWebpack,
    default: buildDev,
};

