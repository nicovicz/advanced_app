<?php

use yii\helpers\Html;
use kartik\alert\AlertBlock;

/* @var $this yii\web\View */
/* @var $model frontend\models\Kecamatan */

$this->title = Yii::t('app', 'Create Kecamatan');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kecamatans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-warning box-solid">
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
        'modelProvinsi'=> $modelProvinsi
    ]) ?>
  </div>
</div>
