<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Kabupaten;
use frontend\models\KabupatenSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * KabupatenController implements the CRUD actions for Kabupaten model.
 */
class KabupatenController extends FrontController
{
    

    /**
     * Lists all Kabupaten models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KabupatenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kabupaten model.
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
     * Creates a new Kabupaten model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kabupaten();
		if (Yii::$app->request->isPost) {
			$model->load(Yii::$app->request->post());
			$model->autoNumber();
			if ($model->validate() && $model->save()) {
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data kabupaten has been successfully saved'));
				return $this->redirect(['create']);
			} else {
				Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data kabupaten failed to save'));
			}
		}
        
        
        return $this->render('create', [
                'model' => $model,
            ]);
    }

    /**
     * Updates an existing Kabupaten model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		if (Yii::$app->request->isPost) {
			if ($model->load(Yii::$app->request->post()) && $model->save()) {
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data kabupaten has been successfully updated'));
				return $this->redirect(['update', 'id' => $model->id_kab]);
			} else {
				Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data kabupaten failed to save'));
			}
		}
        
        return $this->render('update', [
                'model' => $model,
            ]);
    }

    /**
     * Deletes an existing Kabupaten model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data kabupaten has been successfully deleted'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the Kabupaten model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Kabupaten the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kabupaten::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    

}
