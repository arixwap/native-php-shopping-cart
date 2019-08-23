<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?= $_VIEW['title'] ?></title>
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?= baseurl('public/assets/materialize.min.css') ?>">
    </head>
    <body>
        <!-- Main Content -->
        <?php include($_VIEW['page']) ?>
        <!-- End - Main Content -->
        <script type="text/javascript" src="<?= baseurl('public/assets/materialize.min.js') ?>"></script>
    </body>
</html>