const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // Directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // Public path used by the web server to access the output path
    .setPublicPath('/build')
    // Only needed for CDN's or subdirectory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/app.js')  // Main entry point for your app.js
    .addEntry('langues', './assets/js/langues.js')  // Additional entry point for langues.js

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // Will require an extra script tag for runtime.js
    // But, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())  // Enable source maps only in non-production
    .enableVersioning(Encore.isProduction())  // Enable versioning for production builds

    // Correct Babel configuration:
.configureBabel((config) => {
    //config.presets.push('@babel/preset-env');  // Only push once.
    config.plugins.push('@babel/plugin-transform-runtime');
})

// You can also directly configure @babel/preset-env in the configureBabelPresetEnv
.configureBabelPresetEnv((config) => {
    config.useBuiltIns = 'usage';
    config.corejs = '3.36.0'; // Version compatible avec Bootstrap 5.3
  })


    // Enables Sass/SCSS support
    .enableSassLoader(options => {
        options.sassOptions = {
          quietDeps: true // Ignore les warnings de dépendances
        }
      })

    // Enables file copying for images and CSS
    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[ext]',
        pattern: /\.(png|jpg|jpeg)$/  // Match image file types
    })
    .copyFiles({
        from: './assets/css',
        to: 'css/[path][name].[ext]',  // Copy CSS files to the CSS directory
    })
    
    // Uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // Uncomment if you use React
    //.enableReactPreset()

    // Uncomment to get integrity="..." attributes on your script & link tags
    // Requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // Uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
