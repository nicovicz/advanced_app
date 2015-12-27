<?php
namespace backend\controllers;

use Yii;

use backend\models\AuthItem;
use common\components\RouterGenerator;
use backend\models\RouteSearch;
use yii\web\NotFoundHttpException;
class RouteController extends BackController
{
	
	public function actionIndex()
    {
        $searchModel = new RouteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
	public function actionCreate()
    {
		
        $model = new AuthItem();

        if (Yii::$app->request->isPost) {
          if ($model->load(Yii::$app->request->post()) && $model->validate()) {

              $auth = Yii::$app->authManager;
              $permission = $auth->createPermission($model->name);
              $permission->description = $model->description;
              $auth->add($permission);
              Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data route has been successfully saved'));
              return $this->redirect(['create']);
          } else {
             Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data route failed to save'));;
          }
        }

     
       
        return $this->render('create', [
            'model' => $model,
         
           
        ]);

    }
    
    public function actionUpdate($id)
    {
		
        $model = $this->findModel($id);
		$oldPermission = $model->name;
        if (Yii::$app->request->isPost) {
          if ($model->load(Yii::$app->request->post()) && $model->validate()) {

              $auth = Yii::$app->authManager;
              $permission = $auth->createPermission($model->name);
			  $permission->description = $model->description;
              $auth->update($oldPermission,$permission);
              Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data route has been successfully updated'));
              return $this->redirect(['update', 'id'=>$model->name]);
          } else {
             Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data route failed to updated'));;
          }
        }

     
       
        return $this->render('update', [
            'model' => $model,
         
           
        ]);

    }
    
    public function actionRegister()
    {
		
        $model = new AuthItem();

        if (Yii::$app->request->isPost) {
		
		  $routes = Yii::$app->request->post('routes');
          if (!empty($routes) && is_array($routes)) {
			  $auth = Yii::$app->authManager;
			  foreach($routes as $route){
				  
				  $oldPermission = $auth->getPermission($route);
				  
				  if (empty($oldPermission)) {
					  $role = $auth->createPermission($route);
					  $auth->add($role);
				  }
				  
			  }
              Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data route(s) has been successfully saved'));
              return $this->redirect(['register']);
          } else {
             Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data route(s) failed to save'));
          }
        }

        $routers = RouterGenerator::run();
        ksort($routers);	
       
        $registeredRouters = AuthItem::find()
			->where(['like','name','/'])
			->andWhere(['type'=>2])->all();
			
        return $this->render('create-existing', [
            'model' => $model,
            'routers' => $routers,
            'registeredRouters' => $registeredRouters
        ]);

    }
    
    public function actionDelete($id)
    {
        $auth = Yii::$app->authManager;
		$permission = $auth->getPermission($id);
		
		if (!empty($permission)){
			$auth->remove($permission);
			Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data route has been successfully deleted'));
			return $this->redirect(['index']);
		}else{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
		
        
    }
    
    protected function findModel($id)
    {	
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
