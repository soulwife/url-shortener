var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('web/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .autoProvidejQuery()
    .enableSassLoader(function(sassOptions) {}, {
        resolveUrlLoader: false
    })
    .enableVersioning(false)
    // show OS notifications when builds finish/fail
    .enableBuildNotifications()
    .createSharedEntry('vendor', ['jquery', 'jquery-ui', 'bootstrap'])
    .addEntry('js/app', './assets/js/app.js')
    .addStyleEntry('css/app', ['./assets/css/app.scss'])
;

module.exports = Encore.getWebpackConfig();