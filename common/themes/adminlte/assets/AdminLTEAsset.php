<?php
namespace common\themes\adminlte\assets;

use yii\web\AssetBundle;

class AdminLTEAsset extends AssetBundle
{
	public $sourcePath = '@common/themes/adminlte/dist';
	public $baseUrl = '@web';
	
	
	public $css = [
		YII_DEBUG?'css/AdminLTE.css':'css/AdminLTE.min.css',
		YII_DEBUG?'css/skins/_all-skins.css':'css/skins/_all-skins.min.css',
	];
	
	public $js  = [
		YII_DEBUG?'js/app.js':'js/app.min.js',
	];
	
	public $depends = [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',	         
		'yii\bootstrap\BootstrapPluginAsset',
		'common\themes\adminlte\assets\CompabilityAsset',
		'common\themes\adminlte\assets\IconAsset'
	];
	
	
}
