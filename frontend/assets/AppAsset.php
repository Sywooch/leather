<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        // 'css/site.css',
        
        'theme/snow/dist/assets/bower_components/bootstrap/dist/css/bootstrap.min.css',
        'theme/snow/dist/assets/bower_components/fontawesome/css/font-awesome.min.css',
        'theme/snow/dist/assets/bower_components/pixeden-stroke-7-icon/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css',
        'theme/snow/dist/assets/bower_components/flickity/dist/flickity.min.css',
        'theme/snow/dist/assets/bower_components/photoswipe/dist/photoswipe.css',
        'theme/snow/dist/assets/bower_components/photoswipe/dist/default-skin/default-skin.css',
        'theme/snow/dist/assets/bower_components/prism/themes/prism-tomorrow.css',
        'theme/snow/dist/assets/css/snow.css',
        'theme/snow/dist/assets/css/custom.css',
    ];
    public $js = [
        'theme/snow/dist/assets/bower_components/gsap/src/minified/TweenMax.min.js',
        'theme/snow/dist/assets/bower_components/gsap/src/minified/plugins/ScrollToPlugin.min.js',
        'theme/snow/dist/assets/bower_components/tether/dist/js/tether.min.js',
        'theme/snow/dist/assets/plugins/nk-share/nk-share.js',
        'theme/snow/dist/assets/bower_components/sticky-kit/dist/sticky-kit.min.js',
        'theme/snow/dist/assets/bower_components/jarallax/dist/jarallax.min.js',
        'theme/snow/dist/assets/bower_components/flickity/dist/flickity.pkgd.min.js',
        'theme/snow/dist/assets/bower_components/isotope/dist/isotope.pkgd.min.js',
        'theme/snow/dist/assets/bower_components/photoswipe/dist/photoswipe.min.js',
        'theme/snow/dist/assets/bower_components/photoswipe/dist/photoswipe-ui-default.min.js',
        'theme/snow/dist/assets/bower_components/jquery-form/dist/jquery.form.min.js',
        'theme/snow/dist/assets/bower_components/jquery-validation/dist/jquery.validate.min.js',
        'theme/snow/dist/assets/bower_components/hammer.js/hammer.min.js',
        'theme/snow/dist/assets/bower_components/social-likes/dist/social-likes.min.js',
        'theme/snow/dist/assets/bower_components/nanoscroller/bin/javascripts/jquery.nanoscroller.min.js',
        'theme/snow/dist/assets/bower_components/keymaster/keymaster.js',
        'theme/snow/dist/assets/bower_components/prism/prism.js',
        // 'theme/snow/dist/assets/js/snow.min.js',
        'theme/snow/dist/assets/js/snow.js',
        'theme/snow/dist/assets/js/snow-init.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];
}
