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
