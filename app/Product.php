<?php

class Product extends ControllerClass
{
    /**
     * Index of Product
     */
    public function index()
    {
        echo 'Product Index';
    }

    /**
     * Create new product
     */
    public function create()
    {
        $products = 'Create Producs';

        // echo view('product-form.php');
    }

    /**
     * Insert product into database
     */
    public function store()
    {
        //
    }

    /**
     * Edit product
     */
    public function edit($id)
    {
        echo 'Edit Product : '.$id;
    }

    /**
     * Delete product
     */
    public function delete($id)
    {
        echo 'Delete Product : '.$id;
    }

}

?>