<?php

/**
 * Check or redirect to Base URL if request URL is doesn't match
 */
if ( substr(getUrl(), 0, strlen(baseurl())) != baseurl() ) {
    redirect($_SERVER['REQUEST_URI']);
}


/**
 * Load Route Class
 */
new RouteClass(Uri(0), Uri(1), Uri(2));

?>