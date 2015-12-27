<?php
use common\components\Panel;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\alert\AlertBlock;
use app\modules\user\models\AuthItem;
use app\modules\user\models\AuthRule;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Manage Route');
$this->params['breadcrumbs'][] = $this->title;
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

    <p>
        <?= Html::a(Yii::t('app', 'Create New Route'), ['create'], ['class' => 'btn btn-success btn-flat btn-lg']) ?>
        
        <?= Html::a(Yii::t('app', 'Register Existing Route'), ['register'], ['class' => 'btn btn-success btn-flat btn-lg']) ?>
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
              'headerOptions' => ['class'=>'text-center'],
            ],

            [
              'attribute' => 'name',
              'label' => 'Route Name',
              'headerOptions' => ['class'=>'text-center'],
            ],
            [
              'attribute' => 'description',
              'value' => 'description'
              
            ],
            
            [
              'attribute'=>'created_at',
              'filter' => false,
              'format'=> ['date', 'php:d F Y'],

              'contentOptions' => ['class'=>'text-center'],
              'headerOptions' => ['class'=>'text-center'],
            ],
            

            [
              'class' => 'yii\grid\ActionColumn',
              'template'=>'{update} {delete}',
              'contentOptions' => ['class'=>'text-center'],
              
            ],
        ],
    ]); ?>

  </div>
</div>
