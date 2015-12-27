<?php
namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Kabupaten;
use frontend\models\Kecamatan;
use frontend\models\Kelurahan;
use yii\helpers\Json;

class ApiController extends FrontController
{
	
	public function actionKabupaten()
	{
	  $id_prov = $_POST['depdrop_parents'][0];
	  $selected = null;
	  if (!empty($_POST['depdrop_params'])){
		$selected = $_POST['depdrop_params'][0];
		
	  }
	  
      $model = Kabupaten::find()->where(['id_prov'=>$id_prov])->all();
      $data = [];
      foreach($model as $item){
        $data[] = ['id'=>$item->id_kab, 'name'=>$item->nama];
      }
      echo Json::encode(['output'=>$data, 'selected'=>$selected]);
	}
	
	public function actionKecamatan()
	{
	  $id_kab = $_POST['depdrop_parents'][0];
	  $selected = null;
	  if (!empty($_POST['depdrop_params'])){
		$selected = $_POST['depdrop_params'][0];
		
	  }
	  
      $model = Kecamatan::find()->where(['id_kab'=>$id_kab])->all();
      $data = [];
      foreach($model as $item){
        $data[] = ['id'=>$item->id_kec, 'name'=>$item->nama];
      }
      echo Json::encode(['output'=>$data, 'selected'=>$selected]);
	}
	
	public function actionKelurahan()
	{
	  $id_kec = $_POST['depdrop_parents'][0];
	  $selected = null;
	  if (!empty($_POST['depdrop_params'])){
		$selected = $_POST['depdrop_params'][0];
		
	  }
	  
      $model = Kelurahan::find()->where(['id_kec'=>$id_kec])->all();
      $data = [];
      foreach($model as $item){
        $data[] = ['id'=>$item->id_kel, 'name'=>$item->nama];
      }
      echo Json::encode(['output'=>$data, 'selected'=>$selected]);
	}
}
