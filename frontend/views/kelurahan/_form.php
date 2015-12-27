<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\models\Provinsi;

use kartik\depdrop\DepDrop;
/* @var $this yii\web\View */
/* @var $model frontend\models\Kelurahan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kelurahan-form">

    <?php $form = ActiveForm::begin([
		'validateOnBlur' => false,
		'validateOnChange' => false
    ]); ?>
	
	
	<?php $provinsi = ArrayHelper::map(Provinsi::find()->orderBy(['nama'=>SORT_ASC])->all(), 'id_prov', 'nama')?>
	
    <?= $form->field($modelProvinsi, 'id_prov')->label('Provinsi Name')->dropDownList($provinsi, ['prompt'=>'Pilih']) ?>
    
    
    <?php if (!$model->isNewRecord): ?>
	<?php echo Html::hiddenInput('id_kab', $model->kecamatan->id_kab, ['id'=>'id_kab']); ?>
	<?php echo Html::hiddenInput('id_kec', $model->id_kec, ['id'=>'id_kec']); ?>
	<?php endif; ?>
	
    <?= $form->field($modelKabupaten, 'id_kab')->label('Kabupaten Name')->widget(DepDrop::classname(), [
		 'pluginOptions'=>[
			 'depends'=>['provinsi-id_prov'],
			 'placeholder' => 'Pilih',
			 'initialize' => true,
			 'params' => ['id_kab'],
			 'url' => Url::to(['/api/kabupaten'])
		 ]
	]); ?>

    <?= $form->field($model, 'id_kec')->label('Kecamatan Name')->widget(DepDrop::classname(), [
		 'pluginOptions'=>[
			 'depends'=>['kabupaten-id_kab'],
			 'placeholder' => 'Pilih',
			 'params' => ['id_kec'],
			 'url' => Url::to(['/api/kecamatan'])
		 ]
	]); ?>

    <?= $form->field($model, 'nama')->label('Kelurahan Name')->textInput(['maxlength' => true]) ?>

     <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-flat btn-lg' : 'btn btn-primary btn-flat btn-lg']) ?>
		<?= Html::resetButton('Cancel', ['class'=>'btn btn-default btn-flat btn-lg']) ?>
		<?= Html::a('Back',['index'], ['class'=>'btn btn-warning btn-flat btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
