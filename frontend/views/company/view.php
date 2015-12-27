<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="box box-success box-solid">
	<div class="box-header with-border">
		<big>About <?= Html::encode($this->title) ?></big>
    </div>
    <div class="provinsi-index box-body">

  
    <strong><?=$model->getAttributeLabel('name')?></strong>
    <p class="text-mutd"><?=ArrayHelper::getValue($model,'name')?></p>
	<hr/>
	
	<strong><?=$model->getAttributeLabel('email')?></strong>
    <p class="text-mutd"><?=ArrayHelper::getValue($model,'email')?></p>
	<hr/>
	
	<strong><?=$model->getAttributeLabel('phone')?></strong>
    <p class="text-mutd"><?=ArrayHelper::getValue($model,'phone')?></p>
	<hr/>
	
	<strong><?=$model->getAttributeLabel('address')?></strong>
    <p class="text-mutd"><?=ArrayHelper::getValue($model,'address')?></p>
	<hr/>
	
	<strong><?=$model->getAttributeLabel('kelurahan.kecamatan.kabupaten.provinsi.nama')?></strong>
	<p class="text-mutd"><?=ArrayHelper::getValue($model,'kelurahan.kecamatan.kabupaten.provinsi.nama')?></p>
    <hr/>
	
	<strong><?=$model->getAttributeLabel('kelurahan.kecamatan.kabupaten.nama')?></strong>
	<p class="text-mutd"><?=ArrayHelper::getValue($model,'kelurahan.kecamatan.kabupaten.nama')?></p>
    <hr/>
    
    <strong><?=$model->getAttributeLabel('kelurahan.kecamatan.nama')?></strong>
	<p class="text-mutd"><?=ArrayHelper::getValue($model,'kelurahan.kecamatan.nama')?></p>
    <hr/>
	
	<strong><?=$model->getAttributeLabel('kelurahan.nama')?></strong>
	<p class="text-mutd"><?=ArrayHelper::getValue($model,'kelurahan.nama')?></p>
    <hr/>
    
     <div class="form-group">
       
		<?= Html::a('Back',['index'], ['class'=>'btn btn-warning btn-flat btn-lg']) ?>
    </div>
	
</div>
</div>
