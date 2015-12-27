<?php

use yii\helpers\Html;
use kartik\alert\AlertBlock;
/* @var $this yii\web\View */
/* @var $model frontend\models\Kecamatan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Kecamatan',
]) . ' ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kecamatans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_kec, 'url' => ['view', 'id' => $model->id_kec]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
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
        'modelProvinsi' => $modelProvinsi
    ]) ?>

  </div>
</div>
