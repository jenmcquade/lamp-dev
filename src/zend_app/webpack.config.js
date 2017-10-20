const path = require('path');
const merge = require('webpack-merge');
const Webpack = require('webpack');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const HtmlWebpackPlugin = require('html-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

var node_dir = __dirname + '/node_modules';
const TARGET = process.env.npm_lifecycle_event;
const ROOT_PATH = path.resolve(__dirname);
const PUBLIC_PATH = path.join(ROOT_PATH, 'public/');


var common = {
  entry: { 
    app: [
      
    ]      
  },      
  output: {
    path: path.resolve('public/js'),
    filename: 'bundle.js',
    publicPath: '/js/'
  },
  plugins: [
    //new Webpack.NoEmitOnErrorsPlugin(),
    new Webpack.ProvidePlugin({
      $: 'jquery',
      jQuery: 'jquery',
      'window.jQuery': 'jquery',
      Popper: ['popper.js', 'default'],
      // In case you imported plugins individually, you must also require them here:
      Util: "exports-loader?Util!bootstrap/js/dist/util",
      Dropdown: "exports-loader?Dropdown!bootstrap/js/dist/dropdown"
    }),
  ]
}

if (TARGET === 'start') {
  module.exports = merge(common, {
    devtool: "eval-source-map",
    entry: {
      app: [
        'react-hot-loader/patch',
        'webpack-hot-middleware/client',
        'webpack/hot/only-dev-server',
        './module/Application/view/application/index/react-app'
      ]
    },

    plugins: [
      new Webpack.optimize.OccurrenceOrderPlugin(),
      new Webpack.HotModuleReplacementPlugin(),
      new Webpack.NamedModulesPlugin(),
      new Webpack.NoEmitOnErrorsPlugin(),
      new ExtractTextPlugin({ filename: "../css/[name].css", allChunks: true}),
    ],

    module: {
      loaders: [
        { 
          test: /\.js$/, 
          loaders: ['babel-loader'], 
          exclude: /node_modules/
        },
        { test: /\.jsx$/, loaders: ['babel-loader'], exclude: /node_modules/ },
        {
          test: /\.css$/,
          use: ExtractTextPlugin.extract({
            use: "css-loader"
          })
        },
        { test: /\.inline.svg$/, loader: "babel-loader!svg-react-loader" },
        {
          test: /\.jpe?g$|\.gif$|\.png$|^(?!.*\.inline\.svg$).*\.svg$/,
          loader: 'url-loader'
        },
        {
          test: /\.(eot|svg|ttf|woff|woff2)$/,
          loader: 'file-loader?name=/css/fonts/[name].[ext]'
      }
      ]
    },

  });
} else if (TARGET === 'build') {
  module.exports = merge(common, {
    entry: {
      app: [
        './module/Application/view/application/index/react-app/index.js',
        './module/Application/view/application/index/react-app/App.js',
        './module/Application/view/application/index/react-app/ui-forms.js' 
      ]
    },
    module: {
      loaders: [
        { test: /\.js$/, loaders: ['babel-loader'], include: path.join('./module/Application/view/application/index/react-app'), exclude: /node_modules/ },
        { test: /\.jsx$/, loaders: ['babel-loader'], exclude: /node_modules/ },
        {
          test: /\.css$/,
          use: ExtractTextPlugin.extract({
            use: "css-loader"
          })
        },
        { test: /\.inline.svg$/, loader: "babel-loader!svg-react-loader" },
        {
          test: /\.jpe?g$|\.gif$|\.png$|^(?!.*\.inline\.svg$).*\.svg$/,
          loader: 'url-loader'
        },
        {
          test: /\.(eot|svg|ttf|woff|woff2)$/,
          loader: 'file-loader?name=/css/fonts/[name].[ext]'
      }
      ]
    },
    plugins: [
      new Webpack.optimize.OccurrenceOrderPlugin(),
      new ExtractTextPlugin({ filename: "./../css/[name].css", allChunks: true}),
    ],
  });
} else {
  module.exports = {
    entry: { 
      app: [
        'webpack/hot/dev-server', 
        'webpack-hot-middleware/client?path=http://localhost:3000/__webpack_hmr',
        './module/Application/view/application/index/react-app'
      ]      
    },      
    output: {
      path: path.resolve('public/js'),
      filename: 'bundle.js',
      publicPath: '/js/'
    },
    plugins: [
      //new Webpack.NoEmitOnErrorsPlugin(),
      new Webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
        'window.jQuery': 'jquery',
        Popper: ['popper.js', 'default'],
        // In case you imported plugins individually, you must also require them here:
        Util: "exports-loader?Util!bootstrap/js/dist/util",
        Dropdown: "exports-loader?Dropdown!bootstrap/js/dist/dropdown"
      }),
      new ExtractTextPlugin({ filename: "../css/[name].css", allChunks: true}),
      new Webpack.optimize.OccurrenceOrderPlugin(),
      new Webpack.HotModuleReplacementPlugin(),
      new Webpack.NoEmitOnErrorsPlugin(),
    ],
    module: {
      loaders: [
        { test: /\.js$/, loaders: ['babel-loader'], exclude: /node_modules/ },
        { test: /\.jsx$/, loaders: ['babel-loader'], exclude: /node_modules/ },
        {
          test: /\.css$/,
          use: ExtractTextPlugin.extract({
            use: "css-loader"
          })
        },
        { test: /\.inline.svg$/, loader: "babel-loader!svg-react-loader" },
        {
          test: /\.jpe?g$|\.gif$|\.png$|^(?!.*\.inline\.svg$).*\.svg$/,
          loader: 'url-loader'
        },
        {
          test: /\.(eot|svg|ttf|woff|woff2)$/,
          loader: 'file-loader?name=/css/fonts/[name].[ext]'
      }
      ]
    }
  }
}


