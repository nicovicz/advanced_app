<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\models\Provinsi;
use kartik\depdrop\DepDrop;
/* @var $this yii\web\View */
/* @var $model frontend\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-form">

     <?php $form = ActiveForm::begin([
		'validateOnBlur' => false,
		'validateOnChange' => false
    ]); ?>
	<div class="row">
		<div class="col-lg-6">
			<?php $provinsi = ArrayHelper::map(Provinsi::find()->orderBy(['nama'=>SORT_ASC])->all(), 'id_prov', 'nama')?>
			
			<?= $form->field($modelProvinsi, 'id_prov')->label('Provinsi Name')->dropDownList($provinsi, ['prompt'=>'Pilih']) ?>
			
			
			<?php if (!$model->isNewRecord): ?>
			<?php echo Html::hiddenInput('id_kab', $model->kelurahan->kecamatan->id_kab, ['id'=>'id_kab']); ?>
			<?php echo Html::hiddenInput('id_kec', $model->kelurahan->kecamatan->id_kec, ['id'=>'id_kec']); ?>
			<?php echo Html::hiddenInput('id_kel', $model->id_kel, ['id'=>'id_kel']); ?>
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

			<?= $form->field($modelKecamatan, 'id_kec')->label('Kecamatan Name')->widget(DepDrop::classname(), [
				 'pluginOptions'=>[
					 'depends'=>['kabupaten-id_kab'],
					 'placeholder' => 'Pilih',
					 'params' => ['id_kec'],
					 'url' => Url::to(['/api/kecamatan'])
				 ]
			]); ?>
			
			<?= $form->field($model, 'id_kel')->label('Kelurahan Name')->widget(DepDrop::classname(), [
				 'pluginOptions'=>[
					 'depends'=>['kecamatan-id_kec'],
					 'placeholder' => 'Pilih',
					 'params' => ['id_kel'],
					 'url' => Url::to(['/api/kelurahan'])
				 ]
			]); ?>
		</div>
    

    
		<div class="col-lg-6">
			<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

			<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

			<?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
		</div>
	</div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-flat btn-lg' : 'btn btn-primary btn-flat btn-lg']) ?>
		<?= Html::resetButton('Cancel', ['class'=>'btn btn-default btn-flat btn-lg']) ?>
		<?= Html::a('Back',['index'], ['class'=>'btn btn-warning btn-flat btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
