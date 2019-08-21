<?php

class Product
{
    /**
     * Index of Product
     */
    public function index()
    {
        echo 'Product List';
    }

    /**
     * Create new product
     */
    public function create()
    {
        echo 'Create Product';
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