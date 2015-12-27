<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\modules\user\assets\JsTreeAsset;
//JsTreeAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\modules\user\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>
        
        <div >
            <?php if (is_array($routers)): ?>
             
                    <table class="table table-bordered table-striped">
					<tbody>
                    <?php foreach($routers as $controllerName => $actionLists): ?>

                            <tr><td colspan="<?=count($actionLists);?>"><strong><?=$controllerName?></strong></td></tr>
                            <?php if (is_array($actionLists)): ?>
                                <tr>
                                    <?php foreach ($actionLists as $list): ?>
										<?php $checked = null; ?>
										<?php foreach($registeredRouters as $registered): ?>
											<?php $route = $controllerName.$list; ?>
											<?php if ($registered->name == $route) : ?>
												<?php $checked = 'checked'; ?>
											<?php endif; ?>
										<?php endforeach; ?>
										<td> <input type="checkbox" <?=$checked;?> name="routes[]" value="<?=$controllerName?><?=$list?>" /><?=$controllerName?><?=$list?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endif; ?>
                            

                    <?php endforeach; ?>
                    </tbody>
                    </table>
              
            <?php endif; ?>
          </div>
          
          <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-flat btn-lg' : 'btn btn-primary btn-flat btn-lg']) ?>
		<?= Html::a('Back',['index'], ['class'=>'btn btn-warning btn-flat btn-lg']) ?>

		</div>
      <?php ActiveForm::end(); ?>  
    
</div>



