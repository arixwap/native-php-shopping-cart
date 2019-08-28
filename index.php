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
    'baseurl' => 'http://localhost/shopping-cart',      // Standar Localhost
    // 'baseurl' => 'http://shopping-cart.test',           // Virtual Host (Laragon)
    // 'baseurl' => 'http://192.168.1.89/shopping-cart',   // LAN IP Address for Mobile Testing

    // Index Controller
    'index' => 'Home',

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