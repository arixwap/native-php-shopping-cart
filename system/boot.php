<?php

/**
 * Load PHP Class, Function, Configuration
 */
include('system/ClassDir/Database.php');
include('system/config.php');
include('system/function.php');

/**
 * Check or redirect to Base URL if request URL is doesn't match
 */
redirectBaseUrl();

/**
 * Database Connection Start
 */
$db = new Database(
    $config['database']['host'],
    $config['database']['user'],
    $config['database']['pass'],
    $config['database']['name']
);

?>