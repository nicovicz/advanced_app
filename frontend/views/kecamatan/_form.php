<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use frontend\models\Provinsi;
use kartik\depdrop\DepDrop;
/* @var $this yii\web\View */
/* @var $model frontend\models\Kecamatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kecamatan-form">

    <?php $form = ActiveForm::begin([
		'validateOnBlur' => false,
		'validateOnChange' => false
    ]); ?>
    
	
	
	<?php $provinsi = ArrayHelper::map(Provinsi::find()->orderBy(['nama'=>SORT_ASC])->all(), 'id_prov', 'nama'); ?>
    <?= $form->field($modelProvinsi, 'id_prov')->label('Provinsi Name')->dropDownList($provinsi, ['prompt'=> 'Pilih']) ?>
	
	<?php if (!$model->isNewRecord): ?>
	<?php echo Html::hiddenInput('id_kab', $model->id_kab, ['id'=>'id_kab']); ?>
	<?php endif; ?>
	
    <?= $form->field($model, 'id_kab')->label('Kabupaten Name')->widget(DepDrop::classname(), [
		 'pluginOptions'=>[
			 'depends'=>['provinsi-id_prov'],
			 'placeholder' => 'Pilih',
			 'initialize' => true,
			 'params' => ['id_kab'],
			 'url' => Url::to(['/api/kabupaten'])
		 ],
		
	]); ?>

    <?= $form->field($model, 'nama')->label('Kecamatan Name')->textInput(['maxlength' => true]) ?>

     <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-flat btn-lg' : 'btn btn-primary btn-flat btn-lg']) ?>
		<?= Html::resetButton('Cancel', ['class'=>'btn btn-default btn-flat btn-lg']) ?>
		<?= Html::a('Back',['index'], ['class'=>'btn btn-warning btn-flat btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
