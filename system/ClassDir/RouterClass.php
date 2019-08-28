<?php

/**
 * Native PHP Router Class
 * Created By : Arix Wap (arix.wap@gmail.com) - 21 Aug 2019
 */

class RouterClass
{
    /**
     * Initial class variables
     */
    protected $classDefault;
    protected $methodDefault;
    protected $controller;

    /**
     * Constructor Class
     * URI Router to directory app class
     */
    public function __construct()
    {
        global $_CONFIG;

        $this->classDefault = toPascalCase($_CONFIG['index']);
        $this->methodDefault = 'index';
        $this->controller = new ControllerClass();

        /**
         * Check hostname accessed and base url in config
         * Redirect if different
         */
        if ( substr(getUrl(), 0, strlen(baseurl())) != baseurl() ) {
            redirect($_SERVER['REQUEST_URI']);
        }
    }

    public function run()
    {
        /**
         * Initial Data
         */
        $classDefault = $this->classDefault;
        $methodDefault = $this->methodDefault;
        $selectedClass = $selectedMethod = null;
        $uriSegments = explodeUri();

        /**
         * Check if Request URI is ClassName
         * Exp : http://base-url.test/uri-class/uri-method/...
         */
        if ( ! empty($uriSegments) && ! $selectedClass ) {

            $className = toPascalCase($uriSegments[0]);

            if ( file_exists('app/'.$className.'.php') ) {

                array_shift($uriSegments);
                include('app/'.$className.'.php');

                $class = new $className();
                $method = $methodDefault;

                if ( ! empty($uriSegments) ) $method = toCamelCase($uriSegments[0]);

                /**
                 * Check method by Uri Request
                 * If not exist, check default method if exist
                 */
                if ( method_exists($class, $method) ) {

                    $selectedClass = $class;
                    $selectedMethod = $method;
                    array_shift($uriSegments);

                } else if ( method_exists($class, $methodDefault) ) {

                    $selectedClass = $class;
                    $selectedMethod = $methodDefault;
                    array_shift($uriSegments);

                }

            }

        }

        /**
         * Check if Request URI is Class Inside Directory
         * Exp : http://base-url.test/...directory/uri-class/uri-method/...
         */
        if ( ! empty($uriSegments) && ! $selectedClass ) {

            $appDirectory = 'app/';

            foreach ($uriSegments as $key => $uri) {

                if ( ! $selectedClass ) {

                    $appDirectory .= $uri.'/';

                    array_shift($uriSegments);

                    if ( ! empty($uriSegments) ) {

                        $className = toPascalCase($uriSegments[0]);

                        if ( file_exists($appDirectory.$className.'.php') ) {

                            array_shift($uriSegments);
                            include($appDirectory.$className.'.php');

                            $class = new $className();
                            $method = $methodDefault;

                            if ( ! empty($uriSegments) ) $method = toCamelCase($uriSegments[0]);

                            /**
                             * Check method by URI Request
                             * If Method Exist, reduce URI Segment array for method parameter
                             */
                            if ( method_exists($class, $method) ) {

                                $selectedClass = $class;
                                $selectedMethod = $method;
                                array_shift($uriSegments);

                            } else if ( method_exists($class, $methodDefault) ) {

                                $selectedClass = $class;
                                $selectedMethod = $methodDefault;

                            }

                        }

                    }

                }

            }

        }

        /**
         * Load Default Class and Method
         * If no URI Request
         * Or no Class were Selected
         * Data URI Segment Reseted
         * Exp : http://base-url.test/
         */
        if ( ! $selectedClass ) {

            $uriSegments = explodeUri(); // Reset Uri Segment
            $className =  toPascalCase($classDefault);

            if ( file_exists('app/'.$className.'.php') ) {

                include('app/'.$className.'.php');

                $class = new $className();
                $method = toCamelCase($methodDefault);
                if ( ! empty($uriSegments) ) $method = toCamelCase($uriSegments[0]);

                if ( method_exists($class, $method) ) {

                    $selectedClass = $class;
                    $selectedMethod = $method;

                } else if ( method_exists($class, $methodDefault) ) {

                    // $selectedClass = $class;
                    // $selectedMethod = $methodDefault;

                }

            }

        }

        /**
         * Load App Class and its Method
         * Return 404 if no class or method selected
         */
        if ( $selectedClass && $selectedMethod ) {

            call_user_func_array([$selectedClass, $selectedMethod], $uriSegments);

        } else {

            $this->controller->error404();

        }

    }

}

?>