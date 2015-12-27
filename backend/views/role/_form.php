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

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        
        <?php 
        $json = null;
        $init_role  = [];
        $init_permission = [];
        if (!$model->isNewRecord && !empty($childrenPermission)){
			  $permissions =  ArrayHelper::toArray($childrenPermission);
		      foreach($permissions as $permission) {
				  if ($permission['type'] == 1){
					  $init_role[] = $permission['name'];
				  }else{
					  $init_permission[] = $permission['name'];
				  }
				  
			  }
			
			
		}  
		
		?>
		
		<div class="form-group">
			<label>Add Other Role</label>
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
			<label>Add Other Permission</label>
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
		 
      <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-flat btn-lg' : 'btn btn-primary btn-flat btn-lg']) ?>
		<?= Html::resetButton('Cancel', ['class'=>'btn btn-default btn-flat btn-lg']) ?>
		<?= Html::a('Back',['index'], ['class'=>'btn btn-warning btn-flat btn-lg']) ?>
    </div>
        
    <?php ActiveForm::end(); ?>
</div>


