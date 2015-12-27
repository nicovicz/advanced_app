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

$this->title = Yii::t('app', 'Manage Role');
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
        <?= Html::a(Yii::t('app', 'Create Role'), ['create'], ['class' => 'btn btn-success btn-flat btn-lg']) ?>
        
       
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
              'label' => 'Role Name',
              'headerOptions' => ['class'=>'text-center'],
            ],
            [
              'attribute' => 'description',
              'value' => 'description'
              
            ],
            [
              'label' => 'Extend Other Role',
              'filter' => false,
              'format' => 'html',
              'headerOptions' => ['class'=>'text-center'],
              'value' => function($data){
				$auth = Yii::$app->authManager;
				$Otherpermissions = $auth->getChildren($data->name);
				$permissions = ArrayHelper::toArray($Otherpermissions);
				
				if (!empty($permissions) && is_array($permissions)) {
					$result = [];
					foreach($permissions as $permission){
						if ($permission['type']==1){
							$result[] = '<span class="label label-success label-md">'.$permission['name'].'</span>';
						}
						
					}
					
					return implode(' ',$result);
				}
			  }
            ],
            [
              'label' => 'Extend Other Permission',
              'filter' => false,
              'format' => 'html',
              'headerOptions' => ['class'=>'text-center'],
              'value' => function($data){
				$auth = Yii::$app->authManager;
				$Otherpermissions = $auth->getChildren($data->name);
				$permissions = ArrayHelper::toArray($Otherpermissions);
				
				if (!empty($permissions) && is_array($permissions)) {
					$result = [];
					foreach($permissions as $permission){
						if ($permission['type']==2){
							$result[] = '<span class="label label-primary label-md">'.$permission['name'].'</span>';
						}
						
					}
					
					return implode(' ',$result);
				}
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
