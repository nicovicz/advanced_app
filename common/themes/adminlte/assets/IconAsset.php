<?php
namespace common\themes\adminlte\assets;

use yii\web\AssetBundle;

class IconAsset extends AssetBundle
{
	public $sourcePath = '@bower';
	public $baseUrl = '@web';
	
	public $css = [
		YII_DEBUG?'font-awesome/css/font-awesome.css':'font-awesome/css/font-awesome.min.css',
		YII_DEBUG?'Ionicons/css/ionicons.css':'Ionicons/css/ionicons.min.css'
	];
	
	
	
	
}
