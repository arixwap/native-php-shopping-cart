<?php
/**
 * Native PHP Shopping Cart
 * Created By Arix Wap (arix.wap@gmail.com)
 * For Kesato Interview Test - 21 Aug 2019
 */

// Configuration Section
$_CONFIG = [

    // Application Name
    'name' => 'Shop Cart',

    // Application Base URL
    'baseurl' => 'http://localhost/shopping-cart',

    // Index Controller
    'index' => 'home',

    // Database Configuration
    'database' => [
        'host'  => 'localhost',
        'user'  => 'root',
        'pass'  => '',
        'name'  => 'native_php_shopping_cart',
    ],

];


// Boot Core System
include 'system/boot.php';

?>