<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Setting */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'emailAdmin:email',
            'emailSupport:email',
            'emailOrder:email',
            'sendgridUsername',
            'sendgridPassword',
            'whatsappNumber',
            'whatsappPassword',
            'facebook',
            'instagram',
            'google',
            'twitter',
            'privacyPolicy:ntext',
            'terms:ntext',
            'legalNotice:ntext',
             [
                'attribute' => 'userCreate',
                'value' => $model->userCreateLabel,
            ],
                    [
                'attribute' => 'userUpdate',
                'value' => $model->userUpdateLabel,
            ],
            
                    [
                'attribute' => 'createDate',
                'value' => $model->createDate,
            ],
            
                    [
                'attribute' => 'updateDate',
                'value' => $model->updateDate,
            ],
                
                ]]) ;?>

</div>
