<?php

/**
 * Category Controller Class
 *
 * Method called by URI
 * Example : /admin/category will call function index() in this class
 */
class Category extends ControllerClass
{
    /**
     * Index of Category
     * URL : admin/category/index
     */
    public function index()
    {
        $title = config('name').' - Category List';

        $data['categories'] = $this->db->query('SELECT * FROM categories');

        $this->view('admin/category-index', ['data' => $data, 'title' => $title]);
    }

    /**
     * Create new category
     * URL : admin/category/create
     */
    public function create()
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

            $validation = true;

            // Assign POST Data
            $category['parent_id'] = $parent_id = filter($_POST['parent_id']);
            $category['name'] = $name = filter($_POST['name']);
            $category['slug'] = $slug = toKebabCase(filter($_POST['name']));
            $category['description'] = $description = filter($_POST['description']);
            $now = date('Y-m-d H:i:s');

            if ($validation) {
                // Insert to database
                $query = $this->db->query("INSERT INTO categories (parent_id, slug, name, description, created_at, updated_at) VALUES('$parent_id', '$slug', '$name', '$description', '$now', '$now')");

                if ($query === true) {
                    redirect('admin/category?message=success');
                } else {
                    $error = $query;
                }
            }
        }

        // Get Parent Category
        $data['parentCategories'] = [];
        $query = $this->db->query('SELECT * FROM categories');
        if ($query) $data['parentCategories'] = $query;

        $title = config('name').' - Create Category';
        $data['title'] = 'Input Category';
        $data['category'] = $category;
        $data['submitUrl'] = baseurl('admin/category/create');
        $data['error'] = $error;

        $this->view('admin/category-form', ['data' => $data, 'title' => $title]);
    }

    /**
     * Edit category
     * URL : admin/category/edit
     */
    public function edit($id = null)
    {
        // Initial data
        $id = filter($id);
        $category = $this->db->query("SELECT * FROM categories WHERE id = '$id'");

        // Return error 404 if no query result
        if ( ! $category ) {
            $this->error404();
        }
        $category = $category[0];

        $error = false;
        // Store to Database if method POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $validation = true;

            // Assign POST Data
            $category['parent_id'] = $parent_id = filter($_POST['parent_id']);
            $category['name'] = $name = filter($_POST['name']);
            $category['slug'] = $slug = toKebabCase(filter($_POST['name']));
            $category['description'] = $description = filter($_POST['description']);
            $now = date('Y-m-d H:i:s');

            if ($validation) {
                // Update to database
                $query = $this->db->query("UPDATE categories SET parent_id = '$parent_id', slug = '$slug', name = '$name', description = '$description', updated_at = '$now' WHERE id = '$id'");

                if ($query === true) {
                    redirect('admin/category?message=success');
                } else {
                    $error = $query;
                }
            }
        }

        // Get Parent Category
        $data['parentCategories'] = [];
        $query = $this->db->query('SELECT * FROM categories');
        if ($query) $data['parentCategories'] = $query;

        $title = config('name').' - Edit '.$category['name'];
        $data['title'] = 'Edit Category';
        $data['category'] = $category;
        $data['submitUrl'] = baseurl('admin/category/edit/'.$id);
        $data['error'] = $error;

        $this->view('admin/category-form', ['data' => $data, 'title' => $title]);
    }

    /**
     * Delete category
     * URL : admin/category/delete/{{id}}
     */
    public function delete($id = null)
    {
        $id = filter($id);
        $result = $this->db->query("DELETE FROM categories WHERE id = '$id'");

        if ($result) {
            redirect('admin/category?message=success');
        } else {
            redirect('admin/category?message=failed');
        }
    }

}

?>