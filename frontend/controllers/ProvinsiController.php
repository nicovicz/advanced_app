<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Provinsi;
use frontend\models\ProvinsiSearch;
use yii\web\NotFoundHttpException;


/**
 * ProvinsiController implements the CRUD actions for Provinsi model.
 */
class ProvinsiController extends FrontController
{
    

    /**
     * Lists all Provinsi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProvinsiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Provinsi model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Provinsi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Provinsi();
        
		if (Yii::$app->request->isPost) {
			$model->autoNumber();
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data provinsi has been successfully saved'));
				return $this->redirect(['create']);
				
			} else {
			    Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data provinsi failed to save'));
			}
		}
        
		
         return $this->render('create', [
                'model' => $model,
            ]);
    }

    /**
     * Updates an existing Provinsi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		if (Yii::$app->request->isPost) {
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data provinsi has been successfully updated'));
				return $this->redirect(['update', 'id' => $model->id_prov]);
			} else {
			   Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data provinsi failed to updated'));

			}
		}
       
        
         return $this->render('update', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing Provinsi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data provinsi has been successfully deleted'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the Provinsi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Provinsi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Provinsi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
