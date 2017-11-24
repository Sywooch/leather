<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\H;

class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    // public $verifyCode;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            ['subject', 'safe'],
            // verifyCode needs to be entered correctly
            // ['verifyCode', 'captcha'],
            
        ];
    }
    
    // public function sendEmail($email)
    // {
    //     return Yii::$app->mailer->compose()
    //         ->setTo($email)
    //         ->setFrom([$this->email => $this->name])
    //         ->setSubject($this->subject)
    //         ->setTextBody($this->body)
    //         ->send();
    // }


    public function sendEmail($email)
    {
        $to      = 'sbmd@ukr.net';
        $subject = 'the subject';
        $message = 'hello';
        $headers = 'From: '.$this->email. "\r\n" .
            'Reply-To: info@diano.store' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        return mail($to, $subject, $message, $headers);    
    }
}
