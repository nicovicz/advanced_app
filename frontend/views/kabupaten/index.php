<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\alert\AlertBlock;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\KabupatenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Management Kabupaten');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-primary box-solid">
	<div class="box-header with-border">
		<big><?= Html::encode($this->title) ?></big>
	</div>
	<div class="provinsi-index box-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<?= AlertBlock::widget([
      'type' => AlertBlock::TYPE_ALERT,
      'useSessionFlash' => true
    ]); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Kabupaten'), ['create'], ['class' => 'btn btn-success btn-flat btn-lg']) ?>
    </p>

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
					return ArrayHelper::getValue($data,'provinsi.nama');
				}
			],
            [
			   'label' => 'Kabupaten Name',
			   'headerOptions' => ['class'=>'text-center'],
               'value'=>'nama',
               'attribute' => 'nama'
            ],

            [
				'class' => 'yii\grid\ActionColumn',
				'contentOptions' => ['class'=>'text-center'],
				'template'=>'{update} {delete}'
            
            ],
        ],
    ]); ?>
 </div>
</div
