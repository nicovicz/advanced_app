<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\alert\AlertBlock;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProvinsiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Manage Provinsi');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box box-success box-solid">
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
        <?= Html::a(Yii::t('app', 'Create Provinsi'), ['create'], ['class' => 'btn btn-success btn-flat btn-lg']) ?>
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
				'label' => 'Province Name',
				'value' => 'nama',
				'attribute' => 'nama',
				'headerOptions' => ['class'=>'text-center']
			],
            [
				'class' => 'yii\grid\ActionColumn',
				'contentOptions' => ['class'=>'text-center'],
				'template'=>'{update} {delete}'
            
            ],
        ],
    ]); ?>

	</div>
</div>
