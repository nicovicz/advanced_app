<?php
namespace backend\controllers;

use Yii;

use backend\models\AuthItem;

use backend\models\RoleSearch;
use yii\web\NotFoundHttpException;

class RoleController extends BackController
{
	
	public function actionIndex()
    {
		
        $searchModel = new RoleSearch();
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

			  $otherPermission = Yii::$app->request->post('otherpermission');
			  $otherRole = Yii::$app->request->post('otherrole');
			  
              $auth = Yii::$app->authManager;
              $role = $auth->createRole($model->name);
              $role->description = $model->description;
              $auth->add($role);
              
              if (!empty($otherPermission) && is_array($otherPermission)){
				  foreach($otherPermission as $permission){
					$child_permission = $auth->getPermission($permission);
					
					if (!empty($child_permission)){
						
						$auth->addChild($role,$child_permission);
					}
					  
				  }
			  }
			  
			  if (!empty($otherRole) && is_array($otherRole)){
				  foreach($otherRole as $therole){
					$child_role = $auth->getRole($therole);
					
					if (!empty($child_role)){
						
						$auth->addChild($role,$child_role);
					}
					  
				  }
			  }
			  
              Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data role has been successfully saved'));
              return $this->redirect(['create']);
          } else {
             Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data role failed to save'));
          }
        }

     
       
        return $this->render('create', [
            'model' => $model,
			
           
        ]);

    }
    
    public function actionUpdate($id)
    {
		
        $model = $this->findModel($id);
        $oldRole = $model->name;
        
		if (Yii::$app->request->isPost) {
          if ($model->load(Yii::$app->request->post()) && $model->validate()) {

			  $otherPermission = Yii::$app->request->post('otherpermission');
			  $otherRole = Yii::$app->request->post('otherrole');
			  
              $auth = Yii::$app->authManager;
              $role = $auth->createRole($model->name);
              $role->description = $model->description;
              $auth->update($oldRole, $role);
              $auth->removeChildren($role);
              
              if (!empty($otherPermission) && is_array($otherPermission)){
				  foreach($otherPermission as $permission){
					$child_permission = $auth->getPermission($permission);
					
					if (!empty($child_permission)){
						
						$auth->addChild($role,$child_permission);
					}
					  
				  }
			  }
			  
			  if (!empty($otherRole) && is_array($otherRole)){
				  foreach($otherRole as $therole){
					$child_role = $auth->getRole($therole);
					
					if (!empty($child_role)){
						
						$auth->addChild($role,$child_role);
					}
					  
				  }
			  }
			  
              Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data role has been successfully updated'));
              return $this->redirect(['update', 'id'=>$model->name]);
          } else {
             Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data role failed to updated'));;
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
		$role = $auth->getRole($id);
		
		if (!empty($role)){
			$auth->remove($role);
			Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data role has been successfully deleted'));
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
