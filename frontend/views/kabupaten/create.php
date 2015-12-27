<?php

use yii\helpers\Html;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $model frontend\models\Kabupaten */

$this->title = Yii::t('app', 'Create Kabupaten');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kabupatens'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary box-solid">
	<div class="box-header with-border">
		<big><?= Html::encode($this->title) ?></big>
    </div>
    <div class="provinsi-index box-body">
	<?= AlertBlock::widget([
      'type' => AlertBlock::TYPE_ALERT,
      'useSessionFlash' => true
    ]); ?>
    <?= $this->render('_form', [
        'model' => $model,
        
    ]) ?>
  </div>
</div>
