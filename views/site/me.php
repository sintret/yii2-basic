<?php
use kartik\tabs\TabsX;
use yii\helpers\Url;

$this->title = $user->name .' profile';
//$this->registerMetaTag(['name' => 'keywords', 'content' => $user->shortDescription]);
?>
<?php



$items = [
    [
        'label' => '<i class="glyphicon glyphicon-user"></i> Profile',
        'content' => $this->render('_profile', ['form' => $form, 'model' => $model]),
        'active' => $active[1],
    //'linkOptions' => ['data-url' => Url::to(['/profile/update?tab=1'])]
    ],
    [
        'label' => '<i class="glyphicon glyphicon-user"></i> Avatar',
        'content' => $this->render('_avatar', ['form' => $form, 'model' => $model]),
        'active' => $active[2],
    //'linkOptions' => ['data-url' => Url::to(['/profile/update?tab=2'])]
    ],
//    [
//        'label' => '<i class="glyphicon glyphicon-lock"></i> Change Password',
//        'content' => $this->render('_change_password', ['form' => $form, 'model' => $model]),
//        'active' => $active[3],
//    //'linkOptions' => ['data-url' => Url::to(['/profile/update?tab=3'])]
//    ],
];
// Above
echo TabsX::widget([
    'items' => $items,
    'position' => TabsX::POS_ABOVE,
    'encodeLabels' => false
]);
// Below