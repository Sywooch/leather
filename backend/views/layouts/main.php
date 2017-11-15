<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
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
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container-fluid" style="padding-top: 0px;">
        <div class="row top-header">
            
            <?php if (Yii::$app->user->isGuest): ?>
                <div class="col-md-12"><?= Html::a('Login', ['site/login'])?></div>
            <?php else: ?>
                <?php $url = Yii::$app->urlManagerFront->createUrl(['']) ?>
                <div class="col-md-6 top-header-logo"><?= Html::a('DianoD', $url) ?></div>
                
                <div class="div.col-md-6 pull-right">
                <?php 
                    echo Html::beginForm(['/site/logout'], 'post');
                    echo Html::submitButton('Logout (' . Yii::$app->user->identity->username . ')',['class' => 'btn btn-link logout']);
                    echo Html::endForm();
                ?>
                </div>
            <?php endif ?>
                
        </div>
    </div>    
    <div class="separator"></div>
    <div class="container-fluid">
        <div class="row">            
            <?php if (!Yii::$app->user->isGuest) : ?>
                <div class="col-md-2 col-lg-2 hidden-xs hidden-sm layout-left-sidebar">
                    <div class="sidebar-links">
                        <ul>
                            <hr>
                            <li><?= Html::a('Категории', ['category/index']) ?></li>
                            <hr>
                            <li><?= Html::a('Товары', ['product/index']) ?></li>
                            <hr>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 hidden-lg hidden-md mobile-layout-left-sidebar">
                    <ul>
                        <li><span><a href="<?= Url::to(['category/index']) ?>">Категории</a></span></li>
                        <li><span><a href="<?= Url::to(['product/index']) ?>">Товары</a></span></li>
                    </ul>                    
                </div>
            <?php endif ?>
            <div class="col-md-10 col-xs-12 col-sm-12">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
                <?= $content ?>        
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
