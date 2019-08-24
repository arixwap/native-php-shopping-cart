<?php

/**
 * Native PHP Route Class
 * Created By : Arix Wap (arix.wap@gmail.com) - 21 Aug 2019
 */

class RouteClass
{
    /**
     * Initial class variables
     */
    protected $className;
    protected $methodName;

    /**
     * Constructor Class
     *
     * URI Router to directory app class
     *
     * First Segment URI call class name
     * Second Segment URI call class method
     */
    public function __construct($className, $methodName, $paramName)
    {
        global $_CONFIG, $db;

        if ( ! $className ) $className = $_CONFIG['index'];
        if ( ! $methodName ) $methodName = 'index';

        // Check if app class exist
        if ( ! file_exists('app/'.$className.'.php') ) {
            view404();
        }

        // Load app class file
        include('app/'.$className.'.php');
        $class = new $className();

        // Trim URI Segment if GET Query Parameter
        if (strpos($methodName, '?') !== false) {
            $methodName = substr($methodName, 0, strpos($methodName, '?'));
        }

        // Convert URI Segment into method name
        $separator = false;
        if (strpos($methodName, '-') !== false) {
            $separator = '-';
        } else if (strpos($methodName, '_') !== false) {
            $separator = '_';
        }
        // -- //
        if ($separator) {
            foreach (explode($separator, $methodName) as $key => $methodWord) {
                if ($key == 0) {
                    $methodName = $methodWord;
                } else {
                    $methodName .= ucfirst($methodWord);
                }
            }
        }

        // Check if method class exist
        if ( ! method_exists($class, $methodName) ) {
            view404();
        }

        // Load class method
        $class->$methodName($paramName);

    }
}

?>