<?php

use yii\helpers\Html;
use kartik\alert\AlertBlock;
/* @var $this yii\web\View */
/* @var $model frontend\models\Company */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Company',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="box box-success box-solid">
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
         'modelKabupaten'=> $modelKabupaten,
         'modelKecamatan' => $modelKecamatan
    ]) ?>

</div>
</div>
