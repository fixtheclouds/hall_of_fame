<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class StaticPageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/tilda-blocks.css',
        'css/tilda-grid.min.css',
        'css/static.css'
    ];

    public $js = [
        'js/lazyload.min.js',
        'js/analytics.js',
        'js/tilda-scripts.min.js',
        'js/tilda-blocks.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
