<?php

/**
 * Shope Controller Class
 *
 * Method called by URI
 * Example : /shop/index will call function index() in this class
 */
class Shop extends ControllerClass
{

    /**
     * Home Page - List Of Product
     * URL : shop/index
     */
    public function index()
    {
        $data['products'] = $this->db->query("SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id WHERE products.quantity > 0");

        view('home', $data);
    }

    /**
     * Product Detail Page
     * URL : shop/product/{{id}}
     */
    public function product($id)
    {
        view('example');
    }

    /**
     * Cart Page
     * URL : shop/cart
     */
    public function cart()
    {
        view('example');
    }

}

?>