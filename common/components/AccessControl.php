<?php
namespace common\components;
use Yii;
use yii\web\ForbiddenHttpException;

class AccessControl extends \yii\filters\AccessControl
{
	public function beforeAction($action)
    {
        $user = $this->user;
        $request = Yii::$app->getRequest();
        /* @var $rule AccessRule */
        foreach ($this->rules as $rule) {
            if ($allow = $rule->allows($action, $user, $request)) {
                return true;
            } 
        }
       
        if (!Yii::$app->user->can('/'.$action->getUniqueId())){
			$this->denyAccess($user);
		}else{
			return true;
		}
        
        return false;
    }
}
