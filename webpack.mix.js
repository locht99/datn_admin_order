const mix = require('laravel-mix');
const tailwindcss = require("tailwindcss");
// require('dotenv').config();

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass("resources/sass/app.scss", "public/css")
    .version()
    .options({
        processCssUrls: false,
        postCss: [tailwindcss("./tailwind.config.js")],
    });
mix.disableNotifications()

mix.webpackConfig(webpack => {
    return {
        plugins: [
            new webpack.EnvironmentPlugin (
                ['MY_ENVIRONMENT_VARIABLE','MY_ENVIRONMENT_VARIABLE2','VUE_APP_API_URL']
            )
        ]
    };
});