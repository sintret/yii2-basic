<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php //echo $this->render('_search', ['model' => $searchModel]);    ?>


    <?=
    GridView::widget([
        'id' => 'user-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'pjax' => true, // pjax is set to always true for this demo
        //'showPageSummary' => true,
        'exportConfig' => true,
        'floatHeader' => true,
        'hover'=>true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  ' . $this->title . '</h3>',
            'before' => '<div style="padding-top: 7px;"><em>* The table at the right you can pull reports</em></div>',
        ],
        // set your toolbar
        'toolbar' => [
            ['content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['user/create'], ['type' => 'button', 'title' => 'Add ' . $this->title, 'class' => 'btn btn-success']) . ' ' .
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['user/index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Reset Grid'])
            ],
            '{export}',
        //'{toggleData}',
        ],
        // set export properties
        'export' => [
            'fontAwesome' => true
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            'id',
            'username',
            'name',
            'email',
            'phone',
            'city',
            [
                'class' => 'kartik\grid\BooleanColumn',
                'attribute' => 'status',
                'vAlign' => 'middle',
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => false,
                'vAlign' => 'middle',
//                'urlCreator' => function($action, $model, $key, $index) {
//                    return '';
//                },
                'viewOptions' => ['title' => 'view', 'data-toggle' => 'tooltip'],
                'updateOptions' => ['title' => 'update', 'data-toggle' => 'tooltip'],
                'deleteOptions' => ['title' => 'delete', 'data-toggle' => 'tooltip'],
            ],
            ['class' => 'kartik\grid\CheckboxColumn']
        // 'email:email',
        // 'phone',
        // 'city',
        // 'role',
        // 'status',
        // 'name',
        // 'avatar',
        // 'banner_top',
        // 'params:ntext',
        // 'position',
        // 'hobby',
        // 'description:ntext',
        // 'created_at',
        // 'updated_at',
        // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
