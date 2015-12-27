<?php
namespace backend\controllers;

use Yii;

use backend\models\UserSearch;
use backend\models\Register;
class AssignmentController extends BackController
{
	
	
	public function actionIndex()
    {
		
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
	
		

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
	public function actionCreate()
    {
        $model = new Register();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
				
				$otherPermission = Yii::$app->request->post('otherpermission');
			    $otherRole = Yii::$app->request->post('otherrole');
			    
				$auth = Yii::$app->authManager;
                 if (!empty($otherPermission) && is_array($otherPermission)){
				  foreach($otherPermission as $permission){
					$child_permission = $auth->getPermission($permission);
					
					if (!empty($child_permission)){
						
						$auth->assign($child_permission, $user->id);
					}
					  
				  }
			  }
			  
			  if (!empty($otherRole) && is_array($otherRole)){
				  foreach($otherRole as $therole){
					$child_role = $auth->getRole($therole);
					
					if (!empty($child_role)){
						
						$auth->assign($child_role,$user->id);
					}
					  
				  }
			  }
			  
			  Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your user has been successfully created'));
              return $this->redirect(['create']);
            }else{
				Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your user failed to created'));;
			}
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionUpdate($id)
    {
		
        $model = $this->findModel($id);

        
		if (Yii::$app->request->isPost) {
          if ($model->load(Yii::$app->request->post())) {

			  if ($user=$model->change()){
				  $otherPermission = Yii::$app->request->post('otherpermission');
				  $otherRole = Yii::$app->request->post('otherrole');
				
				  $auth = Yii::$app->authManager;
				  $auth->revokeAll($user->id);
				  if (!empty($otherPermission) && is_array($otherPermission)){
					  foreach($otherPermission as $permission){
						$child_permission = $auth->getPermission($permission);
						
						if (!empty($child_permission)){
							
							$auth->assign($child_permission, $user->id);
						}
						  
					  }
				  }
			  
				  if (!empty($otherRole) && is_array($otherRole)){
					  foreach($otherRole as $therole){
						$child_role = $auth->getRole($therole);
						
						if (!empty($child_role)){
							
							$auth->assign($child_role,$user->id);
						}
						  
					  }
				  }
			  }
			  
			  
              Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data user has been successfully updated'));
              return $this->redirect(['update', 'id'=>$id]);
          } else {
             Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data user failed to updated'));;
          }
        }

     
        //$auth = Yii::$app->authManager;
        return $this->render('update', [
            'model' => $model,
			//'childrenPermission' => $auth->getChildren($model->name)
           
        ]);

    }
    
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $auth = Yii::$app->authManager;
        $auth->revokeAll($id);
		Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your user has been successfully deleted'));
		return $this->redirect(['index']);
        
    }
    
    protected function findModel($id)
    {	
        if (($model = Register::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
}
