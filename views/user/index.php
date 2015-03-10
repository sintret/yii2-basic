<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\dynagrid\DynaGrid;
use app\models\User;

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
    <?php //echo $this->render('_search', ['model' => $searchModel]);     ?>


    <?php
    $toolbars = [
        ['content' =>
            //Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type' => 'button', 'title' => 'Add ' . $this->title, 'class' => 'btn btn-success', 'onclick' => Yii::$app->urlManager->createUrl('blog/create')]) . ' ' .
            Html::a('<i class="glyphicon glyphicon-plus"></i>', ['user/create'], ['type' => 'button', 'title' => 'Add ' . $this->title, 'class' => 'btn btn-success']) . ' ' .
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['user/index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => 'Reset Grid'])
        ],
        ['content' => '{dynagridFilter}{dynagridSort}{dynagrid}'],
        '{export}',
    ];
    $panels = [
        //'type' => GridView::TYPE_PRIMARY,
        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-book"></i>  ' . $this->title . '</h3>',
        'before' => '<div style="padding-top: 7px;"><em>* The table at the right you can pull reports & personalize</em></div>',
    ];
    $columns = [
        ['class' => 'kartik\grid\SerialColumn', 'order' => DynaGrid::ORDER_FIX_LEFT],
        'id',
        [
            'attribute' => 'avatar',
            'format' => 'html',
            'value' => function($data) {
                return $data->thumb;
            },
        ],
        //'avatar',
        'username',
        'name',
        'email',
        'phone',
        'city',
        'position',
                     [
            'attribute' => 'role',
            'filter' => User::$roles,
            'value' => function($data) {
                return User::$roles[$data->role];
            }
        ],
        [
            'attribute' => 'createDate',
            'value' => function($data) {
                return $data->date;
            },
            'filterType' => GridView::FILTER_DATE,
            'format' => 'raw',
            'width' => '100px',
            'filterWidgetOptions' => [
                'pluginOptions' => ['format' => 'yyyy-mm-dd H:i:s']
            ],
            'visible' => false,
        ],
        [
            'attribute' => 'updateDate',
            'value' => function($data) {
                return date('Y-m-d H:i:s', $data->updateDate);
            },
            'filterType' => GridView::FILTER_DATE,
            'format' => 'raw',
            'width' => '100px',
            'filterWidgetOptions' => [
                'pluginOptions' => ['format' => 'yyyy-mm-dd H:i:s']
            ],
            'visible' => true,
        ],
        [
            'class' => 'kartik\grid\BooleanColumn',
            'attribute' => 'status',
            'vAlign' => 'middle',
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'dropdown' => false,
            'vAlign' => 'middle',
            'viewOptions' => ['title' => 'view', 'data-toggle' => 'tooltip'],
            'updateOptions' => ['title' => 'update', 'data-toggle' => 'tooltip'],
            'deleteOptions' => ['title' => 'delete', 'data-toggle' => 'tooltip'],
        ],
            //['class' => 'kartik\grid\CheckboxColumn']
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
    ];


    $dynagrid = DynaGrid::begin([
                'id' => 'user-grid',
                'columns' => $columns,
                'theme' => 'panel-primary',
                'showPersonalize' => true,
                'storage' => 'db',
                //'maxPageSize' =>500,
                'allowSortSetting' => true,
                'gridOptions' => [
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'showPageSummary' => true,
                    'floatHeader' => true,
                    'pjax' => true,
                    'panel' => $panels,
                    'toolbar' => $toolbars,
                ],
                'options' => ['id' => 'user'] // a unique identifier is important
    ]);

    DynaGrid::end();
    ?>

</div>
