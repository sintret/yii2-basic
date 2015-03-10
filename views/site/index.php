<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Sintret Projects - Dashboard';
//$this->registerCssFile(Yii::$app->request->baseUrl . '/css/xenon-components.css');
//$this->registerCssFile(Yii::$app->request->baseUrl . '/css/fonts/linecons/css/linecons.css');
$this->registerCssFile('//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css');
////code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css
//echo \Yii::$app->session->get('branch');
//echo 'branchId :'.Yii::$app->user->identity->branchId;
//echo 'role :'.Yii::$app->user->identity->role;
$this->registerJsFile('https://apis.google.com/js/platform.js', ['jsOptions' => ['asynch', 'defer'], 'depends' => [app\assets\AppAsset::className()]]);
?>
<p>&nbsp;</p>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>
                    0<?php //echo app\models\Transaction::find()->count(); ?>
                </h3>
                <p>
                    Transactions
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a class="small-box-footer" href="<?php //echo Url::to(['transaction/index']); ?>">
                Go to Transactions <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>
                    3<?php //echo app\models\Royalty::find()->count(); ?>
                </h3>
                <p>
                    Royalty
                </p>
            </div>
            <div class="icon">
                <i class="ion-scissors"></i>
            </div>
            <a class="small-box-footer" href="<?php //echo Yii::$app->urlManager->createUrl('royalty/index'); ?>">
                Go to Royalty <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>
                    Reports
                </h3>
                <p>
                    Graphic
                </p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a class="small-box-footer" href="<?php echo Url::to(['report/index']); ?>">
                Go to Graphic <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div><!-- ./col -->
</div>
<hr>
<div class="row">
    <!-- Left col -->
    <section class="col-lg-9 connectedSortable ui-sortable">

        <!-- Chat box -->
        <?php
        echo \sintret\chat\ChatRoom::widget([
            'url' => \yii\helpers\Url::to(['/ajax/send-chat']),
            'userModel' => \app\models\User::className(),
            'userField' => 'avatarImage'
        ]);
        ?>
        <!-- To Do List -->
        <?php
        echo \sintret\todolist\ListView::widget([
            'url' => \yii\helpers\Url::to(['/ajax/todolist']),
            'relations' => app\models\User::className(),
        ]);
        ?>

    </section><!-- /.Left col -->
    <div class="col-md-3">
        <?php
        $phone = [];
        $users = app\models\User::find()->where(['status' => app\models\User::STATUS_ACTIVE])->all();
        if ($users)
            foreach ($users as $user) {
                if ($user->phone)
                    $invite[] = "{ id : '$user->phone', invite_type : 'PHONE' }";
                $invite[] = "{ id : '$user->email', invite_type : 'EMAIL' }";
            }
        $invites = implode(",", $invite);
        //echo $invites;
        ?>


        <div class="col-md-12">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Video Call</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="g-hangout" data-invites="[<?= $invites; ?>]" data-render="createhangout" data-topic="Adiadrian Salon" data-hangout_type="normal"  data-widget_size="175"></div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div><!-- /.end col-md-3 -->

</div>