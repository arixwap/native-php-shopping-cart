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

        // Set default image if not set
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

            dump($_FILES);
            dd($_POST);

            // Assign POST Data
            $product['category_id'] = $category_id = filter($_POST['category_id']);
            $product['name'] = $name = filter($_POST['name']);
            $product['slug'] = $slug = toKebabCase(filter($_POST['name']));
            $product['description'] = $description = filter($_POST['description']);
            $product['quantity'] = $quantity = filter($_POST['quantity']);
            $product['price'] = $price = filter($_POST['price']);
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
        $id = filter($id);
        $product = $this->db->query("SELECT * FROM products WHERE id = '$id'");
        if ( ! $product ) view404(); // Return error 404 if no query result
        $product = $product[0];

        $error = false;
        // Update to Database if method POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Assign POST Data
            $product['category_id'] = $category_id = filter($_POST['category_id']);
            $product['name'] = $name = filter($_POST['name']);
            $product['slug'] = $slug = toKebabCase(filter($_POST['name']));
            $product['description'] = $description = filter($_POST['description']);
            $product['quantity'] = $quantity = filter($_POST['quantity']);
            $product['price'] = $price = filter($_POST['price']);
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
        $id = filter($id);
        $this->db->query("DELETE FROM products WHERE id = '$id'");

        redirect('admin/product');
    }

    /**
     * DEVELOPMENT - Save Images
     */
    private function saveImages()
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";

        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
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
            $category['parent_id'] = $parent_id = filter($_POST['parent_id']);
            $category['name'] = $name = filter($_POST['name']);
            $category['slug'] = $slug = toKebabCase(filter($_POST['name']));
            $_POST['description'] = null;
            $category['description'] = $description = filter($_POST['description']);
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
        $id = filter($id);
        $category = $this->db->query("SELECT * FROM categories WHERE id = '$id'");
        if ( ! $category ) view404(); // Return error 404 if no query result
        $category = $category[0];

        $error = false;
        // Store to Database if method POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Assign POST Data
            $category['parent_id'] = $parent_id = filter($_POST['parent_id']);
            $category['name'] = $name = filter($_POST['name']);
            $category['slug'] = $slug = toKebabCase(filter($_POST['name']));
            $_POST['description'] = null;
            $category['description'] = $description = filter($_POST['description']);
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
        $id = filter($id);
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