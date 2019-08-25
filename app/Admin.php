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

        $data['products'] = $this->db->query('SELECT products.*, categories.name AS category_name FROM products JOIN categories ON products.category_id = categories.id');
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
            'category_id' => null,
            'name' => null,
            'description' => null,
            'quantity' => null,
            'price' => null,
        ];

        $error = false;
        // Store to Database if method POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Assign POST Data
            $product['category_id'] = $category_id = $_POST['category_id'];
            $product['name'] = $name = $_POST['name'];
            $product['slug'] = $slug = strtolower(str_replace(' ', '-', $_POST['name']));
            $product['description'] = $description = null;
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

        // Fetch Categories
        $data['categories'] = $this->db->query("SELECT * FROM categories");

        $title = config('name').' - Create Product';
        $data['title'] = 'Input Product';
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
        // Initial data
        $product = $this->db->query("SELECT * FROM products WHERE id = '$id'");
        if ( ! $product ) view404(); // Return error 404 if no query result
        $product = $product[0];

        $error = false;
        // Update to Database if method POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Assign POST Data
            $product['category_id'] = $category_id = $_POST['category_id'];
            $product['name'] = $name = $_POST['name'];
            $product['slug'] = $slug = strtolower(str_replace(' ', '-', $_POST['name']));
            $product['description'] = $description = null;
            $product['quantity'] = $quantity = $_POST['quantity'];
            $product['price'] = $price = $_POST['price'];
            $datetime = date('Y-m-d H:i:s');

            // Update to database
            $query = $this->db->query("UPDATE products SET category_id = '$category_id', name = '$name', slug = '$slug', description = '$description', quantity = '$quantity', price = '$price', updated_at = '$datetime' WHERE id = '$id'");

            if ($query === true) {
                redirect('admin/product?message=success');
            } else {
                $error = $query;
            }
        }

        // Fetch Categories
        $data['categories'] = $this->db->query("SELECT * FROM categories");

        $title = config('name').' - Edit '.$product['name'];
        $data['title'] = 'Edit Product';
        $data['product'] = $product;
        $data['submitUrl'] = baseurl('admin/product-edit/'.$id);
        $data['error'] = $error;

        view('admin/product-form', $data, $title);
    }

    /**
     * Delete product
     * URL : admin/product-delete/{{id}}
     */
    public function productDelete($id)
    {
        $this->db->query("DELETE FROM products WHERE id = '$id'");

        redirect('admin/product');
    }

    /**
     * Show Category List
     * URL : admin/category
     */
    public function category()
    {
        $title = config('name').' - Category List';

        $data['categories'] = $this->db->query('SELECT * FROM categories');

        view('admin/category-index', $data, $title);
    }

    /**
     * Create new category
     * URL : admin/category-create
     */
    public function categoryCreate()
    {
        // Initial data
        $category = [
            'id' => null,
            'parent_id' => null,
            'name' => null,
            'description' => null,
        ];

        $error = false;
        // Store to Database if method POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Assign POST Data
            $category['parent_id'] = $parent_id = $_POST['parent_id'];
            $category['name'] = $name = $_POST['name'];
            $category['slug'] = $slug = strtolower(str_replace(' ', '-', $_POST['name']));
            $category['description'] = $description = null;
            $datetime = date('Y-m-d H:i:s');

            // Insert to database
            $query = $this->db->query("INSERT INTO categories (parent_id, slug, name, description, created_at, updated_at) VALUES('$parent_id', '$slug', '$name', '$description', '$datetime', '$datetime')");

            if ($query === true) {
                redirect('admin/category?message=success');
            } else {
                $error = $query;
            }
        }

        // Get Parent Category
        $data['parentCategories'] = [];
        $query = $this->db->query('SELECT * FROM categories');
        if ($query) $data['parentCategories'] = $query;

        $title = config('name').' - Create Category';
        $data['title'] = 'Input Category';
        $data['category'] = $category;
        $data['submitUrl'] = baseurl('admin/category-create');
        $data['error'] = $error;

        view('admin/category-form', $data, $title);
    }

    /**
     * Edit category
     * URL : admin/category-edit
     */
    public function categoryEdit($id)
    {
        // Initial data
        $category = $this->db->query("SELECT * FROM categories WHERE id = '$id'");
        if ( ! $category ) view404(); // Return error 404 if no query result
        $category = $category[0];

        $error = false;
        // Store to Database if method POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Assign POST Data
            $category['parent_id'] = $parent_id = $_POST['parent_id'];
            $category['name'] = $name = $_POST['name'];
            $category['slug'] = $slug = strtolower(str_replace(' ', '-', $_POST['name']));
            $category['description'] = $description = null;
            $datetime = date('Y-m-d H:i:s');

            // Update to database
            $query = $this->db->query("UPDATE categories SET parent_id = '$parent_id', slug = '$slug', name = '$name', description = '$description', updated_at = '$datetime' WHERE id = '$id'");

            if ($query === true) {
                redirect('admin/category?message=success');
            } else {
                $error = $query;
            }
        }

        // Get Parent Category
        $data['parentCategories'] = [];
        $query = $this->db->query('SELECT * FROM categories');
        if ($query) $data['parentCategories'] = $query;

        $title = config('name').' - Edit '.$category['name'];
        $data['title'] = 'Edit Category';
        $data['category'] = $category;
        $data['submitUrl'] = baseurl('admin/category-edit/'.$id);
        $data['error'] = $error;

        view('admin/category-form', $data, $title);
    }

    /**
     * Delete category
     * URL : admin/category-delete/{{id}}
     */
    public function categoryDelete($id)
    {
        $this->db->query("DELETE FROM categories WHERE id = '$id'");

        redirect('admin/category');
    }

    /**
     * Index of Order
     * URL : admin/order
     */
    public function order()
    {
        $title = config('name').' - Order List';

        $data['orders'] = $this->db->query('SELECT * FROM orders');

        view('admin/order-index', $data, $title);
    }

}

?>