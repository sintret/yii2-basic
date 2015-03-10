<?php

namespace app\commands;

use yii\console\Controller;
use Yii;
use yii\db\ActiveRecord;
use app\models\User;
use app\models\Setting;

class InsertController extends Controller {

    public function actionInit() {
        $model = new User;
        $model->username = 'admin';
        $model->auth_key = 'OocVKRx-iludROmUFYj4HmxNeC8v0-FG';
        $model->password_hash = '$2y$13$0d3FeUDYGSyZft.3I77hV.E357FsqqAJFqaWPstWODMbdlSvxV2gC';
        $model->email = 'sintret@gmail.com';
        $model->phone = '6281575068530';
        $model->role = User::ROLE_ADMIN;
        $model->status = User::STATUS_ACTIVE;
        if ($model->save()) {
            echo 'success insert user, with usename:admin and password:123456';
        } else {
            echo json_encode($model->getErrors());
        }

        $setting = new Setting;
        $setting->emailAdmin = 'sintret@gmail.com';
        $setting->emailSupport = 'sintret@gmail.com';
        $setting->emailOrder = 'sintret@gmail.com';
        $setting->facebook = 'https://www.facebook.com/sintret';
        $setting->instagram = 'https://instagram.com/andyfitria/';
        $setting->google = 'https://google.com/sintret/';
         if ($setting->save()) {
            echo "\r\n success insert basic settings";
        } else {
            echo json_encode($setting->getErrors());
        }
    }

}
