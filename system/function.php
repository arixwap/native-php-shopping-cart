<?php

/**
 * Get Config Data
 *
 * Multidimensional array search using '.' notation
 * Example : 'array.array.array'
 */
function config($search)
{
    global $_CONFIG;

    $result = $_CONFIG[$search];

    if ( strpos($search, '.') !== false ) {

        foreach (explode('.', $search) as $key) {

            $result = null;
            if ( isset($_CONFIG[$key]) ) {
                $result = $_CONFIG = $_CONFIG[$key];
            }

        }

    }

    return $result;
}

/**
 * Data Dump
 */
function dump($data, $vardump = false)
{
    echo "<pre>";

    if ($vardump)
        var_dump($data);
    else
        print_r($data);

    echo "</pre>";
}

/**
 * Data Dump and Exit
 */
function dd($data, $vardump = false)
{
    dump($data, $vardump);
    exit();
}

/**
 *
 */
function url($url)
{
    if (strpos($url, 'http') === false) {
        $url = 'http://'.$url;
    }

    return $url;
}

/**
 * Helper for create Application URL
 */
function baseurl($suffix = null)
{
    global $_CONFIG;
    $baseurl = $_CONFIG['baseurl'];

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
    $url = url($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
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
 * Get current accessed URI
 */
function Uri($segment = 0)
{
    return getUrl($segment);
}

/**
 * Redirect to External Link
 */
function redirectExternal($url = null)
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
 * Redirect to Base URL with URI segment
 */
function redirect($uri = null)
{
    redirectExternal(baseurl($uri));
}

/**
 * Output View Function
 *
 * page : rendered page file in view/page/
 * data : mixed variables to be viewed
 * title : html page title
 * layout : main view layout to be used in view/layout
 */
function view($page, $data = [], $title = null, $layout = null)
{
    // Set page title
    $_VIEW['title'] = $title ?? config('name');

    // Set page layout file
    if ($layout) {
        if (strpos($layout, '.php') === false) $layout = $layout.'.php';
        $_VIEW['layout'] = 'view/layout/'.$layout;
    } else {
        $_VIEW['layout'] = 'view/layout/main.php';
    }

    // Set Page File
    if (strpos($page, '.php') === false) $page = $page.'.php';
    $_VIEW['page'] = 'view/page/'.$page;

    // Extract Data Into Output, Unset unused data
    unset($page, $title, $layout);
    if ($data != null) extract($data);
    unset($data);

    include($_VIEW['layout']);
}

/**
 * Show error 404 not found page
 */
function view404($title = '404 - Not Found')
{
    view('../error/404.php', null, $title);
    exit();
}

/**
 * Show error 403 forbidden access
 */
function pageForbidden($title = '403 - Forbidden')
{
    view('../error/403.php', null, $title);
    exit();
}

/**
 * Function convert string to snake_case
 */
function toSnakeCase($string)
{
    preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $string, $words);
    $words = $words[0];
    foreach ($words as &$word) {
        $word = ($word == strtoupper($word)) ? strtolower($word) : lcfirst($word);
    }

    return implode('_', $words);
}

/**
 * Function convert string to kebab-case
 */
function toKebabCase($string)
{
    return str_replace('_', '-', toSnakeCase($string));
}

/**
 * Function convert string to camelCase
 */
function toCamelCase($string)
{
    $words = explode('_', toSnakeCase($string));
    foreach ($words as $key => $word) {
        $words[$key] = ucfirst($word);
    }
    $words[0] = lcfirst($words[0]);

    return implode('', $words);
}

/**
 * Function convert string to PascalCase
 */
function toPascalCase($string)
{
    return ucfirst(toCamelCase($string));
}

/**
 * Filter data from input  request
 */
function filter($input)
{
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

?>