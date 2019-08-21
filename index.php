<?php

/**
 * Boot Core System
 */
include 'system/boot.php';

echo getUrl();
echo '<br>';
echo getUrl(0);
echo '<br>';
echo getUrl(1);
echo '<br>';
echo getUrl(2);
echo '<br>';
echo getUrl(-3);
echo '<br>';

?>