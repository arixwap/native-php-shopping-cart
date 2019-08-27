<?php

/**
 * Product Controller Class
 *
 * Method called by URI
 * Example : /admin/product will call function index() in this class
 */
class Product extends ControllerClass
{
    /**
     * Index of Product - Show Product List
     * URL : admin/product/index
     */
    public function index()
    {
        $title = config('name').' - Product List';

        $data['products'] = $this->db->query('SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON products.category_id = categories.id');

        $this->view('admin/product-index', ['data' => $data, 'title' => $title]);
    }

    /**
     * Create new product
     * URL : admin/product/create
     */
    public function create()
    {
        // Initial data
        $product = [
            'id' => null,
            'category_id' => null,
            'name' => null,
            'description' => null,
            'quantity' => null,
            'price' => null,
            'images' => null,
        ];

        $error = false;
        $validation = true;

        // Store to Database if method POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Assign POST Data
            $product['category_id'] = $category_id = filter($_POST['category_id']);
            $product['name'] = $name = filter($_POST['name']);
            $product['slug'] = $slug = toKebabCase(filter($_POST['name']));
            $product['description'] = $description = filter($_POST['description']);
            $product['quantity'] = $quantity = filter($_POST['quantity']);
            $product['price'] = $price = filter($_POST['price']);
            $now = date('Y-m-d H:i:s');
            $images = null;

            // Upload Images
            if (isset($_FILES['images']['name'])) {

                $upload = $this->uploadImages($_FILES['images'], $slug);

                if ( $upload['status'] == true ) {
                    $images = json_encode($upload['files']);
                } else {
                    $validation = false;
                    $error = $upload['response'];
                }
            }

            if ($validation) {
                // Insert to database
                $query = $this->db->query("INSERT INTO products (category_id, slug, name, description, quantity, price, images, created_at, updated_at) VALUES('$category_id', '$slug', '$name', '$description', '$quantity', '$price', '$images', '$now', '$now')");

                if ($query === true) {
                    redirect('admin/product?message=success');
                } else {
                    dump($query);
                    $error = $query;
                }
            }
        }

        $title = config('name').' - Create Product';
        $data['title'] = 'Input Product';
        $data['product'] = $product;
        $data['categories'] = $this->db->query("SELECT * FROM categories");
        $data['submitUrl'] = baseurl('admin/product/create');
        $data['error'] = $error;

