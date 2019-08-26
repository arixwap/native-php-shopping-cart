<?php

/**
 * Shop Controller Class
 *
 * Method called by URI
 * Example : /shop/index will call function index() in this class
 */
class Shop extends ControllerClass
{
    /**
     * Home Page - List Of Product
     * URL : shop/index
     */
    public function index()
    {
        $data['products'] = $this->db->query("SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE products.quantity > 0");

        view('home', $data);
    }

    /**
     * Cart Page
     * URL : shop/cart
     */
    public function cart()
    {
        $userId = getSession('user_id', randomString(5));
        $now = date('Y-m-d H:i:s');

        // Retrive Cart Data
        $carts = $this->db->query("SELECT carts.*, cart_products.* FROM carts LEFT JOIN cart_products ON carts.id = cart_products.cart_id WHERE carts.user_id = '$userId'");

        $title = config('name').' - Cart List';
        $data['carts'] = $carts;

        view('cart', $data, $title);
    }

    /**
     * Cart Backend Process
     * Only Return JSON
     * URL : shop/checkout-process
     *
     * Post Parameter : product_id, quantity, method [ add / delete ]
     */
    public function cartProcess()
    {
        /**
         * DEVELOPMENT
         */

        $status = true;
        $response = 'OK';

        $userId = getSession('user_id', randomString(5));
        $now = date('Y-m-d H:i:s');

        // Get cart from database
        $carts = $this->db->query("SELECT carts.*, cart_products.* FROM carts LEFT JOIN cart_products ON carts.id = cart_products.cart_id WHERE carts.user_id = '$userId'");

        $cartProductIds = [];
        // Set cart if not exist
        if (count($carts) > 0) {
            $cartId = $carts[0]['id'];
            // Collect cart product id
            foreach ($carts as $key => $cart) {
                $cartProductIds[] = $cart['product_id'];
            }
        } else {
            $sql = "INSERT INTO carts (user_id, created_at, updated_at) VALUES('$userId', '$now', '$now')";
            $query = $this->db->query($sql, true);
            $cartId = $query->insert_id;
        }

        // Add or remove product from cart if request isset
        if (isset($_POST['product']['id'])) {

            $productIds = $_POST['product']['id'];

            // Get product data by request product id
            if (is_array($productIds)) {
                // Filter product id
                foreach ($productIds as $key => $idProduct) {
                    $productIds[$key] = filter($idProduct);
                }
                $productIds = implode(', ', $productIds);
                $sql = "SELECT * FROM products WHERE id IN ($productIds)";
            } else {
                $productIds = filter($productIds);
                $sql = "SELECT * FROM products WHERE id = '$productIds'";
            }

            // Run query get product from request input
            $products = $this->db->query($sql);

            // START HERE DEVELOPMENT

        }

        return json_encode([
            'status' => $status,
            'response' => $response,
        ])
    }

    /**
     * Cart Page
     * URL : shop/checkout
     */
    public function checkout()
    {
        redirect('/');
    }

}

?>