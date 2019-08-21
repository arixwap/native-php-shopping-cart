<?php

/**
 * Data Dump and Exit
 */
function dd($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    exit();
}

/**
 * Redirect function
 */
function redirect($url = null)
{
    if ($url) {

        // Add http
        if (strpos($url, 'http') === false) {
            $url = 'http://'.$url;
        }

        header("Location: ".$url);
        exit();

    }
}

/**
 * Helper for create Application URL
 */
function baseurl($suffix = null)
{
    global $config;
    $baseurl = $config['baseurl'];

    // remove last '/' on baseurl
    if ( substr($baseurl, -1) == '/' ) {
        $baseurl = substr($baseurl, 0, (strlen($baseurl) - 1) );
    }

    // remove multiple url slashes on $suffix
    $suffix = preg_replace('/(\/+)/', '/', $suffix);

    // remove first '/' on $suffix
    if ( substr($suffix, 0, 1) == '/' ) {
        $suffix = substr($suffix, 1, strlen($suffix));
    }

    if ($suffix) {
        return $baseurl.'/'.$suffix;
    } else {
        return $baseurl;
    }
}

/**
 * Get current accessed URL
 */
function getUrl($segment = null)
{
    $baseurl = baseurl();
    $url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    $requestUri = str_replace($baseurl, '', $url);

    // remove first slashes '/'
    $requestUri = substr($requestUri, 1, strlen($requestUri));

    // return only URI segment if defined
    if ($segment !== null && $segment >= 0) {
        $requestUri = explode('/', $requestUri);
        return $requestUri[$segment] ?? false;
    }

    return $url;
}

/**
 * Redirect to Base URL if current url is miss match
 */
function redirectBaseUrl()
{
    $baseurl = baseurl();
    $currentBaseUrl = substr(getUrl(), 0, strlen(baseurl()));

    if ($baseurl != $currentBaseUrl) {
        redirect(baseurl($_SERVER['REQUEST_URI']));
    }
}

?>