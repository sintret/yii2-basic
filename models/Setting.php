<?php

namespace app\models;

use Yii;
use app\models\User;


/**
 * This is the model class for table "setting".
 *
 * @property integer $id
 * @property string $emailAdmin
 * @property string $emailSupport
 * @property string $emailOrder
 * @property string $sendgridUsername
 * @property string $sendgridPassword
 * @property string $whatsappNumber
 * @property string $whatsappSend
 * @property string $whatsappPassword
 * @property string $facebook
 * @property string $instagram
 * @property string $google
 * @property string $twitter
 * @property string $privacyPolicy
 * @property string $terms
 * @property string $legalNotice
 * @property integer $userCreate
 * @property integer $userUpdate
 * @property string $createDate
 * @property string $updateDate
 */
class Setting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['privacyPolicy', 'terms', 'legalNotice'], 'string'],
            [['userCreate', 'userUpdate'], 'integer'],
            [['createDate', 'updateDate'], 'safe'],
            [['emailAdmin', 'emailSupport', 'emailOrder', 'sendgridUsername', 'sendgridPassword', 'whatsappNumber', 'whatsappPassword','whatsappSend', 'facebook', 'instagram', 'google', 'twitter'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'emailAdmin' => 'Email Admin',
            'emailSupport' => 'Email Support',
            'emailOrder' => 'Email Order',
            'sendgridUsername' => 'Sendgrid Username',
            'sendgridPassword' => 'Sendgrid Password',
            'whatsappNumber' => 'Whatsapp Number',
            'whatsappPassword' => 'Whatsapp Password',
            'whatsappSend' => 'Whatsapp Send Number',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'google' => 'Google',
            'twitter' => 'Twitter',
            'privacyPolicy' => 'Privacy Policy',
            'terms' => 'Terms',
            'legalNotice' => 'Legal Notice',
            'userCreate' => 'User Create',
            'userUpdate' => 'User Update',
            'createDate' => 'Create Date',
            'updateDate' => 'Update Date',
        ];
    }
    
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->createDate = date('Y-m-d H:i:s');
            $this->userCreate = 1;
            $this->userUpdate = 1;
        } else {
            $this->updateDate = date('Y-m-d H:i:s');
            $this->userUpdate = Yii::$app->user->id;
        }
        return parent::beforeSave($insert);
    }
    
    public function getUserCreateLabel() {
        $user = User::find()->select('username')->where(['id' => $this->userCreate])->one();
        return $user->username;
    }

    public function getUserUpdateLabel() {
        $user = User::find()->select('username')->where(['id' => $this->userUpdate])->one();
        return $user->username;
    }
    
    }
