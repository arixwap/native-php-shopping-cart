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
            return $this->pageNotFound();
        }

        // Load app class file
        include('app/'.$className.'.php');
        $class = new $className();

        // Check if method class exist
        if ( ! method_exists($class, $methodName) ) {
            return $this->pageNotFound();
        }

        // Load class method
        $class->$methodName($paramName);

    }

    public function pageNotFound()
    {
        include('view/error/404.php');
        exit();
    }
}

?>