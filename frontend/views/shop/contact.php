<?php 
    use yii\bootstrap\ActiveForm;
    use common\widgets\Alert;
    use yii\helpers\Html;

    $this->title  = 'Handmade leather goods with custom design and engraving.';
?>
<!-- START: Contact Info -->
<div class="container">
    <div class="nk-gap-5 mnt-10"></div>
    <div class="row vertical-gap">
        <div class="col-lg-5">
            <!-- START: Info -->
            <h2 class="display-4">Contact Info:</h2>
            <div class="nk-gap mnt-3"></div>

            <p>
                We are situated in Ukraine. 
                <br>
                We send orders through our post service and it usually takes about 1.5 week for Europe destinations and 2-3 weeks for USA, Canada, Australia, New Zealand...
                <br>
                Of course if you want fast delivery - we send orders using UPS. It takes 2-4 days for delivery and extra <?= Yii::$app->formatter->asCurrancy(40) ?>-<?= Yii::$app->formatter->asCurrancy(70) ?>.
                <br>
                Payservice: <b>Paypal</b>. Usually we ask customers to place an order on our <a href="https://www.etsy.com/shop/DianoD" target="_blank">Etsy shop</a>. So, it will be easier to discuss all questions there before actuall pay monent. And it easier for further order control.
            </p>

            <ul class="nk-contact-info">
                <li><strong>Email:</strong> info@Example.com</li>
            </ul>
            <!-- END: Info -->
        </div>
        <div class="col-lg-7">
            <?= Alert::widget() ?>
            <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'name')->textInput() ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'email')->textInput() ?>    
                    </div>
                </div>
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Send message', ['class' => 'nk-btn', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="nk-gap-5"></div>
</div>
<!-- END: Contact Info -->