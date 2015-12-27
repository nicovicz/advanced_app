<?php
namespace common\themes\adminlte\assets;

use yii\web\AssetBundle;

class CompabilityAsset extends AssetBundle
{
	public $sourcePath = '@bower';
	public $baseUrl = '@web';
	
	public $js  = [
		YII_DEBUG?'html5shiv/dist/html5shiv.js':'html5shiv/dist/html5shiv.min.js',
		YII_DEBUG?'respond/dest/respond.src.js':'respond/dest/respond.min.js',
	];
	
	public $jsOptions = [
		'condition' => 'lt IE9',
	];
	
	
}
