<?php

use yii\helpers\Html;
use kartik\alert\AlertBlock;
/* @var $this yii\web\View */
/* @var $model frontend\models\Kelurahan */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Kelurahan',
]) . ' ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Kelurahans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_kel, 'url' => ['view', 'id' => $model->id_kel]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="box box-default box-solid">
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
         'modelProvinsi' => $modelProvinsi,
         'modelKabupaten'=>$modelKabupaten
    ]) ?>

</div>
</div>