        $this->view('admin/product-form', ['data' => $data, 'title' => $title]);
    }

    /**
     * Edit product
     * URL : admin/product/edit/{{id}}
     */
    public function edit($id = null)
    {
        // Initial data
        $id = filter($id);
        $product = $this->db->query("SELECT * FROM products WHERE id = '$id'");

        // Return error 404 if no query result
        if ( ! $product ) {
            $this->error404();
        }
        $product = $product[0];

        $error = false;
        $validation = true;

        // Update to Database if method POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Assign POST Data
            $product['category_id'] = $category_id = filter($_POST['category_id']);
            $product['name'] = $name = filter($_POST['name']);
            $product['slug'] = $slug = toKebabCase(filter($_POST['name']));
            $product['description'] = $description = filter($_POST['description']);
            $product['quantity'] = $quantity = filter($_POST['quantity']);
            $product['price'] = $price = filter($_POST['price']);
            $now = date('Y-m-d H:i:s');
            $images = [];

            // Check stored previous Images in database
            $prevImages = getImages($product['images'], true, false);
            $prevImagesKeep = [];
            $prevImagesDeleted = [];

            // Check keeped previous image sent in form edit
            if (isset($_POST['prev_images'])) {
                $images = $prevImagesKeep = $_POST['prev_images'];
            }

            // Assign images path for delete / unlink later after update query
            foreach ($prevImages as $key => $image) {
                if ( ! in_array($image, $prevImagesKeep) ) {
                    $prevImagesDeleted[] = getcwd().str_replace(baseurl(), '', $image);
                }
            }

            // Process Upload New Images
            if (isset($_FILES['images']['name'])) {

                $upload = $this->uploadImages($_FILES['images'], $slug);

                if ( $upload['status'] == true ) {
                    $images = array_merge($images, $upload['files']);
                } else {
                    $validation = false;
                    $error = $upload['response'];
                }
            }

            if ($validation) {

                // Convert images data to json if data is assigned
                if (count($images) > 0) {
                    $images = json_encode($images);
                } else {
                    $images = null;
                }

                // Update to database
                $query = $this->db->query("UPDATE products SET category_id = '$category_id', name = '$name', slug = '$slug', description = '$description', quantity = '$quantity', price = '$price', images = '$images', updated_at = '$now' WHERE id = '$id'");

                // Unlink Deleted Images
                foreach ($prevImagesDeleted as $file) {
                    unlink($file);
                }

                if ($query === true) {
                    redirect('admin/product?message=success');
                } else {
                    $error = $query;
                }
            }
        }

        $title = config('name').' - Edit '.$product['name'];
        $data['title'] = 'Edit Product';
        $data['product'] = $product;
        $data['categories'] = $this->db->query("SELECT * FROM categories");
        $data['submitUrl'] = baseurl('admin/product/edit/'.$id);
        $data['error'] = $error;

        $this->view('admin/product-form', ['data' => $data, 'title' => $title]);
    }

    /**
     * Delete product
     * URL : admin/product/delete/{{id}}
     */
    public function delete($id = null)
    {
        $id = filter($id);

        // Unlink or Remove Images
        $result = $this->db->query("SELECT images FROM products WHERE id = '$id'");

        if ( isset($result[0]) ) {

            $images = getImage($result[0]['images'], true, array());

            foreach ($images as $key => $image) {
                unlink(getcwd().str_replace(baseurl(), '', $image));
            }
        }

        // Delete record from database
        $result = $this->db->query("DELETE FROM products WHERE id = '$id'");

        if ($result) {
            redirect('admin/product?message=success');
        } else {
            redirect('admin/product?message=failed');
        }
    }

    /**
     * Upload Images Product
     */
    private function uploadImages($images, $prefix = null)
    {
        $exts = ['jpg', 'jpeg', 'png', 'gif'];
        $saveDir = getcwd().'\public\images\products\\';
        $url = baseurl('public/images/products/');

        $uploads = [];
        foreach ($images['name'] as $key => $filename) {

            // Check image file extension
            $filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if ( ! in_array($filetype, $exts) ) {
                return [
                    'status' => false,
                    'response' => 'File '.$filename.' is not valid jpg or png format',
                    'files' => [],
                ];
            }

            // Check if file is real image or fake
            if ( ! getimagesize($images["tmp_name"][$key]) ) {
                return [
                    'status' => false,
                    'response' => 'File '.$filename.' is not an image',
                    'files' => [],
                ];
            }

            // Check Image Size
            if ( $images["size"][$key] > 2000000 ) {
                return [
                    'status' => false,
                    'response' => 'Image '.$filename.' size must be below 2MB',
                    'files' => [],
                ];
            }

            $prevName = $filename;
            $filename = $prefix.'-'.date('YmdHis').'-'.$key.'.'.$filetype;
            $uploads[] = [
                'temp' => $images["tmp_name"][$key],
                'save' => $saveDir.basename($filename),
                'filename' => $filename,
                'prev_name' => $prevName,
            ];
        }

        // Move Upload Image from temp directory
        $images = [];
        foreach ($uploads as $file) {
            if( ! move_uploaded_file($file['temp'], $file['save']) ) {
                return [
                    'status' => false,
                    'response' => 'Error while move file '.$file['prev_name'],
                    'files' => [],
                ];
            }

            $images[] = $url.$file['filename'];
        }

        return [
            'status' => true,
            'response' => $images,
            'files' => $images,
        ];
    }

}

?>