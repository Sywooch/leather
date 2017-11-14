<?php    
    use yii\helpers\Html;
    use yii\helpers\Url;
?>
<!-- START: Digital. Modern. Creative -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="bg-image bg-image-parallax" style="background-image: url('/theme/snow/dist/assets/images/home-1.jpg');"></div>
            <div class="nk-gap-6"></div>
            <div class="nk-gap-6"></div>
            <div class="nk-gap-6"></div>
            <div class="nk-gap-6"></div>
        </div>
        <div class="col-lg-6">
            <div class="nk-gap-6 mnb-10"></div>

            <div class="nk-box-4 mw-620">
                <h2 class="display-4">Digital. Modern. Creative</h2>
                <div class="nk-gap mnt-5"></div>

                <p>We are a new design studio based in USA. We have over 20 years of combined experience, and know a thing or two about designing websites and mobile apps.</p>

                <div class="mnt-7">
                    <a class="nk-btn-2" href="page-contact-us.html">Work with us now</a>
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
				<div class="nk-isotope-item" data-filter="2">
	                <div class="nk-portfolio-item nk-portfolio-item-info-style-1">
	                    <a href="work-single-3.html" class="nk-portfolio-item-link"></a>
	                    <div class="nk-portfolio-item-image">
	                        <div style="background-image: url('<?= $product->showMainImage('md') ?>');"></div>
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
    <a href="<?= Url::to(['shop/catalog']) ?>">Load More Works</a>
</div>
<!-- END: Pagination -->