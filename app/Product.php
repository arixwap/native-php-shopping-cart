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
        foreach ($data['products'] as $key => $product) {
            if ( ! $product['images'] ) {
                $data['products'][$key]['images'] = baseurl('public/images/empty.png');
            }
        }

        view('product-index', $data, $title);
    }

    /**
     * Create new product
     * URL : {{hostname}}/product/create
     */
    public function create()
    {
        view('product-form');
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