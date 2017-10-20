/**
 * Require Browsersync along with webpack and middleware for it
 */
require("react-hot-loader/patch");
const browserSync = require('browser-sync').create();
const webpack = require('webpack');
const webpackDevMiddleware = require('webpack-dev-middleware');
const webpackHotMiddleware = require('webpack-hot-middleware');
const Path = require('path');


/**
 * Require ./webpack.config.js and make a bundler from it
 */
var webpackConfig = require('./webpack.config');
var bundler = webpack(webpackConfig);

var LOCAL_HOST = "http://localhost:8080";

const path = require('path');
var ROOT_PATH = path.resolve(__dirname);

/**
* Run Browsersync and use middleware for Hot Module Replacement
*/
browserSync.init({

   proxy: {
     target: LOCAL_HOST,
     ws: true,
     middleware: [

       webpackDevMiddleware(bundler, {
         hot: true,
         reload: true,
         publicPath: webpackConfig.output.publicPath,
         contentBase: Path.join(__dirname, 'public/'),
         stats: { colors: true, chunks: false },
         historyApiFallback: true,
         quiet: false,
         noInfo: false,
         watchOptions: {
           aggregateTimeout: 300,
           poll: 50,
         },
         headers: { "Access-Control-Allow-Origin": "*" }

         // for other settings see
         // http://webpack.github.io/docs/webpack-dev-middleware.html
       }),

       // bundler should be the same as above
       webpackHotMiddleware(bundler, {
         overlay: true,
         autoConnect: true
       })
     ]
   },

   // no need to watch '*.js' here, webpack will take care of it for us,
   // including full page reloads if HMR won't work
   files: [
     './public/**.html',
     './public/**.php',
     '.public/css/**.css'
   ]
});