<?php 
    use yii\bootstrap\ActiveForm;
    use common\widgets\Alert;
    use yii\helpers\Html;
?>
<!-- START: Contact Info -->
<div class="container">
    <div class="nk-gap-5 mnt-10"></div>
    <div class="row vertical-gap">
        <div class="col-lg-5">
            <!-- START: Info -->
            <h2 class="display-4">Contact Info:</h2>
            <div class="nk-gap mnt-3"></div>

            <p>Praesent interdum congue mauris, et fringilla lacus pel vitae. Quisque nisl mauris, aliquam eu ultrices vel, conse vitae sapien at imperdiet risus. Quisque cursus risus id. fermentum, in auctor quam consectetur.</p>

            <ul class="nk-contact-info">
                <li>
                    <strong>Address:</strong> 10111 Santa Monica Boulevard, LA</li>
                <li>
                    <strong>Phone:</strong> +44 987 065 908</li>
                <li>
                    <strong>Email:</strong> info@Example.com</li>
                <li>
                    <strong>Fax:</strong> +44 987 065 909</li>
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