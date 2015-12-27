<?php
namespace backend\controllers;

use Yii;

use backend\models\AuthItem;

use yii\web\NotFoundHttpException;

class ApiController extends BackController
{
	public function actionPermission()
	{
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$q = Yii::$app->request->get('q');
		
        $permissions = AuthItem::find()->where(['LIKE', 'name', $q])
			->andWhere(['type'=>2])->all();
        $data = [];
        
        if (!empty($permissions)){
			foreach($permissions as $permission){
			  $data[] = ['id'=>$permission->name, 'text'=> $permission->name];	
			}
		}
		
		$out = [];
		$out['results'] = $data;
		
		return $out;
	}
	
	public function actionRole()
	{
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$q = Yii::$app->request->get('q');
		
        $roles = AuthItem::find()->where(['LIKE', 'name', $q])
			->andWhere(['type'=>1])->all();
        $data = [];
        
        if (!empty($roles)){
			foreach($roles as $role){
			  $data[] = ['id'=>$role->name, 'text'=> $role->name];	
			}
		}
		
		$out = [];
		$out['results'] = $data;
		
		return $out;
	}
	
}
