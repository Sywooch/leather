<?php 
    use yii\helpers\Url;
    use yii\helpers\Html;
?>

<div class="container">
    <!-- START: Filter -->
    <div class="nk-pagination nk-pagination-nobg nk-pagination-center">
        <a href="#nk-toggle-filter">
            <span class="nk-icon-squares"></span>
        </a>
    </div>
    <ul class="nk-isotope-filter nk-isotope-filter nk-isotope-filter-active">     
        <?php for($i=0; $i< count($categories); $i++) : ?>
            <?php $class = $i == 0 ? 'active' : '' ?>
            <li class="<?= $class?>" data-filter="<?= $categories[$i]->id ?>"><?= $categories[$i]->name ?></li>   
        <?php endfor ?>
    </ul>
    <!-- END: Filter -->

    <div class="nk-portfolio-list nk-isotope nk-isotope-3-cols">
    
        <?php foreach ($products as $product): ?>
            <?php foreach ($product->cats as $category): ?>
                <div class="nk-isotope-item" data-filter="<?= $category->id ?>">
                    <div class="nk-portfolio-item nk-portfolio-item-square nk-portfolio-item-info-style-1">
                        <a href="<?= Url::to(['shop/product', 'slug'=>$product->slug, 'id'=>$product->id]) ?>" class="nk-portfolio-item-link"></a>
                        <div class="nk-portfolio-item-image">
                            <div style="background-image: url('<?= $product->showMainImage('sm') ?>');"></div>
                        </div>
                        <div class="nk-portfolio-item-info nk-portfolio-item-info-center text-center">
                            <div>
                                <h2 class="portfolio-item-title h3"><?= $product->getTitle() ?></h2>
                                <!-- <div class="portfolio-item-category"></div> -->
                            </div>
                        </div>
                    </div>
                </div>        
            <?php endforeach ?>
        <?php endforeach ?>

    </div>

    <div class="nk-gap-4"></div>
</div>

<!-- START: Pagination -->
<!-- <div class="nk-pagination nk-pagination-center">
    <a href="#">Load More Works</a>
</div> -->
<!-- END: Pagination -->