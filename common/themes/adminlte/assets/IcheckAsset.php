<?php
namespace common\themes\adminlte\assets;

use yii\web\AssetBundle;

class IcheckAsset extends AssetBundle
{
	public $sourcePath = '@common/themes/adminlte/plugins';
	public $baseUrl = '@web';
	
	
	public $css = [
		'iCheck/all.css',
		
	];
	
	public $js  = [
		YII_DEBUG?'iCheck/icheck.js':'iCheck/icheck.min.js',
	];
	
	public $depends = [
		'common\themes\adminlte\assets\AdminLTEAsset',
		
	];
	
	
}
