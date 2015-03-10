<?php

use yii\helpers\Html;

//use dosamigos\tinymce\TinyMce;
//https://github.com/2amigos/yii2-tinymce-widget/issues/1
//http://pixabay.com/zh/blog/posts/direct-image-uploads-in-tinymce-4-42/
//
?>
<div class="page-header-line">
    <h3>Profile</h3>
    <small>You can change your 
        <label class="label label-info">username</label>, <label class="label label-success">fullname</label>, 
        <label class="label label-warning">hobby</label>, <label class="label label-danger">description about you</label> and the other's</small>
</div>
<hr/>
<div class="row">
    <div class="col-md-6">
        <?php echo $form->field($model, 'name')->textInput(['placeholder'=>'input your fullname']); ?>
        <?php echo $form->field($model, 'phone')->textInput(['placeholder'=>'input your phone']); ?>
        <?php echo $form->field($model, 'email')->textInput(['placeholder'=>'input your email']); ?>

    </div>
    <div class="col-md-6">
        <?php echo $form->field($model, 'city')->textInput(['placeholder'=>'input your city']); ?>
        <?php echo $form->field($model, 'position')->textInput(['placeholder'=>'input your position']); ?>
    </div>
</div>