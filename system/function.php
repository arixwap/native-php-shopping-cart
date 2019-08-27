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

            if ( isset($_CONFIG[$key]) ) $result = $_CONFIG = $_CONFIG[$key];

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
 * Data Dump in Json Encode Output
 */
function ddjson($data)
{
    echo json_encode($data);
    exit();
}

/**
 * Add prefix 'http' to Url string
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
 * Trim : Remove Get (?) Parameter in URL
 */
function getUrl($trim = false)
{
    $baseurl = baseurl();
    $url = url($_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
    $url = filter_var($url, FILTER_SANITIZE_URL);

    // Trim Get Parameter
    if ( $trim && (strpos($url, '?') !== false) ) $url = substr($url, 0, strpos($url, '?'));

    return $url;
}

/**
 * Get current accessed URI
 * $Segment parameter : Index Segment (Number), True = All Segment in String
 */
function uri($segment = false)
{
    $baseurl = baseurl();
    $url = getUrl(true);
    $uri = str_replace($baseurl, '', $url);

    // Trim Uri from end of '?' (GET Request) character
    if (strpos($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));

    // return only URI segment if defined
    if ($segment !== false && $segment >= 0) {

        $uri = explode('/', $uri);
        $uri = array_values( array_filter($uri) );

        return $uri[$segment] ?? false;
    }

    return $uri;
}

/**
 * Copy Function uri()
 */
function getUri($segment = false)
{
    return uri($segment);
}

/**
 * Return URI into array key of segment
 * $Segment parameter : Index Segment (Number), True = All Segment in Array
 */
function explodeUri($segment = true)
{
    $uri = explode('/', uri());
    $uri = array_filter($uri); // Filter Empty Array
    $uri = array_values($uri); // Reorder Array Index

    // return only URI segment if defined
    if ($segment !== true) return $uri[$segment] ?? false;

    return $uri;
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
 * Make Random String Function
 */
function randomString($length = 10, $chars = null)
{
    if ( ! $chars ) $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= $chars[rand(0, strlen($chars) - 1)];
    }

    return $string;
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
 * Filter data from input request
 */
function filter($input)
{
    if (is_array($input)) return false;

    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

/**
 * Parse string / array into Image Url
 */
function getImages($images, $all = false, $default = 'none')
{
    // Decode to JSON Array Image
    if ( ! is_array($images) ) {
        $images = json_decode($images);
    }

    // Check and return if images is Array
    if (is_array($images)) {
        return $all ? $images : $images[0];
    }

    // Set default image if not set
    if ($default == 'none') {
        $default = baseurl('public/images/empty.png');
    }

    return $all ? [] : $default;
}

function getImage($images, $all = false, $default = 'none')
{
    return getImages($images, $all, $default);
}

/**
 * Break Array into smaller part
 * For Loop in Grid Content
 */
function chunk($array, $max = 1)
{
    if ( ! is_array($array) || $max < 1 )  return [];

    $chunks = [];
    $index = 0;
    $i = 0;
    foreach ($array as $value) {
        $chunks[$index][] = $value;
        $i++;
        if ($i >= $max) {
            $index++;
            $i = 0;
        }
    }

    return $chunks;
}

/**
 * Return array use key with value of given key
 */
function keyBy($array, $setKey)
{
    if (is_array($array)) {

        $newArray = [];

        foreach ($array as $nest) {

            if (is_array($nest) && isset($nest[$setKey])) {
                $value = $nest[$setKey];
                $newArray[$value] = $nest;
            }

        }

        return $newArray;
    }

    return false;
}

/**
 * Return all of the values for a given key
 */
function pluck($array, $setKey, $filter = false)
{
    if (is_array($array)) {

        $newArray = [];

        foreach ($array as $nest) {

            if (is_array($nest) && isset($nest[$setKey])) {
                // filter or not to prevent from hacker attack
                $newArray[] = ($filter) ? filter($nest[$setKey]) : $nest[$setKey];
            }

        }

        return $newArray;
    }

    return false;
}

/**
 * Get session name in beautiful ways
 * Autoset value if session is not exist
 */
function getSession($name = null, $setValue = null)
{
    // Check session and start if not
    if (session_status() != 2) session_start();

    // Set session value if not set
    if ( ! isset($_SESSION[$name]) && $setValue != null ) {
        setSession($name, $setValue);
    }

    // Return all session data
    if ( $name == null) {
        return $_SESSION;
    }

    return $_SESSION[$name] ?? null;
}

/**
 * Set session name in beautiful ways
 */
function setSession($name, $value)
{
    // Check session and start if not
    if (session_status() != 2) session_start();

    return $_SESSION[$name] = $value;
}

/**
 * Delete session
 */
function unsetSession($name)
{
    // Check session and start if not
    if (session_status() != 2) session_start();

    $session = getSession($name);
    if (isset($session)) {
        unset($_SESSION[$name]);
        return true;
    }

    return false;
}

?>