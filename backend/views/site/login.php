<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1 class="login-logo"><strong><?= Html::encode($this->title) ?></strong></h1>

    <p class="login-box-msg">Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username', [
					'options' => ['class'=>'form-group has-feedback'],
					'inputOptions' => ['placeholder'=>'Username'],
					'template' => "{input}\n{hint}\n{error}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
                ]) ?>

                <?= $form->field($model, 'password', [
					'options' => ['class'=>'form-group has-feedback'],
					'inputOptions' => ['placeholder'=>'Password'],
					'template' => "{input}\n{hint}\n{error}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
                ])->passwordInput() ?>

                <?= $form->field($model, 'rememberMe', [
					'options' => ['tag'=>'div', 'class'=>'checkbox icheck'],
					'checkboxTemplate'=>"{beginLabel}\n{input}\n{labelTitle}{endLabel}\n{error}\n{hint}"
                ])->checkbox() ?>

			
                <div class="form-group">
                    <?= Html::submitButton('Sign In', ['class' => 'btn btn-primary btn-flat', 'name' => 'login-button']) ?>
                    <a href="<?php echo Yii::$app->urlManagerFrontEnd->baseUrl; ?>" class="btn btn-success btn-flat">Go To Frontend</a>

                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
