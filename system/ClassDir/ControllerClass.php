<?php

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