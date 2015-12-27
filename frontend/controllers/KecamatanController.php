<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Provinsi;
use frontend\models\Kecamatan;
use frontend\models\KecamatanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use yii\base\Model;
/**
 * KecamatanController implements the CRUD actions for Kecamatan model.
 */
class KecamatanController extends FrontController
{
    

    /**
     * Lists all Kecamatan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KecamatanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kecamatan model.
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
     * Creates a new Kecamatan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kecamatan();
		$modelProvinsi = new Provinsi(['scenario'=>'DepDrop']);
		
		if (Yii::$app->request->isPost) {
			$model->load(Yii::$app->request->post());
			$modelProvinsi->load(Yii::$app->request->post());
			$model->autoNumber();
			if (Model::validateMultiple([$model, $modelProvinsi]) && $model->save()) {
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data kecamatan has been successfully saved'));
				return $this->redirect(['create']);
			} else {
			   Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data kecamatan failed to save'));
			}
		}
       
        
         return $this->render('create', [
                'model' => $model,
                'modelProvinsi' => $modelProvinsi
            ]);
    }

    /**
     * Updates an existing Kecamatan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$modelProvinsi = $this->findModelProvinsi($model->kabupaten->id_prov);
		$modelProvinsi->scenario  = 'DepDrop'; 
		if (Yii::$app->request->isPost) {
			
			$model->load(Yii::$app->request->post());
			$modelProvinsi->load(Yii::$app->request->post());
			
			if (Model::validateMultiple([$model, $modelProvinsi]) && $model->save()) {
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data kecamatan has been successfully updated'));
				return $this->redirect(['update', 'id' => $model->id_kec]);
			} else {
				Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data kecamatan failed to updated'));
			}
		}
        
        
        return $this->render('update', [
                'model' => $model,
                'modelProvinsi' => $modelProvinsi
         ]);
    }

    /**
     * Deletes an existing Kecamatan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data kecamatan has been successfully deleted'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the Kecamatan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Kecamatan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kecamatan::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    protected function findModelProvinsi($id)
    {
        if (($model = Provinsi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
