<?php

namespace app\models;

use app\models\User;
use yii\base\Model;
use Yii;
use app\models\Notification;
use sintret\whatsapp\WhatsApp;

/**
 * Signup form
 */
class SignupForm extends Model {

    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->status = 0;
            if ($user->save()) {
                $notification = new Notification();
                $notification->title = 'user';
                $notification->message = 'new user, username:' . $user->username;
                $notification->params = \yii\helpers\Json::encode(['model' => 'User', 'id' => $user->id]);
                if ($notification->save()) {
                    $this->sendEmail($this->email);
                } else {
                    print_r($notification->getErrors());
                    exit(0);
                }

                return $user;
            } else {
                return $user->getErrors();
            }
        }

        return null;
    }

    public function sendEmail($mail) {
        $setting = Setting::find()->where(['id' => 1])->one();
        $username = $setting->sendgridUsername;
        $password = $setting->sendgridPassword;
        $mail_admin = $setting->emailAdmin;

        $sendgrid = new \SendGrid($username, $password, array("turn_off_ssl_verification" => true));
        $email = new \SendGrid\Email();
        $subject = 'Registrasi Berhasil';
        $body = 'Thanks ' . $this->username . ',';
        $body .= "\n";
        $body .= "Registrasi anda berhasil, kami akan segera mereview kembali registrasi anda. \n";
        $body .= "Thanks, \n";
        $body .= Yii::$app->name;


        $body_message = $this->template($subject, $body, $logo);
        $email->addTo($mail)->
                setFrom($mail_admin)->
                setSubject('Registrasi berhasil')->
                setHtml($body_message)->
                addCategory("registrasi");

        $response = $sendgrid->send($email);
        //return $response;
        //send whatsapp
        $number = $setting->whatsappNumber;
        $app = Yii::$app->name;
        $password = $setting->whatsappPassword;
        $w = new WhatsApp($number, $app, $password);
        $w->send($setting->whatsappSend, $body);
    }

    public function template($subject, $body, $logo = null) {
//        if(empty($logo)){
//            $logo = 'https://klaviyo.s3.amazonaws.com/company%2FeHqTmW%2Fimages%2Fsintret3-64.png';
//        }
        return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
        <title></title>

        <!--[if gte mso 6]>
          <style>
              table.kmButtonBarContent {width:100% !important;}
              table.kmButtonCollectionContent {width:100% !important;}
          </style>
        <![endif]--><style type="text/css">@media only screen and (max-width:480px){body,table,td,p,a,li,blockquote{-webkit-text-size-adjust:none !important}body{width:100% !important;min-width:100% !important}td[id=bodyCell]{padding:10px !important}table.kmMobileHide{display:none !important}table[class=kmTextContentContainer]{width:100% !important}table[class=kmBoxedTextContentContainer]{width:100% !important}td[class=kmImageContent]{padding-left:0 !important;padding-right:0 !important}img[class=kmImage]{width:100% !important}table[class=kmSplitContentLeftContentContainer],table[class=kmSplitContentRightContentContainer],table[class=kmColumnContainer],td[class=kmVerticalButtonBarContentOuter] table[class=kmButtonBarContent],td[class=kmVerticalButtonCollectionContentOuter] table[class=kmButtonCollectionContent],table[class=kmVerticalButton],table[class=kmVerticalButtonContent]{width:100% !important}td[class=kmButtonCollectionInner]{padding-left:9px !important;padding-right:9px !important;padding-top:9px !important;padding-bottom:0 !important;background-color:transparent !important}td[class=kmVerticalButtonIconContent],td[class=kmVerticalButtonTextContent],td[class=kmVerticalButtonContentOuter]{padding-left:0 !important;padding-right:0 !important;padding-bottom:9px !important}table[class=kmSplitContentLeftContentContainer] td[class=kmTextContent],table[class=kmSplitContentRightContentContainer] td[class=kmTextContent],table[class=kmColumnContainer] td[class=kmTextContent],table[class=kmSplitContentLeftContentContainer] td[class=kmImageContent],table[class=kmSplitContentRightContentContainer] td[class=kmImageContent]{padding-top:9px !important}td[class="rowContainer kmFloatLeft"],td[class="rowContainer kmFloatLeft firstColumn"],td[class="rowContainer kmFloatLeft lastColumn"]{float:left;clear:both;width:100% !important}table[id=templateContainer],table[class=templateRow]{max-width:600px !important;width:100% !important}h1{font-size:24px !important;line-height:130% !important}h2{font-size:20px !important;line-height:130% !important}h3{font-size:18px !important;line-height:130% !important}h4{font-size:16px !important;line-height:130% !important}td[class=kmTextContent]{font-size:14px !important;line-height:130% !important}td[class=kmTextBlockInner] td[class=kmTextContent]{padding-right:18px !important;padding-left:18px !important}table[class="kmTableBlock kmTableMobile"] td[class=kmTableBlockInner]{padding-left:9px !important;padding-right:9px !important}table[class="kmTableBlock kmTableMobile"] td[class=kmTableBlockInner] [class=kmTextContent]{font-size:14px !important;line-height:130% !important;padding-left:4px !important;padding-right:4px !important}}</style>
    </head>
    <body style="margin:0;padding:0;background-color:#c7c7c7">
        <center>
            <table align="center" border="0" cellpadding="0" cellspacing="0" id="bodyTable" width="100%" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;padding:0;background-color:#c7c7c7;height:100%;margin:0;width:100%">
                <tbody>
                    <tr>
                        <td align="center" id="bodyCell" valign="top" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;padding-top:50px;padding-left:20px;padding-bottom:20px;padding-right:20px;border-top:0;height:100%;margin:0;width:100%">
                            <table border="0" cellpadding="0" cellspacing="0" id="templateContainer" width="600" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;border:1px solid #aaa;background-color:#f4f4f4;border-radius:0">
                                <tbody>
                                    <tr>
                                        <td id="templateContainerInner" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;padding:0">
                                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                <tr>
                                                    <td align="center" valign="top" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                        <table border="0" cellpadding="0" cellspacing="0" class="templateRow" width="100%" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="rowContainer kmFloatLeft" valign="top" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                                        <table border="0" cellpadding="0" cellspacing="0" class="kmSplitBlock" width="100%" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                                            <tbody class="kmSplitBlockOuter">
                                                                                <tr>
                                                                                    <td class="kmSplitBlockInner" valign="top" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;padding-top:9px;padding-bottom:9px;padding-left:18px;padding-right:18px;">
                                                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" class="kmSplitContentOuter" width="100%" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="kmSplitContentInner" valign="top" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" class="kmSplitContentLeftContentContainer" width="396" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td class="kmImageContent" valign="top" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;padding:0;padding-top:0px;padding-bottom:0;padding-left:9px;padding-right:9px;">
                                                                                                                        <img align="left" alt="" class="kmImage" src="' . $logo . '" width="123" style="border:0;height:auto;line-height:100%;outline:none;text-decoration:none;padding-bottom:0;display:inline;vertical-align:bottom;margin-right:0;max-width:123px;" />
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                        <table align="right" border="0" cellpadding="0" cellspacing="0" class="kmSplitContentRightContentContainer" width="132" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                                                                            <tbody>
                                                                                                                <tr>
                                                                                                                    <td class="kmTextContent" valign="top" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;color:#505050;font-family:Helvetica, Arial;font-size:14px;line-height:150%;text-align:left">
                                                                                                                        <span style="color:#0000CD;"><span style="font-size:9px;">Please do not reply this email</span></span>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </tbody>
                                                                                                        </table>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="kmDividerBlock" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                                            <tbody class="kmDividerBlockOuter">
                                                                                <tr>
                                                                                    <td class="kmDividerBlockInner" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;padding-top:18px;padding-bottom:18px;padding-left:18px;padding-right:18px;">
                                                                                        <table class="kmDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;border-top-width:1px;border-top-style:solid;border-top-color:#ccc;">
                                                                                            <tbody>
                                                                                                <tr><td style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0"><span></span></td></tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="top" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                        <table border="0" cellpadding="0" cellspacing="0" class="templateRow" width="100%" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="rowContainer kmFloatLeft" valign="top" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                                        <table border="0" cellpadding="0" cellspacing="0" class="kmTextBlock" width="100%" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                                            <tbody class="kmTextBlockOuter">
                                                                                <tr>
                                                                                    <td class="kmTextBlockInner" valign="top" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;">
                                                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" class="kmTextContentContainer" width="100%" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="kmTextContent" valign="top" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;color:#505050;font-family:Helvetica, Arial;font-size:14px;line-height:150%;text-align:left;padding-top:9px;padding-bottom:9px;padding-left:18px;padding-right:18px;">
                                                                                                        <div class="kmParagraph" style="padding-bottom:9px">' . $subject . '<hr /></div>
                                                                                                        <div class="kmParagraph" style="padding-bottom:9px">' . $body . '</div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="kmDividerBlock" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                                            <tbody class="kmDividerBlockOuter">
                                                                                <tr>
                                                                                    <td class="kmDividerBlockInner" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;padding-top:20px;">
                                                                                        <table class="kmDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                                                            <tbody>
                                                                                                <tr><td style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0"><span></span></td></tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table border="0" cellpadding="0" cellspacing="0" class="kmTextBlock" width="100%" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                                            <tbody class="kmTextBlockOuter">
                                                                                <tr>
                                                                                    <td class="kmTextBlockInner" valign="top" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;">
                                                                                        <table align="left" border="0" cellpadding="0" cellspacing="0" class="kmTextContentContainer" width="100%" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td class="kmTextContent" valign="top" style="border-collapse:collapse;mso-table-lspace:0;mso-table-rspace:0;color:#505050;font-family:Helvetica, Arial;font-size:14px;line-height:150%;text-align:left;font-size:11px;color:#a9a9a9;padding-bottom:9px;text-align:center;padding-right:18px;padding-left:18px;padding-top:9px;">
                                                                                                        <div class="kmParagraph" style="padding-bottom:9px">Adiadrian.net</div>
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </center>
    </body>
</html>';
    }

}
