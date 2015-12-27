<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Provinsi;
/* @var $this yii\web\View */
/* @var $model frontend\models\Kabupaten */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kabupaten-form">

   <?php $form = ActiveForm::begin([
		'validateOnBlur' => false,
		'validateOnChange' => false
    ]); ?>

	
	<?php $provinsi =  ArrayHelper::map(Provinsi::find()->orderBy(['nama'=>SORT_ASC])->all(), 'id_prov', 'nama'); ?>
    <?= $form->field($model, 'id_prov')->label('Provinsi Name')->dropDownList($provinsi, ['prompt'=>'Pilih']) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

     <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-flat btn-lg' : 'btn btn-primary btn-flat btn-lg']) ?>
		<?= Html::resetButton('Cancel', ['class'=>'btn btn-default btn-flat btn-lg']) ?>
		<?= Html::a('Back',['index'], ['class'=>'btn btn-warning btn-flat btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
