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

$this->title = Yii::t('app', 'Manage User');
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
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success btn-flat btn-lg']) ?>
        
       
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
               'value' => 'username',
              'headerOptions' => ['class'=>'text-center'],
            ],
            [
             
              'value' => 'email'
              
            ],
            [
              'label' => 'Roles',
              'filter' => false,
              'format' => 'html',
              'headerOptions' => ['class'=>'text-center'],
              'value' => function($data){
				  $result = [];
				  if (!empty($data->assignment)){
					  
					  foreach($data->assignment as $role){
						if ($role->itemName->type==1){
							$result[] = '<span class="label label-success label-md">'.$role->item_name.'</span>';
						}
							
							
						
					  }
			      }
				  
				  return implode(' ',$result);
			  }
            ],
            [
              'label' => 'Permissions',
              'filter' => false,
              'format' => 'html',
              'headerOptions' => ['class'=>'text-center'],
              'value' => function($data){
				$result = [];
				  if (!empty($data->assignment)){
					  
					  foreach($data->assignment as $permission){
						if ($permission->itemName->type==2){
							$result[] = '<span class="label label-success label-md">'.$permission->item_name.'</span>';
						}
							
							
						
					  }
			      }
				  
				  return implode(' ',$result);
			  }
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
