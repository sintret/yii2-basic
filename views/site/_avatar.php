<?php
use kartik\widgets\FileInput;

?>
<div class="page-header-line">
    <h3>Avatar</h3>
    <small>Avatar can save many profile image</small>
</div>
<hr>
<div class="row">
    <div class="col-md-10 col-xs-12">
    <img src="<?php echo $model->avatarTrue;?>" class="img-responsive img-thumbnail">
    </div>
</div>
<hr/>
<?php echo $form->field($model, 'avatar')->widget(FileInput::classname(), [
'options' => ['accept' => 'image/*'],
]);?>