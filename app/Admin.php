<?php

/**
 * Product Controller Class
 *
 * Method called by URI
 * Example : /admin/index will call function index() in this class
 */

class Admin extends ControllerClass
{
    /**
     * Index of Product
     * URL : admin/index
     */
    public function index()
    {
        return $this->product();
    }

    /**
     * Show Product List
     * URL : admin/product
     */
    public function product()
    {
        $title = config('name').' - Product List';

        $data['products'] = $this->db->query('SELECT * FROM products');
        foreach ($data['products'] as $key => $product) {
            if ( ! $product['images'] ) {
                $data['products'][$key]['images'] = baseurl('public/images/empty.png');
            }
        }

        view('product-index', $data, $title);
    }

    /**
     * Create new product
     * URL : admin/product-create
     */
    public function _productCreate()
    {
        //
    }

    /**
     * Edit product
     * URL : admin/product-edit/{{id}}
     */
    public function _productEdit($id)
    {
        //
    }

    /**
     * Delete product
     * URL : admin/product-delete/{{id}}
     */
    public function _productDelete($id)
    {
        //
    }

}

?>