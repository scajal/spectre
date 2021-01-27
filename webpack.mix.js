const mix = require('laravel-mix');

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

mix
    /**
     * Javascript files.
     */
    .js('resources/js/app.js', 'public/js')

    /**
     * Extract vendor libraries to a custom file so the assets don't
     * need to be loaded again everytime we update our scripts.
     */
    .extract()

    /**
     * Copy app styles.
     */
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss')
    ])

    /**
     * Copy image directory.
     */
    .copyDirectory('resources/images', 'public/images')


    /**
     * Version our files for caching purposes.
     */
    .version();
