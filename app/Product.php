<?php

/**
 * Product Controller Class
 */

class Product extends ControllerClass
{
    /**
     * Index of Product
     * URL : {{hostname}}/product
     */
    public function index()
    {
        $title = config('name').' - Product List';

        $data['products'] = $this->db->query('SELECT * FROM products');

        view('product-form.php', $data, $title);
    }

    /**
     * Create new product
     * URL : {{hostname}}/product/create
     */
    public function create()
    {
        echo 'Create product';
    }

    /**
     * Insert product into database
     * URL : {{hostname}}/product/store
     */
    public function store()
    {
        redirect('product');
    }

    /**
     * Edit product
     * URL : {{hostname}}/product/edit/{{id}}
     */
    public function edit($id)
    {
        echo 'Edit Product : '.$id;
    }

    /**
     * Update product into database
     * URL : {{hostname}}/product/update
     */
    public function update()
    {
        redirect('product');
    }

    /**
     * Delete product
     * URL : {{hostname}}/product/delete/{{id}}
     */
    public function delete($id)
    {
        echo 'Delete Product : '.$id;
    }

}

?>