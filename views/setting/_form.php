<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use kartik\widgets\FileInput;
use kartik\widgets\SwitchInput;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Setting */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="setting-form">

    <?php
    $form = ActiveForm::begin([
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'options' => ['enctype' => 'multipart/form-data']   // important, needed for file upload
    ]);
    ?>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'emailSupport')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'emailAdmin')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'emailOrder')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'whatsappNumber')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'whatsappPassword')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'whatsappSend')->textInput(['maxlength' => 255]) ?>

        </div>
        <div class="col-md-6">

            <?= $form->field($model, 'sendgridUsername')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'sendgridPassword')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'facebook')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'google')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'instagram')->textInput(['maxlength' => 255]) ?>
            <?= $form->field($model, 'twitter')->textInput(['maxlength' => 255]) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-md-10">
            <?= $form->field($model, "privacyPolicy")->widget(CKEditor::className(), ["editorOptions" => [ "preset" => "full", "inline" => false]]); ?>
            <?= $form->field($model, "legalNotice")->widget(CKEditor::className(), ["editorOptions" => [ "preset" => "full", "inline" => false]]); ?>
            <?= $form->field($model, "terms")->widget(CKEditor::className(), ["editorOptions" => [ "preset" => "full", "inline" => false]]); ?>

        </div>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

