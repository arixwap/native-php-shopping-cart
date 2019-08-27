<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title><?= $_VIEW['title'] ?></title>
    <link rel="shortcut icon" href="<?=baseurl('public/icon.ico')?>" type="image/x-icon"/>
    <meta name="robots" content="noindex, nofollow">
    <link href="<?=baseurl('public/assets/materialize/icon.css?family=Material+Icons')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=baseurl('public/assets/materialize/materialize.min.css') ?>">
    <link rel="stylesheet" href="<?=baseurl('public/assets/w3/w3.css') ?>">
    <link rel="stylesheet" href="<?=baseurl('public/assets/style.css') ?>">
</head>
<body>
    <!-- Navigation Menu -->
    <nav class="light-blue lighten-1 text-space" role="navigation">
        <div class="nav-wrapper container"><a id="logo-container" href="<?=baseurl()?>" class="brand-logo">Native Cart</a>
            <!-- Main Menu -->
            <ul class="right hide-on-med-and-down">
                <li><a href="<?=baseurl('admin/product')?>">Admin</a></li>
                <li><a href="<?=baseurl('cart')?>"><i class="material-icons">shopping_cart</i></a></li>
            </ul>
            <!-- Mobile Menu -->
            <ul id="nav-mobile" class="sidenav">
                <li><a href="<?=baseurl('cart')?>">Cart <i class="material-icons">shopping_cart</i></a></li>
                <li><a href="<?=baseurl('admin/product')?>">Admin <i class="material-icons">people</i></a></li>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    <!-- End - Navigation Menu -->
    <div class="main-container">
        <!-- Main Coontent Start Here -->
        <?php include($_VIEW['page']) ?>
        <!-- End of Main Coontent -->
    </div>
    <footer class="page-footer orange">
        <div class="container">
            <div class="row">
                <div class="col l8 s12">
                    <h5 class="white-text text-space">Native Shopping Cart</h5>
                    <p class="grey-text text-lighten-4">This is a simple shopping cart, made using native PHP. CSS Framework using Materialize and some little JQuery</p>
                </div>
                <div class="col l4 s12 text-space">
                    <h5 class="white-text">Admin</h5>
                    <ul class="menu-footer">
                        <li><a class="white-text" href="<?=baseurl('admin/product')?>">Product</a></li>
                        <li><a class="white-text" href="<?=baseurl('admin/category')?>">Category</a></li>
                        <li><a class="white-text" href="<?=baseurl('admin/order')?>">Order</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">Native PHP Shopping Cart © 2019</div>
        </div>
    </footer>
    <!--  Scripts-->
    <script type="text/javascript" src="<?=baseurl('public/assets/jquery/jquery-3.4.1.min.js')?>"></script>
    <script type="text/javascript" src="<?=baseurl('public/assets/materialize/materialize.min.js')?>"></script>
    <script type="text/javascript" src="<?=baseurl('public/assets/main.js')?>"></script>
  </body>
</html>
