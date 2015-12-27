<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Company;
use frontend\models\CompanySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use frontend\models\Provinsi;
use frontend\models\Kabupaten;
use frontend\models\Kecamatan;
use yii\helpers\ArrayHelper;
use yii\base\Model;
/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends FrontController
{
    

    /**
     * Lists all Company models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Company();
		$modelProvinsi = new Provinsi(['scenario'=>'DepDrop']);
		$modelKabupaten = new Kabupaten(['scenario'=>'DepDrop']);
		$modelKecamatan = new Kecamatan(['scenario'=>'DepDrop']);
		
        if (Yii::$app->request->isPost) {
			
			$model->load(Yii::$app->request->post());
			
			$modelProvinsi->load(Yii::$app->request->post());
			$modelKabupaten->load(Yii::$app->request->post());
			$modelKecamatan->load(Yii::$app->request->post());
			if (Model::validateMultiple([$model,$modelProvinsi, $modelKabupaten]) && $model->save()) {
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data company has been successfully saved'));
				return $this->redirect(['create']);
			} else {
				Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data company failed to save'));
			}
		}
        
        return $this->render('create', [
                'model' => $model,
                'modelProvinsi' => $modelProvinsi,
                'modelKabupaten'=> $modelKabupaten,
                'modelKecamatan' => $modelKecamatan
            ]);
    }

    /**
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $id_prov = ArrayHelper::getValue($model,'kelurahan.kecamatan.kabupaten.id_prov');
        $modelProvinsi = $this->findModelProvinsi($id_prov);
		$modelProvinsi->scenario = 'DepDrop';
		
		$modelKabupaten = new Kabupaten(['scenario'=>'DepDrop']);
		$modelKecamatan = new Kecamatan(['scenario'=>'DepDrop']);
		
        if (Yii::$app->request->isPost) {
			
			$model->load(Yii::$app->request->post());
			
			$modelProvinsi->load(Yii::$app->request->post());
			$modelKabupaten->load(Yii::$app->request->post());
			$modelKecamatan->load(Yii::$app->request->post());
			if (Model::validateMultiple([$model,$modelProvinsi, $modelKabupaten]) && $model->save()) {
				Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data company has been successfully updated'));
				return $this->redirect(['update', 'id' => $model->id]);
			} else {
				Yii::$app->getSession()->setFlash('error', Yii::t('app', 'Your data company failed to updated'));
			}
		}
        
        return $this->render('update', [
                'model' => $model,
                'modelProvinsi' => $modelProvinsi,
                'modelKabupaten'=> $modelKabupaten,
                'modelKecamatan' => $modelKecamatan
            ]);
    }

    /**
     * Deletes an existing Company model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
		Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Your data company has been successfully deleted'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne($id)) !== null) {
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
