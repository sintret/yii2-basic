<?php

namespace app\models;

use app\models\User;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model {

    public $email;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\app\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail() {
        /* @var $user User */
        $user = User::findOne([
                    'status' => User::STATUS_ACTIVE,
                    'email' => $this->email,
        ]);

        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                $setting = Setting::findOne(1);
                return \Yii::$app->mailer->compose('passwordResetToken', ['user' => $user])
                                ->setFrom([$setting->emailAdmin => \Yii::$app->name . ' robot'])
                                ->setTo($this->email)
                                ->setSubject('Password reset for ' . \Yii::$app->name)
                                ->send();
            }
        }

        return false;
    }

    public function sendMail() {
        /* @var $user User */
        $user = User::findOne([
                    'status' => User::STATUS_ACTIVE,
                    'email' => $this->email,
        ]);
        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                $setting = Setting::findOne(1);
                $usernameSendgrid = $setting->sendgridUsername;
                $passwordSendgrid = $setting->sendgridPassword;
                $mail = $user->email;
                //echo $user->email;exit(0);
                $resetLink = Url::to(['site/reset-password', 'token' => $user->password_reset_token]);


                $sendgrid = new \SendGrid($usernameSendgrid, $passwordSendgrid, array("turn_off_ssl_verification" => true));
                $email = new \SendGrid\Email();
                $body_message = 'Hello ' . Html::encode($user->username) . ', <br>
                Follow the link below to reset your password:  <br>
                ' . Html::a(Html::encode($resetLink), $resetLink);
                $email->addTo($user->email)->
                        setFrom($setting->emailSupport)->
                        setSubject('Password reset for ' . \Yii::$app->name)->
                        setHtml($body_message);

                $response = $sendgrid->send($email);
                //print_r($response); exit(0);
                return $response;
            }
        }

        return false;
    }

}
