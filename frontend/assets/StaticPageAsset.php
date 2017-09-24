<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class StaticPageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/static.css'
    ];
}
