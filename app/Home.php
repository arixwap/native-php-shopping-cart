<?php

/**
 * Home Controller Class
 *
 * Method called by URI
 * Example : /home/index will call function index() in this class
 */
class Home extends ControllerClass
{
    /**
     * Home Page - List Of Product
     * URL : home/index
     */
    public function index()
    {
        // Fix image URL in first load
        if (getSession('fix_image') == null) {
            setSession('fix_image', '1');
            $this->fixImage();
        }

        // Get product data which amount is not 0
        $data['products'] = $this->db->query("SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE products.quantity > 0");

        $this->view('home', ['data' => $data]);
    }

    /**
     * Update Images Link
     */
    public function fixImage()
    {
        // Set Flag for Delete Image file if not listed in database
        $cleanFiles = isset($_GET['clean']) ? true : false;
        $usedFiles = [];
        $directory = getcwd().'\public\images\products\\';

        $prevProducts = $this->db->query("SELECT id, images FROM products WHERE images <> ''");
        $productIds = [];
        $sqlCase = "";

        foreach ($prevProducts as $key => $product) {

            $prevLinks = json_decode($product['images']);
            $newLinks = [];

            foreach ($prevLinks as $link) {
                /**
                 * Get filename
                 * Explode url to array by delimiter '/'
                 * Get the last array value
                 */
                $filename = array_values( array_slice( explode('/', $link), -1) )[0];
                $newLinks[] = baseurl('public/images/products/').$filename;

                $usedFiles[] = $filename;
            }

            $productIds[] = $product['id'];
            $newLinks = json_encode($newLinks);
            $sqlCase .= "WHEN id = '$product[id]' THEN '$newLinks'";

        }

        // Update Images in Database
        if (count($productIds) > 0) {

            $productIds = implode(', ', $productIds);
            $sql = "UPDATE products SET images = (CASE $sqlCase END) WHERE id IN ($productIds)";
            $this->db->query($sql);

        }

        // Clean unlisted images in database
        if ($cleanFiles) {

            $files = scandir($directory);
            $usedFiles = array_merge($usedFiles, ['.', '..']);

            // Remove file in directory
            foreach ($files as $file) {
                if ( ! in_array($file, $usedFiles) ) {
                    unlink($directory.$file);
                }
            }

        }

        // Return to home page
        redirect('/');
    }

}

?>