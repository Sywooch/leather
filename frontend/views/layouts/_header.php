<?php 
    use yii\helpers\Html;
    use yii\helpers\Url;
?>
<header class="nk-header nk-header-opaque">
        <!--
        START: Navbar

        Additional Classes:
            .nk-navbar-lg
            .nk-navbar-sticky
            .nk-navbar-autohide
            .nk-navbar-transparent
            .nk-navbar-transparent-always
            .nk-navbar-white-text-on-top
    -->
    <nav class="nk-navbar nk-navbar-top">
        <div class="container">
            <div class="nk-nav-table">

                <a href="<?= Url::to(['shop/index']) ?>" class="main-logo nk-nav-logo">Diano
                    <!-- <img src="assets/images/logo.svg" alt="" width="85"> -->
                </a>


                <ul class="nk-nav nk-nav-right hidden-md-down" data-nav-mobile="#nk-nav-mobile">
                    <li><a href="<?= Url::to(['shop/catalog']) ?>">Products</a></li>
                    <li><a href="<?= Url::to(['shop/contact']) ?>">Contact</a></li>
                    <?php  if (!Yii::$app->user->isGuest) :?>
                        <li><a href="/ecrire">Admin</a></li>
                    <?php endif ?>
                </ul>

                <ul class="nk-nav nk-nav-right nk-nav-icons">

                    <li class="single-icon hidden-lg-up">
                        <a href="#" class="nk-navbar-full-toggle">
                            <span class="nk-icon-burger">
                                <span class="nk-t-1"></span>
                                <span class="nk-t-2"></span>
                                <span class="nk-t-3"></span>
                            </span>
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
        <!-- END: Navbar -->

</header>




    <!--
    START: Navbar Mobile

    Additional Classes:
        .nk-navbar-align-center
        .nk-navbar-align-right
-->
    <nav class="nk-navbar nk-navbar-full nk-navbar-align-center" id="nk-nav-mobile">
        <div class="nk-navbar-bg">
            <div class="bg-image" style="background-image: url('/images/common/bg-menu.jpg')"></div>
        </div>
        <div class="nk-nav-table">
            <div class="nk-nav-row">
                <div class="container">
                    <div class="nk-nav-header">

                        <div class="nk-nav-logo">
                            <a href="<?= Url::to(['shop/index']) ?>" class="nk-nav-logo">Diano
                                <!-- <img src="assets/images/logo-light.svg" alt="" width="85"> -->
                            </a>
                        </div>

                        <div class="nk-nav-close nk-navbar-full-toggle">
                            <span class="nk-icon-close"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nk-nav-row-full nk-nav-row">
                <div class="nano">
                    <div class="nano-content">
                        <div class="nk-nav-table">
                            <div class="nk-nav-row nk-nav-row-full nk-nav-row-center nk-navbar-mobile-content">
                                <ul class="nk-nav">
                                    <!-- Here will be inserted menu from [data-mobile-menu="#nk-nav-mobile"] -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nk-nav-row">
                <div class="container">
                    <div class="nk-nav-social">
                        <ul>
                            <li><a href="https://twitter.com/nkdevv"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://www.facebook.com/unvabdesign/"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://dribbble.com/_nK"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="https://www.instagram.com/unvab/"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Navbar Mobile -->