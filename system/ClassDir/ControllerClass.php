<?php

/**
 * Native PHP Controller Class
 * Created By : Arix Wap (arix.wap@gmail.com) - 21 Aug 2019
 */

class ControllerClass
{
    /**
     * Initial Variables
     */
    protected $db;
    protected $route;

    /**
     * Constructor Class
     */
    public function __construct()
    {
        global $_CONFIG, $db, $route;

        $this->db = $db;
        $this->route = $route;
    }
}

?>