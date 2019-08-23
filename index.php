<?php

/**
 * Configuration Section
 */
$_CONFIG = [

    // Application Name
    'name' => 'Shop Cart',

    // Application Base URL
    'baseurl' => 'localhost/shopping-cart',

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


/**
 * Boot Core System
 */
include 'system/boot.php';

?>