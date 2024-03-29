<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i%7cWork+Sans:400,500,700" rel="stylesheet" type="text/css">
    <?php $this->head() ?>

    <meta property="og:url" content="http://diano.store/"  />
    <meta property="og:type" content="article" />
    <meta property="og:locale" content="<?= Yii::$app->language ?>" />
    <meta property="og:title" content="<?= Html::encode($this->title) ?>" />
    <meta property="og:description" content="We are a collaboration of crafters based in Ukraine. Our team has a great experience in creating handmade phone covers, wallets, key holders using custom design and engraving." />
    <meta property="og:image:alt" content="Diano Crafts. Handmade leather covers, holders, wallets. " />
    <meta property="og:site_name" content="Diano Crafts" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-39711007-10"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-39711007-10');
    </script>
    <!-- End google -->
</head>
<body>
<?php $this->beginBody() ?>

    <?= $this->render('_header') ?>
    <div class="nk-main">
        <?= $content ?>
        <footer class="nk-footer">
            <div class="nk-footer-cont">
                <div class="container text-center">
                    <div class="nk-footer-social">
                        <ul>
                            <li><a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>

                    <div class="nk-footer-text">
                        <p><?= Html::a('Sitemap', ['shop/sitemap']) ?></p>
                        <p>info@diano.store</p>
                        
                        <p><?= date('Y') ?> &copy; <small>Code by <?= Html::a("MaksDmytrenko", "https://www.linkedin.com/in/maks-dmytrenko-836736a9/", ['target'=>"_blank"]) ?></small></p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
