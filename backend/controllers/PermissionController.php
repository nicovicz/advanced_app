<?php
namespace backend\controllers;

use Yii;

use backend\models\AuthItem;

use backend\models\PermissionSearch;
use yii\web\NotFoundHttpException;

class PermissionController extends BackController
{
	
	public function actionIndex()
    {
		
        $searchModel = new PermissionSearch();
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

			  $parents = Yii::$app->request->post('parent');
			  
              $auth = Yii::$app->authManager;
              $permission = $auth->createPermission($model->name);
              $permission->description = $model->description;
              $auth->add($permission);
              
              if (!empty($parents) && is_array($parents)){
				  foreach($parents as $parent){
					$child_permission = $auth->getPermission($parent);
					
					if (!empty($child_permission)){
						
						$auth->addChild($permission,$child_permission);
					}
					  
				  }
			  }
			  
              Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data permission has been successfully saved'));
              return $this->redirect(['create']);
          } else {
             Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data permission failed to save'));;
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

			  $parents = Yii::$app->request->post('parent');
			  
              $auth = Yii::$app->authManager;
              $permission = $auth->createPermission($model->name);
              $permission->description = $model->description;
              $auth->update($oldPermission, $permission);
              $auth->removeChildren($permission);
              if (!empty($parents) && is_array($parents)){
				  foreach($parents as $parent){
					$child_permission = $auth->getPermission($parent);
					
					if (!empty($child_permission)){
						//
						$auth->addChild($permission,$child_permission);
					}
					  
				  }
			  }
			  
              Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data permission has been successfully updated'));
              return $this->redirect(['update', 'id'=>$model->name]);
          } else {
             Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data permission failed to updated'));;
          }
        }

     
        $auth = Yii::$app->authManager;
        return $this->render('update', [
            'model' => $model,
			'childrenPermission' => $auth->getChildren($model->name)
           
        ]);

    }
    
   
    
    public function actionDelete($id)
    {
        $auth = Yii::$app->authManager;
		$permission = $auth->getPermission($id);
		
		if (!empty($permission)){
			$auth->remove($permission);
			Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data permission has been successfully deleted'));
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
