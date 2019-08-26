<?php

/**
 * Shope Controller Class
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
     * Product Detail Page
     * URL : shop/product/{{id}}
     */
    public function product($id)
    {
        view('example');
    }

    /**
     * Cart Page
     * URL : shop/cart
     */
    public function cart()
    {
        $userId = getSession('user_id', randomString(5));

        // Retrive Cart Data
        $carts = $this->db->query("SELECT * FROM carts LEFT JOIN cart_products ON carts.id = cart_products.cart_id WHERE carts.user_id = '$userId'");

        // Store product to cart if request data is set
        if (isset($_POST['product'])) {

            $id = filter($_POST['product']);

            // Get Product Data
            $product = $this->db->query("SELECT * FROM products WHERE ");

            foreach ($carts as $key => $cart) {
                // if ()
            }
        }

        $title = config('name').' - Cart List';
        $data['carts'] = $carts;

        view('cart', $data, $title);
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