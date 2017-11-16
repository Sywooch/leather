<?php 
    use yii\bootstrap\ActiveForm;
    use yii\helpers\Url;
    use common\widgets\Alert;
    use yii\helpers\Html;

    $materials = $product->getMaterials();
    $tags = $product->getTags();
 ?>

<div class="container-fluid">
    <div class="nk-portfolio-single nk-portfolio-single-half">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="nk-portfolio-images">
                    <?php foreach ($product->allImages as $image): ?>
                        <img src="<?= $product->showImage(['name'=>$image->name, 'type'=>'lg']) ?>" alt="">    
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="nk-sidebar-sticky" data-offset-top="0">
                    <div class="nk-portfolio-info">
                        <h1 class="nk-portfolio-title display-4"><?= $product->getTitle() ?></h1>
                        <table class="nk-portfolio-details">
                            <tr>
                                <td><strong>Price:</strong></td>
                                <td><?= $product->getPrice() ?></td>
                            </tr>
                            <?php if (!empty($materials)): ?>
                                <tr>
                                    <td><strong>Materiials:</strong></td>
                                    <td>
                                        <?php foreach ($materials as $material): ?>
                                            <span class="product-tag-item"><?= $material ?></span>
                                        <?php endforeach ?>
                                    </td>
                                </tr> 
                            <?php endif ?>
                            <?php if (!empty($tags)): ?>
                                <tr>
                                    <td>
                                        <strong>Tags:</strong>
                                    </td>
                                    <td>
                                        <?php foreach ($tags as $tag): ?>
                                            <span class="product-tag-item"><?= $tag ?></span>
                                        <?php endforeach ?>
                                    </td>
                                </tr>
                            <?php endif ?>
                            <tr>
                                <td><strong>Share:</strong></td>
                                <td>
                                    <a href="#" title="Share page on Facebook" data-share="facebook">Facebook</a>,
                                    <a href="#" title="Share page on Twitter" data-share="twitter">Twitter</a>,
                                    <a href="#" title="Share page on Pinterest" data-share="pinterest">Pinterest</a>
                                </td>
                            </tr>                            
                        </table>
                        <hr>
                        <?= Alert::widget() ?>
                        <h5 class="text-center">Have some question?</h5>
                        <?php $form = ActiveForm::begin(); ?>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'name')->textInput(['placeholder'=>'Your name'])->label(false) ?>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <?= $form->field($model, 'email')->textInput(['placeholder'=>'Your email'])->label(false) ?>  
                                </div>
                            </div>
                            <?= $form->field($model, 'body')->textarea(['rows' => 6, 'placeholder'=>'Message'])->label(false) ?>
                            <div class="form-group">
                                <?= Html::submitButton('Send message', ['class' => 'nk-btn', 'name' => 'contact-button']) ?>
                            </div>
                        <?php ActiveForm::end(); ?>
                        <hr>
                        <div class="nk-portfolio-text"><?= $product->getDescription() ?></div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- START: Pagination -->
<div class="nk-pagination nk-pagination-center">
    <div class="container">
        <!-- <span class="nk-pagination-prev"></span>
        <a class="nk-pagination-center" href="work-3-style-1.html">
            <span class="nk-icon-squares"></span>
        </a> -->
        <!-- <a class="nk-pagination-next" href="work-single-2.html">Next Work <span class="pe-7s-angle-right"></span> </a> -->
    </div>
</div>
<!-- END: Pagination -->