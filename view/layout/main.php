<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $_VIEW['title'] ?></title>
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="<?=baseurl('public/assets/materialize/materialize.min.css') ?>">
    </head>
    <body>
        <!-- Navigation Menu -->
        <nav class="amber" role="navigation">
            <div class="nav-wrapper container">
                <a id="logo-container" href="<?=baseurl()?>" class="brand-logo">Home</a>
                <ul class="right hide-on-med-and-down">
                    <li><a href="<?=baseurl('product')?>">Product</a></li>
                </ul>
                <ul id="nav-mobile" class="sidenav">
                    <li><a href="<?=baseurl('product')?>">Product</a></li>
                </ul>
                <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
        </nav>
        <!-- End - Navigation Menu -->
        <!-- Main Content -->
        <?php include($_VIEW['page']) ?>
        <!-- End - Main Content -->
        <script src="<?=baseurl('public/assets/jquery/jquery-3.4.1.min.js')?>"></script>
        <script type="text/javascript" src="<?=baseurl('public/assets/materialize/materialize.min.js') ?>"></script>
    </body>
</html>