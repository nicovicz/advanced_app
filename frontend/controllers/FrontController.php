<?php
namespace frontend\controllers;

use yii\web\Controller;
use common\components\AccessControl;
use yii\filters\VerbFilter;
use Yii;

class FrontController extends Controller
{
	public $layout = '/front.php';
	
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
               
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'controllers' => ['site'],
                        'allow' => true,
                        
                    ],
                     [
                        'actions' => ['index', 'logout'],
                        'controllers' => ['site'],
                        'allow' => true,
                        'roles' => ['@'],
                        
                    ],
                   
                ],
            ],
             'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['post'],
                ],
            ],
           
        ];
    }
    
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
   
    
   
    
    
	

}
