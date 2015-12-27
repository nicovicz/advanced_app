<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-form">
	
    <?php $form = ActiveForm::begin(); ?>
		<div class="col-lg-6">
        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'email') ?>
		<?php $label = ($model->isNewRecord)?'Password':'Password (Leave password blank if don\'t want to change )'?>
        <?= $form->field($model, 'password')->label($label)->passwordInput() ?>
		</div>
        
        
        <?php 
        $json = null;
        $init_role  = [];
        $init_permission = [];
        if (!$model->isNewRecord && !empty($model->assignment)){
			 
		      foreach($model->assignment as $rbac) {
				  if ($rbac->itemName->type == 1){
					  $init_role[] = $rbac->item_name;
				  }else{
					  $init_permission[] = $rbac->item_name;
				  }
				  
			  }
			
			
		}  
		
		?>
		
		<div class="col-lg-6">
		<div class="form-group">
			<label>Roles</label>
		<?= Select2::widget([
			'name' => 'otherrole[]',
			'value' => $init_role,
			'pluginOptions'=>[
				'ajax' => [
					'url' => Url::to(['/api/role']),
					'dataType' => 'json',
					'data' => new JsExpression('function(params){return {q:params.term}; }'),
				],
				'tags' => true,
			],
			'options'=>['multiple'=>true]
		 ]) ?>
		 </div>
		
		
		<div class="form-group">
			<label>Permissions</label>
		<?= Select2::widget([
			'name' => 'otherpermission[]',
			'value' => $init_permission,
			'pluginOptions'=>[
				'ajax' => [
					'url' => Url::to(['/api/permission']),
					'dataType' => 'json',
					'data' => new JsExpression('function(params){return {q:params.term}; }'),
				],
				'tags' => true,
			],
			'options'=>['multiple'=>true]
		 ]) ?>
		 </div>
		 </div>
		
	  <div class="col-lg-12">
      <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-flat btn-lg' : 'btn btn-primary btn-flat btn-lg']) ?>
		<?= Html::resetButton('Cancel', ['class'=>'btn btn-default btn-flat btn-lg']) ?>
		<?= Html::a('Back',['index'], ['class'=>'btn btn-warning btn-flat btn-lg']) ?>
    </div>
    </div> 
        
    <?php ActiveForm::end(); ?>
</div>


