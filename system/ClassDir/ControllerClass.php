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
    public $forceIndex; // Force load index method if selected method not found

    /**
     * Constructor Class
     */
    public function __construct()
    {
        global $db;

        $this->db = $db;
        $this->forceIndex = false;
    }

    /**
     * Output View Function
     *
     * Parameter Args
     * page : (MANDATORY) rendered page file in view/page/
     * param.title : html page title
     * param.layout : main view layout to be used in view/layout
     * param.data : mixed variables to be viewed
     */
    public function view($page, ...$params)
    {
        /**
         * Initial View Variables
         */
        $title = $params[0]['title'] ?? config('name');
        $layout = $params[0]['layout'] ?? 'main';
        $data = $params[0]['data'] ?? null;
        if ( ! is_array($data) ) $data = [$data];

        // Setup string layout directory
        if (strpos($layout, '.php') === false) $layout = $layout.'.php';
        $layout = 'view/layout/'.$layout;

        // Set Page File
        if (strpos($page, '.php') === false) $page = $page.'.php';
        $page = 'view/page/'.$page;

        $_VIEW = [
            'title' => $title,
            'layout' => $layout,
            'page' => $page,
            'data' => $data,
        ];

        // Extract Data Into Output, Unset unused data
        unset($page, $title, $layout);
        extract($data);
        unset($data);

        include($_VIEW['layout']);
    }

    /**
     * Show error 403 forbidden access
     */
    public function error403($title = '403 - Forbidden')
    {
        $this->view('../error/403.php', ['title' => $title]);
        exit();
    }

    /**
     * Show error 404 not found page
     */
    public function error404($title = '404 - Not Found')
    {
        $this->view('../error/404.php', ['title' => $title]);
        exit();
    }
}

?>