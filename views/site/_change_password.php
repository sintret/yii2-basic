<?php

use yii\helpers\Html;
use kartik\password\PasswordInput;
use kartik\widgets\ActiveForm; // optional
$this->title = 'Change Password for ' . $user->username;
$this->params['breadcrumbs'][] = ['label' => 'Update ', 'url' => ['site/profile']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="page-header" style="padding-left: 10px;">
            <h1><?= Html::encode($this->title) ?></h1>
            <small>Please feels free to update your password</small>
            </div>
        </div>
        <div class="panel-body">
            <?php
            $form = ActiveForm::begin([
                        'type' => ActiveForm::TYPE_VERTICAL,
                        'options' => ['enctype' => 'multipart/form-data']   // important, needed for file upload
            ]);
            ?>
            <?php
            $form = ActiveForm::begin(['id' => 'login-form']);
            echo $form->field($model, 'password')->widget(PasswordInput::classname(), [
                'pluginOptions' => [
                    'showMeter' => true,
                    'toggleMask' => false
                ]
            ]);
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