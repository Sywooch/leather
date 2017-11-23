<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\H;

/**
 * ContactForm is the model behind the contact form.
 */
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

    /**
     * @inheritdoc
     */
    // public function attributeLabels()
    // {
    //     return [
    //         'verifyCode' => 'Verification Code',
    //     ];
    // }

    
    public function sendEmail($email)
    {
        // H::ddd([$email, $this->email, $this->name, $this->subject, $this->body]);
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
