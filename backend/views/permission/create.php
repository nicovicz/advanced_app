<?php
use common\components\Panel;
use yii\helpers\Html;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\AuthItem */

$this->title = Yii::t('app', 'Create Permission');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auth Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success box-solid">
	<div class="box-header with-border">
		<big><?= Html::encode($this->title) ?></big>
    </div>
    <div class="route-index box-body">
    <?= AlertBlock::widget([
      'type' => AlertBlock::TYPE_ALERT,
      'useSessionFlash' => true
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
		
       
    ]); ?>
  </div>
</div>
