const mix = require('laravel-mix');

/*
|--------------------------------------------------------------------------
| Mix Asset Management
|--------------------------------------------------------------------------
|
| Mix provides a clean, fluent API for defining some Webpack build steps
| for your Laravel application. By default, we are compiling the Sass
| file for the application as well as bundling up all the JS files.
|
 */

mix.setPublicPath('public/')
    .js('resources/js/app.js', '')
    // .sass('resources/sass/app.scss', 'public/css')
    .less('resources/less/app.less', 'css').webpackConfig({
        output: {
            // publicPath: '/',
            // filename: 'js/[name].js',
            chunkFilename: 'js/[name].chunk.js'
            // chunkFilename: 'js/[name].chunk.js?id=[chunkhash:20]'
        },
        module: {
            rules: [{
                test: /\.less?$/,
                use: [{
                    loader: 'less-loader',
                    options: {
                        javascriptEnabled: true
                    }
                }]
            },
            {
                test: /\.jsx?$/,
                exclude: /node_modules(?!\/ant-design-vue)/,
                use: [{
                    loader: 'babel-loader',
                    options: Config.babel()
                }]
            },
            ]
        },
        resolve: {
            alias: {
                '@': path.resolve('resources/js')
            }
        }
    })
    .extract(['vue', 'ant-design-vue', 'vuex'])
    .browserSync('www.myadmin.com')
    .version([]);
