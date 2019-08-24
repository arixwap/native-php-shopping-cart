<?php

/**
 * Shop Class - Home Controller Class
 *
 * Method called by URI
 * Example : /shop/index will call function index() in this class
 */

class Shop
{

    /**
     * Home Page - List Of Product
     * URL : shop/index
     */
    public function index()
    {
        view('home');
    }

    /**
     * Product Detail Page
     * URL : shop/product/{{id}}
     */
    public function _product($id)
    {
        //
    }

    /**
     * Cart Page
     * URL : shop/cart
     */
    public function _cart()
    {
        //
    }

}

?>