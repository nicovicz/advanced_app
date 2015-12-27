<?php
use common\themes\adminlte\assets\AdminLTEAsset;
use common\themes\adminlte\assets\IcheckAsset;
use yii\helpers\Html;
/* @var $this \yii\web\View */
/* @var $content string */


AdminLTEAsset::register($this);
IcheckAsset::register($this);
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@common/themes/adminlte/dist');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition login-page">
<?php $this->beginBody() ?>
     <div class="login-box">
     
      <div class="login-box-body">
       
       
		<?=$content;?>
       

      

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

<?php
$this->registerJs("
$('input').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
      increaseArea: '20%' // optional
});");
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
