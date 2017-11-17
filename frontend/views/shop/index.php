<?php    
    use yii\helpers\Html;
    use yii\helpers\Url;

    $this->title = 'Handmade phone covers, notebook covers, wallets. We make custom design and engraving.';
?>
<!-- START: Digital. Modern. Creative -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="bg-image bg-image-parallax" style="background-image: url('/images/common/1.jpg');"></div>
            <div class="nk-gap-6"></div>
            <div class="nk-gap-6"></div>
            <div class="nk-gap-6"></div>
            <div class="nk-gap-6"></div>
        </div>
        <div class="col-lg-6 col-sm-6">
            <div class="nk-gap-6 mnb-10"></div>

            <div class="nk-box-4 mw-620">
                <h2 class="display-4">Creative. Unique. Handmade.</h2>
                <div class="nk-gap mnt-5"></div>

                <p>
                    We are a collaboration of handmade crafters based in Ukraine. Our team has a great experience in creating handmade covers, wallets, cards and keys holders from high-quality leather. We can create products according to your custom design and add engraving to it. 
                    <br>
                    Please, be free to contact us if you want to <?= Html::a('buy or order custom design', ['shop/contact']) ?>.
                    <br>
                    <b>Our etsy shop:</b> <a href="https://www.etsy.com/shop/DianoD" target="_blank">Etsy</a> 
                </p>

                <div class="mnt-7">
                    <a class="nk-btn-2" href="<?= Url::to(['shop/catalog']) ?>">Our catalog</a>
                </div>
            </div>

            <div class="nk-gap-6"></div>
        </div>
    </div>
</div>
<!-- END: Digital. Modern. Creative -->

<!-- START: Portfolio -->	
<div class="container-fluid">
    <div class="nk-portfolio-list nk-isotope nk-isotope-3-cols">
    	<?php if ($products): ?>
			<?php foreach ($products as $product): ?>
				<div class="col-sm-6 nk-isotope-item" data-filter="">
	                <div class="nk-portfolio-item nk-portfolio-item-info-style-1">
	                    <a href="<?= Url::to(['shop/product', 'id'=>$product->id, 'slug'=>$product->slug]) ?>" class="nk-portfolio-item-link"></a>
	                    <div class="nk-portfolio-item-image">
	                        <div style="background-image: url('<?= $product->showMainImage('sm') ?>');"></div>
	                    </div>
	                    <div class="nk-portfolio-item-info nk-portfolio-item-info-center text-center">
	                        <div>
	                            <h2 class="portfolio-item-title h3"><?= $product->title?></h2>
	                            <div class="portfolio-item-category"></div>
	                        </div>
	                    </div>
	                </div>
	            </div>
			<?php endforeach ?>
		<?php endif ?>
    </div>
</div>
<!-- END: Portfolio -->


<!-- START: Pagination -->
<div class="nk-pagination nk-pagination-center">
    <a href="<?= Url::to(['shop/catalog']) ?>">More Works...</a>
</div>
<!-- END: Pagination -->