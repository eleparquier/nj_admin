<?php /** @var Menu $menu */ ?><!DOCTYPE HTML>
<html>
<head>
    <title>N-J</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <script src="<?php echo fr\gilman\nj\Conf::common()['urlAdmin']['js']; ?>/jquery.js"></script>
    <script src="<?php echo fr\gilman\nj\Conf::common()['urlAdmin']['js']; ?>/pages/login.js"></script>
    <link rel="stylesheet" href="<?php echo fr\gilman\nj\Conf::common()['urlAdmin']['css']; ?>/main.css" />
    <link rel="stylesheet" href="<?php echo fr\gilman\nj\Conf::common()['urlAdmin']['css']; ?>/bootstrap.css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        var BASE_URL = '<?php echo $BASE_URL; ?>';
        var JS_URL = '<?php echo $JS_URL; ?>';
        var CSS_URL = '<?php echo $CSS_URL; ?>';
        var IMAGES_URL = '<?php echo $IMAGES_URL; ?>';
    </script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="navbar navbar-default">
                <ul class="nav navbar-nav">
                    <?php foreach($menu as $item) { /** @var \fr\gilman\nj\MenuItem $item */ ?>
                        <li <?php if($item->isActive()) { ?>class="active"<?php } ?>><a href="<?php echo $item->getHref(); ?>"><?php echo $item->getText(); ?></a> </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="col-md-7">
            <?php if(\fr\gilman\nj\SessionBusiness::isConnected()) { ?>
                <div class="col-sm-4 col-sm-offset-8">
                    <?php echo \fr\gilman\nj\SessionBusiness::getCookieSession()->getUtilisateur()->getNom(); ?> - <a href="<?php echo fr\gilman\nj\Conf::common()['urlAdmin']['base']; ?>/index.php?page=Admin&action=deco">Déconnexion</a>
                    <?php if(\fr\gilman\nj\SessionBusiness::enPartie()) { ?>
                        <br />
                        <a href="<?php echo fr\gilman\nj\Conf::common()['urlAdmin']['base']; ?>/index.php?page=Admin&action=retourAccueil">Retour accueil</a>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <form class="form-inline pull-right login">
                    <div class="col-sm-4">
                        <div class="form_group loginPourError">
                            <input type="text" class="form-control input-md" style="text-align:right" name="login" id="login" value="" placeholder="login">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group loginPourError">
                            <input type="password" class="form-control input-md" style="text-align:right" name="password" id="password" value="" placeholder="pass">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="btLogin">Login</button>
                            </span>
                            <span class="input-group-btn">
                                <a href="<?php echo fr\gilman\nj\Conf::common()['urlAdmin']['base']; ?>/index.php?page=Admin&action=inscription" class="btn btn-default" type="button">Inscription</a>
                            </span>
                        </div>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>