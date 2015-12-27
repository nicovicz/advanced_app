<?php
namespace common\components;
use Yii;
class Menu{

	public static function generateRoute()
	{
		$auth = Yii::$app->authManager;
		$permissions = $auth->getPermissionsByUser(Yii::$app->user->id);
		$route = [];
		
		if (!empty($permissions)){
			foreach($permissions as $permission){
				if (substr($permission->name,0,1) == '/' && substr($permission->name,0,4) != '/api'){
					$routeParts  = explode('/',$permission->name);
					
					if (!empty($routeParts[1])){
						$route[] = '/'.$routeParts[1];
					}
				}
			}
		}
		
		
		return array_unique($route);
	}
	
}
