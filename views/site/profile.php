<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use kartik\widgets\SwitchInput;

/**
 * @var yii\web\View $this
 * @var common\models\Blog $model
 */
$this->title = 'Settings ' . $model->username . ' - ' . $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Update ', 'url' => ['profile/update']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="page-header" style="padding-left: 10px;">
            <h1><?= Html::encode($this->title) ?></h1>
            <small>Please feels free to update your profile</small>
        </div>
        <div class="text-right">
            <a href="<?php echo Yii::$app->urlManager->createUrl('site/change_password'); ?>" class="btn btn-danger" ><i class="fa fa-lock"></i> Change Password</a>
        </div>
    </div>
    <div class="panel-body">
        <?php
        $form = ActiveForm::begin([
                    'type' => ActiveForm::TYPE_VERTICAL,
                    'options' => ['enctype' => 'multipart/form-data']   // important, needed for file upload
        ]);
        ?>
        <?=
        $this->render('me', [
            'model' => $model,
            'form' => $form,
            'active' => $active
        ])
        ?>
        <hr/>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-9">
                <?=
                Html::submitButton('Update', ['class' => 'btn btn-primary btn-block']);
                ActiveForm::end();
                ?>
            </div>
        </div>

    </div>
</div>
</div>
