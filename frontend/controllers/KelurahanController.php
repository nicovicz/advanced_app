<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Kelurahan;
use frontend\models\KelurahanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use frontend\models\Provinsi;
use frontend\models\Kabupaten;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * KelurahanController implements the CRUD actions for Kelurahan model.
 */
class KelurahanController extends FrontController
{
    

    /**
     * Lists all Kelurahan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KelurahanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kelurahan model.
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
     * Creates a new Kelurahan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kelurahan();
		$modelProvinsi = new Provinsi(['scenario'=>'DepDrop']);
		$modelKabupaten = new Kabupaten(['scenario'=>'DepDrop']);
		
		
		if (Yii::$app->request->isPost) {
			
			$model->load(Yii::$app->request->post());
			$model->autoNumber();
			$modelProvinsi->load(Yii::$app->request->post());
			$modelKabupaten->load(Yii::$app->request->post());
			
			if (Model::validateMultiple([$model,$modelProvinsi, $modelKabupaten]) && $model->save()) {
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data kelurahan has been successfully saved'));
				return $this->redirect(['create']);
			} else {
				Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data kelurahan failed to save'));
			}
		}
       
        
        return $this->render('create', [
                'model' => $model,
                'modelProvinsi' => $modelProvinsi,
                'modelKabupaten'=> $modelKabupaten,
            ]);
    }

    /**
     * Updates an existing Kelurahan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$id_prov = ArrayHelper::getValue($model,'kecamatan.kabupaten.id_prov');
		
		
		$modelProvinsi = $this->findModelProvinsi($id_prov);
		$modelProvinsi->scenario = 'DepDrop';
		
		$modelKabupaten = new Kabupaten(['scenario'=>'DepDrop']);
		
		if (Yii::$app->request->isPost) {
			$model->load(Yii::$app->request->post());
			$modelProvinsi->load(Yii::$app->request->post());
			$modelKabupaten->load(Yii::$app->request->post());
			
			if (Model::validateMultiple([$model, $modelProvinsi, $modelKabupaten]) && $model->save()) {
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data kelurahan has been successfully updated'));
				return $this->redirect(['update', 'id' => $model->id_kel]);
			} else {
				Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data kelurahan failed to updated'));
			}
		}
       
        
        return $this->render('update', [
                'model' => $model,
                'modelProvinsi' => $modelProvinsi,
                'modelKabupaten'=>$modelKabupaten
            ]);
    }

    /**
     * Deletes an existing Kelurahan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data kelurahan has been successfully deleted'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the Kelurahan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Kelurahan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kelurahan::findOne($id)) !== null) {
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
