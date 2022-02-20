const Encore = require('@symfony/webpack-encore');

if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    // .setManifestKeyPrefix('isponsor')
    .addEntry('app', './asset/js/app.js')
    .addEntry('homepage', './asset/js/homepage.js')
    .addEntry('sign', './asset/js/sign.js')
    .addEntry('profile', './asset/js/profile.js')
    .addEntry('err404', './asset/js/err404.js')
    .splitEntryChunks()
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    //.enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .configureBabel(() => {
    }, {
        useBuiltIns: 'usage',
        corejs: 3
    })
    .enableSassLoader()
    //.enableTypeScriptLoader()
    //.enableIntegrityHashes(Encore.isProduction())
    .cleanupOutputBeforeBuild()
    // .autoProvidejQuery()
    // .autoProvideVariables()
    .enableReactPreset()
    .disableSingleRuntimeChunk()
;

module.exports = Encore.getWebpackConfig();
