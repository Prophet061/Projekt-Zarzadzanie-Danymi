<?php
namespace app\assets;
use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      'css/bootstrap.css',
      'css/site.css',
    ];
    public $js = [
      'js/jquery.js',
      'js/bootstrap.js',
      'js/popper.js',
      'js/mask.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
