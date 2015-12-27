<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\alert\AlertBlock;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\KelurahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Manage Kelurahan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-default box-solid">
	<div class="box-header with-border">
		<big><?= Html::encode($this->title) ?></big>
	</div>
	<div class="provinsi-index box-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Kelurahan'), ['create'], ['class' => 'btn btn-success btn-flat btn-lg']) ?>
    </p>
	<?= AlertBlock::widget([
      'type' => AlertBlock::TYPE_ALERT,
      'useSessionFlash' => true
    ]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-hover table-bordered'],
        'pager' => ['options'=>['class'=>'pagination pagination-sm no-margin pull-right']],
        'columns' => [
             [
			  'class' => 'yii\grid\SerialColumn', 
			  'contentOptions' => ['class'=>'text-center'],
			  'headerOptions' => ['class'=>'text-center']
            ],

            [
				'label' => 'Provinsi Name',
				'headerOptions' => ['class'=>'text-center'],
				'attribute' => 'nama_provinsi',
				'value' => function($data){
					return ArrayHelper::getValue($data,'kecamatan.kabupaten.provinsi.nama');
				}
			],
            [
				'label' => 'Kabupaten Name',
				'headerOptions' => ['class'=>'text-center'],
			   'attribute' => 'nama_kabupaten',
				'value' => function($data){
					return ArrayHelper::getValue($data,'kecamatan.kabupaten.nama');
				}
			],
			[
				'label' => 'Kecamatan Name',
				'headerOptions' => ['class'=>'text-center'],
			   'attribute' => 'nama_kecamatan',
				'value' => function($data){
					return ArrayHelper::getValue($data,'kecamatan.nama');
				}
			],
            [
			   'label' => 'Kelurahan Name',
               'value'=>'nama',
               'attribute' => 'nama'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

  </div>
</div>
