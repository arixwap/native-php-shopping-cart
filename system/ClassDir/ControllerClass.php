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
    protected $session;

    /**
     * Constructor Class
     */
    public function __construct()
    {
        global $_CONFIG, $db;

        $this->db = $db;
    }
}

?>