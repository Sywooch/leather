<?php 
    use common\models\H;
    use yii\helpers\Html;
 ?>
 
 <!-- Etsy Reviews -->

<?php if (!empty($feedbacks)): ?>
    <div class="row multiple-items">
    <?php foreach ($feedbacks as $review): ?>
        <div class="col-md-4 col-xs-12 col-sm-12 slider-item">
            <div class="col-md-12">
                <img src="<?= $review['buyer']['image'] ?>" class="review-buyer-logo" alt="">
                <small>
                    <?= $review['buyer']['name'] ?> on 
                    <b><?= Yii::$app->formatter->asDate($review['creation_tsz']) ?></b>
                </small>
                <br>
                <?php if ((int)$review['value']==1): ?>
                    <span class="fa fa-star review-star-checked"></span>
                    <span class="fa fa-star review-star-checked"></span>
                    <span class="fa fa-star review-star-checked"></span>
                    <span class="fa fa-star review-star-checked"></span>
                    <span class="fa fa-star review-star-checked"></span>
                <?php elseif((int)$review['value']==1): ?>
                    <span class="fa fa-star review-star-checked"></span>
                    <span class="fa fa-star review-star-checked"></span>
                    <span class="fa fa-star review-star-checked"></span>
                    <span class="fa fa-star review-star-checked"></span>
                    <span class="fa fa-star"></span>
                <?php else: ?>
                    <span class="fa fa-star review-star-checked"></span>
                    <span class="fa fa-star review-star-checked"></span>
                    <span class="fa fa-star review-star-checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span>
                <?php endif ?> 
                
            </div>
            <div class="col-md-12">
                <p class="review-message"><?= $review['message'] ?></p>
            </div>
            <div class="col-md-12 review-product">
                <img src="<?= $review['products'][0]['image'] ?>" class="review-product-image" title="<?= $review['products'][0]['title'] ?>" alt="<?= $review['products'][0]['title'] ?>">
                <?= Html::a(H::cutTitle($review['products'][0]['title'],70), "https://www.etsy.com/shop/DianoD/items") ?>
            </div>
        </div>
    <?php endforeach ?>
    </div>
<?php endif ?>
<!-- End etsy reviews -->