<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Sign in to continue </h1>
            <div class="account-wall">
                <img class="profile-img" src="<?php echo Yii::$app->request->baseUrl.'/img/photo.jpg.png';?>" alt="">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form', 
                    //'template'=>'{input}\n{hint}\n{error}',
                    'options' => [
                        'class' => 'form-signin'
                        ]]); 
                ?>
                <?= $form->field($model, 'username')->textInput(['placeholder'=>'username or email','required'=>true,'autofocus'=>true]) ?>
                <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'username or email','required'=>true]) ?>
                <?= Html::submitButton('Login', ['class' => 'btn btn-lg btn-primary btn-block', 'name' => 'login-button']) ?>

              
                <label class="checkbox pull-left">
                    <?= Html::activeCheckbox($model, 'rememberMe'); //$form->field($model, 'rememberMe')->checkbox([[],false]) ?>
                </label>
                <a href="<?php echo Url::to(['site/forgot_password']);?>" class="pull-right need-help">Forgot Password </a><span class="clearfix"></span>
                <?php ActiveForm::end(); ?>
            </div>
            <a href="<?php echo Url::to(['site/signup']);?>" class="text-center new-account">Create an account </a>
        </div>
    </div>
</div>