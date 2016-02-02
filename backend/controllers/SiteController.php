<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;

use common\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends BackController
{
	
   

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
		$this->layout = '/login-backend.php';
		
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
