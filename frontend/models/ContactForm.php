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
        $to      = 'sbmd7482@gmail.com';
        $subject = 'New request from contact page';
        
        $message = 'Hello, you got new request from contact page.'."\r\n" .
        $message .= 'Email: '. $this->email."\r\n" .
        $message .= 'Name: '. $this->name."\r\n" .
        $message .= 'Subject: '. $this->subject."\r\n" .
        $message .= 'Message: '. $this->body."\r\n";

        $headers = 'From: info@diano.store'. "\r\n" .
            'Reply-To: info@diano.store' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);

        $to      = $this->email;
        $subject = 'Request from Diano.Store';
        $message = 'Hello. Thank you for your request. Wi will get in touch with you as soon as possible.';
        $headers = 'From: info@diano.store'. "\r\n" .
            'Reply-To: info@diano.store' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        return mail($to, $subject, $message, $headers);
    }
}
