<?php

class Product extends ControllerClass
{
    /**
     * Index of Product
     */
    public function index()
    {
        $data['products'] = 'Create Producs';

        $products = $this->db->query('SELECT * FROM products');
        dd($products);

        // MASIH DEVELOPMENT
        // view('nama-file', $data, config('name'), 'main');
        view('product-form.php');
    }

    /**
     * Create new product
     */
    public function create()
    {
        echo 'Create product';
    }

    /**
     * Insert product into database
     */
    public function store()
    {
        redirect('product');
    }

    /**
     * Edit product
     */
    public function edit($id)
    {
        echo 'Edit Product : '.$id;
    }

    /**
     * Update product into database
     */
    public function update()
    {
        //
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