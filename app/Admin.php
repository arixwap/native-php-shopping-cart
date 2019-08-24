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

        view('admin/product-index', $data, $title);
    }

    /**
     * Create new product
     * URL : admin/product-create
     */
    public function productCreate()
    {
        // Initial data
        $product = [
            'id' => null,
            'name' => null,
            'description' => null,
            'quantity' => null,
            'price' => null,
        ];

        $error = false;
        // Store to Database if method POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Assign POST Data
            $product['category_id'] = $category_id = 1;
            $product['name'] = $name = $_POST['name'];
            $product['slug'] = $slug = strtolower(str_replace(' ', '-', $_POST['name']));
            $product['description'] = $description = $_POST['description'];
            $product['quantity'] = $quantity = $_POST['quantity'];
            $product['price'] = $price = $_POST['price'];
            $datetime = date('Y-m-d H:i:s');

            // Insert to database
            $query = $this->db->query("INSERT INTO products (category_id, slug, name, description, quantity, price, created_at, updated_at) VALUES('$category_id', '$slug', '$name', '$description', '$quantity', '$price', '$datetime', '$datetime')");

            if ($query === true) {
                redirect('admin/product?message=success');
            } else {
                $error = $query;
            }
        }
        // -- //

        $title = config('name').' - Create Product';
        $data['title'] = 'Input Product Data';
        $data['product'] = $product;
        $data['submitUrl'] = baseurl('admin/product-create');
        $data['error'] = $error;

        view('admin/product-form', $data, $title);
    }

    /**
     * Edit product
     * URL : admin/product-edit/{{id}}
     */
    public function productEdit($id)
    {
        $error = false;
        // Update to Database if method POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Assign POST Data
            $product['category_id'] = $category_id = 1;
            $product['name'] = $name = $_POST['name'];
            $product['slug'] = $slug = strtolower(str_replace(' ', '-', $_POST['name']));
            $product['description'] = $description = $_POST['description'];
            $product['quantity'] = $quantity = $_POST['quantity'];
            $product['price'] = $price = $_POST['price'];
            $datetime = date('Y-m-d H:i:s');

            // Insert to database
            $query = $this->db->query("UPDATE products SET category_id = '$category_id', name = '$name', slug = '$slug', description = '$description', quantity = '$quantity', price = '$price', updated_at = '$datetime' WHERE id = '$id'");

            if ($query === true) {
                redirect('admin/product?message=success');
            } else {
                $error = $query;
            }
        }
        // -- //

        // Initial data
        $product = $this->db->query("SELECT * FROM products WHERE id = '$id'");
        // Return error 404 if no query result
        if ( ! $product ) {
            view404();
        }
        // -- //
        $product = $product[0];

        $title = config('name').' - Edit '.$product['name'];
        $data['title'] = 'Edit Product Data';
        $data['product'] = $product;
        $data['submitUrl'] = baseurl('admin/product-edit/'.$id);
        $data['error'] = $error;

        view('admin/product-form', $data, $title);
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