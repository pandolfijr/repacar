let mix = require("laravel-mix");
const { VueLoaderPlugin } = require("vue-loader");

mix.webpackConfig({
    watchOptions: {
        ignored: /node_modules/,
        poll: 1000,
    },
});

mix.options({
    processCssUrls: false,
    terser: {
        extractComments: false,
    },
});

mix.js("resources/assets/js/app.js", "public/js")
    .sass("resources/sass/login.scss", "public/css")
    .sass("resources/assets/sass/app.scss", "public/css")
    .vue()
    .version();
