<?php

/**
 * Cart Controller Class
 *
 * Method called by URI
 * Example : /cart/index will call function index() in this class
 */
class Cart extends ControllerClass
{
    /**
     * Index of Cart
     * URL : /cart
     */
    public function index()
    {
        $userId = getSession('user_id', randomString(5));
        $now = date('Y-m-d H:i:s');

        // Get Cart Product
        $carts = $this->db->query("SELECT carts.*, cart_products.* FROM carts JOIN cart_products ON carts.id = cart_products.cart_id WHERE carts.user_id = '$userId'");

        // Get Product Data
        $productIds = implode(', ', pluck($carts, 'product_id'));
        $products = $this->db->query("SELECT id, price, quantity FROM products WHERE id IN ($productIds)");
        $products = keyBy($products, 'id');

        $totalPrice = 0;
        foreach ($carts as $key => $cart) {
            $productId = $cart['product_id'];
            $cart['total_item_price'] = $products[$productId]['price'] * $cart['quantity'];
            $cart['max_qty'] = $products[$productId]['quantity'];
            $carts[$key] = $cart;
            $totalPrice += $cart['total_item_price'];
        }

        $title = config('name').' - Cart List';
        $data['carts'] = $carts;
        $data['total_price'] = $totalPrice;

        $this->view('cart', ['data' => $data, 'title' => $title]);
    }

    /**
     * Cart Backend Process
     * Only Return JSON
     * URL : /cart/process
     *
     * Post Parameter : product_id, quantity, method [ add / delete ]
     */
    public function process()
    {
        // Set response header Json
        header('Content-Type: application/json');

        $status = true;
        $response = 'OK';
        $userId = getSession('user_id', randomString(5));
        $now = date('Y-m-d H:i:s');

        /**
         * Setup Cart
         * Create if not exist
         */
        $cartProductIds = [];
        $carts = $this->db->query("SELECT * FROM carts WHERE user_id = '$userId'");

        if (count($carts) > 0) {
            $cartId = $carts[0]['id'];
            $cartProducts = $this->db->query("SELECT * FROM cart_products WHERE cart_id = '$cartId'");
            $cartProductIds = pluck($cartProducts, 'product_id');
            $cartProductsKeyId = keyBy($cartProducts, 'product_id');
        } else {
            $sql = "INSERT INTO carts (user_id, created_at, updated_at) VALUES('$userId', '$now', '$now')";
            $query = $this->db->query($sql, true);
            $cartId = $query->insert_id;
        }
        // End of - Setup Cart

        /**
         * Setup Cart Product (add, remove) by Request Post
         * Parameter : product_id, qty, method (add, delete)
         */
        if (isset($_POST['product_id'])) {

            // Initial Bulk Array
            $bulkInsertCarts = $bulkUpdateCarts = $bulkDeleteCarts = [];

            /**
             * Initial quantity
             * Force into array
             * Default quantity value is 1
             */
            $quantities = $_POST['qty'] ?? [1];
            if ( ! is_array($quantities) ) $quantities = [$quantities];

            /**
             * Initial method (add, delete)
             * Force into array
             */
            $methods = $_POST['method'] ?? [];
            if ( ! is_array($methods) ) $methods = [$methods];

            /**
             * Get Product Database by Request Id Product
             */
            $postProductIds = $_POST['product_id'];

            if (is_array($postProductIds)) {
                // Filter product id
                foreach ($postProductIds as $key => $idProduct) {
                    $postProductIds[$key] = filter($idProduct);
                }
                $sql = "WHERE products.id IN (".implode(', ', $postProductIds).")";
            } else {
                $postProductIds = filter($postProductIds);
                $sql = "WHERE products.id = '$postProductIds'";
            }

            $sql = "SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON products.category_id = categories.id $sql";
            $products = $this->db->query($sql);
            $products = keyBy($products, 'id');
            // End of - Get Product Database

            /**
             * Looping Array Request Data
             */
            foreach ($methods as $key => $method) {

                /**
                 * Set selected product Id and value
                 */
                $idProduct = $postProductIds[$key];
                $product = $products[$idProduct];

                /**
                 * Validation Quantity Product
                 * Number must same or smaller than products.quantity value
                 * If product qty from database is empty, force method to delete
                 */
                $qty = intval($quantities[$key]);
                if ( $qty < 1 ) $qty = 1;

                if ($method == 'add') {
                    $prevQty = isset($cartProductsKeyId[$idProduct]['quantity']) ? intval($cartProductsKeyId[$idProduct]['quantity']) : 0;
                    $qty = $prevQty + $qty;
                }

                if ( $qty > $product['quantity'] ) $qty = $product['quantity'];
                if ( $qty < 1) $method = 'delete';

                /**
                 * Set Bulk Array Value by Selected Method
                 */
                switch ($method) {
                    case 'delete':
                        $bulkDeleteCarts[] = $idProduct;
                        break;
                    case 'add':
                    case 'update':
                    default:
                        if ( ! in_array($idProduct, $cartProductIds) ) {
                            // Set value for bulk insert
                            $bulkInsertCarts[] = "('$cartId', '$product[id]', '$product[category_id]', '$product[category_name]', '$product[name]', '$product[description]', '$product[price]', '$product[images]', '$qty', '$now', '$now')";
                        } else {
                            // Set value for bulk update
                            $bulks = [];
                            $bulks['product_id'] = $idProduct;
                            $bulks['case_category_id'] = "WHEN product_id = '$idProduct' THEN '$product[category_id]'";
                            $bulks['case_category_name'] = "WHEN product_id = '$idProduct' THEN '$product[category_name]'";
                            $bulks['case_name'] = "WHEN product_id = '$idProduct' THEN '$product[name]'";
                            $bulks['case_description'] = "WHEN product_id = '$idProduct' THEN '$product[description]'";
                            $bulks['case_price'] = "WHEN product_id = '$idProduct' THEN '$product[price]'";
                            $bulks['case_images'] = "WHEN product_id = '$idProduct' THEN '$product[images]'";
                            $bulks['case_quantity'] = "WHEN product_id = '$idProduct' THEN '$qty'";
                            $bulkUpdateCarts[] = $bulks;
                        }
                        break;
                }

            }

            /**
             * Bulk Insert Cart Products
             */
            if (count($bulkInsertCarts) > 0) {

                $bulkInsertCarts = implode(', ', $bulkInsertCarts);

                $sql = "INSERT INTO cart_products (cart_id, product_id, category_id, category_name, name, description, price, images, quantity, created_at, updated_at)  VALUES $bulkInsertCarts";

                $this->db->query($sql);
            }

            /**
             * Bulk Update Cart Products
             */
            if (count($bulkUpdateCarts) > 0) {

                $bulkProductIds = implode(', ', pluck($bulkUpdateCarts, 'product_id'));
                $caseCategoryId = implode(' ', pluck($bulkUpdateCarts, 'case_category_id'));
                $caseCategoryName = implode(' ', pluck($bulkUpdateCarts, 'case_category_name'));
                $caseName = implode(' ', pluck($bulkUpdateCarts, 'case_name'));
                $caseDescription = implode(' ', pluck($bulkUpdateCarts, 'case_description'));
                $casePrice = implode(' ', pluck($bulkUpdateCarts, 'case_price'));
                $caseImages = implode(' ', pluck($bulkUpdateCarts, 'case_images'));
                $caseQuantity = implode(' ', pluck($bulkUpdateCarts, 'case_quantity'));

                $sql = "UPDATE cart_products SET
                    category_id = (CASE $caseCategoryId END),
                    category_name = (CASE $caseCategoryName END),
                    name = (CASE $caseName END),
                    description = (CASE $caseDescription END),
                    price = (CASE $casePrice END),
                    images = (CASE $caseImages END),
                    quantity = (CASE $caseQuantity END),
                    updated_at = '$now'
                WHERE cart_id = '$cartId' AND product_id IN ($bulkProductIds)";

                // Remove line break and double whitespaces
                $sql = trim(preg_replace("/\s\s+/", " ", $sql));

                $this->db->query($sql);
            }

            /**
             * Bulk Delete Cart Products
             */
            if (count($bulkDeleteCarts) > 0) {

                $bulkDeleteCarts = implode(', ', $bulkDeleteCarts);

                $sql = "DELETE FROM cart_products WHERE cart_id = '$cartId' AND product_id IN ($bulkDeleteCarts)";

                $this->db->query($sql);
            }

        }
        // End of - Setup Cart Product

        /**
         * Response Json
         */
        echo json_encode([
            'status' => $status,
            'response' => $response,
            'redirect' => baseurl('cart'),
        ]);
    }

    /**
     * Cart Page
     * URL : cart/checkout
     */
    public function checkout()
    {
        $userId = getSession('user_id', randomString(5));
        $now = date('Y-m-d H:i:s');

        // Validation Input Request
        $name = isset($_POST['name']) ? filter($_POST['name']) : null;
        $address = isset($_POST['address']) ? filter($_POST['address']) : null;

        // Get Cart Product
        $carts = $this->db->query("SELECT carts.*, cart_products.* FROM carts JOIN cart_products ON carts.id = cart_products.cart_id WHERE carts.user_id = '$userId'");

        /**
         * Check Cart Data, Input Name and Input Address
         */
        if (count($carts) > 0 && $name && $address) {

            /**
             * Get Original Product Data
             * Product Id from Cart Product Table
             * Only Select Product where Quantity > 0
             */
            $productIds = implode(', ', pluck($carts, 'product_id'));
            $sql = "SELECT products.*, categories.name AS category_name FROM products LEFT JOIN categories ON products.category_id = categories.id WHERE products.quantity > 0 AND products.id IN ($productIds)";
            $products = $this->db->query($sql);
            $products = keyBy($products, 'id');

            // Check if product data still available
            if (count($carts) == count($products)) {

                /**
                 * Insert Data Order
                 */
                $sql = "INSERT INTO orders (user_id, name, address, created_at, updated_at) VALUES('$userId', '$name', '$address', '$now', '$now')";
                $query = $this->db->query($sql, true);
                $orderId = $query->insert_id;

                /**
                 * Initial Data for Bulk Insert Update
                 */
                $bulkInsertOrders = $bulkUpdateProducts = [];
                $totalPrice = 0;
                foreach ($carts as $cart) {
                    $idProduct = $cart['product_id'];
                    $product = $products[$idProduct];
                    $qtyLeft = $product['quantity'] - $cart['quantity'];
                    $totalPrice += ( $product['price'] * $cart['quantity'] );

                    // Set data bulk insert order products
                    $bulkInsertOrders[] = "('$orderId', '$idProduct', '$product[category_id]', '$product[category_name]', '$product[name]', '$product[description]', '$product[price]', '$product[images]', '$cart[quantity]', '$now', '$now')";

                    // Set data bulk update product quantity
                    $bulks = [];
                    $bulks['id'] = $idProduct;
                    $bulks['case'] = "WHEN id = '$idProduct' THEN '$qtyLeft'";
                    $bulkUpdateProducts[] = $bulks;
                }

                /**
                 * Bulk Insert Order Products
                 */
                $bulkInsertOrders = implode(', ', $bulkInsertOrders);
                $sql = "INSERT INTO order_products (order_id, product_id, category_id, category_name, name, description, price, images, quantity, created_at, updated_at) VALUES $bulkInsertOrders";
                $this->db->query($sql);

                /**
                 * Update Product Total Price
                 */
                $sql = "UPDATE orders SET total_price = '$totalPrice' WHERE id = '$orderId'";
                $this->db->query($sql);

                /**
                 * Bulk Update Products Quantity
                 */
                $productIds = implode(', ', pluck($bulkUpdateProducts, 'id'));
                $qtyCases = implode(' ', pluck($bulkUpdateProducts, 'case'));
                $sql = "UPDATE products SET quantity = (CASE $qtyCases END) WHERE id IN ($productIds)";
                $this->db->query($sql);

                /**
                 * Clear Cart Data & Cart Products
                 */
                $cartId = $carts[0]['cart_id'];
                $sql = "DELETE FROM carts WHERE id = '$cartId'";
                $this->db->query($sql);
                $sql = "DELETE FROM cart_products WHERE cart_id = '$cartId'";
                $this->db->query($sql);

                /**
                 * Show Success Page
                 */
                $this->view('checkout-success');
            }
        } else {

            /**
             * Redirect to Home if Not Cart Item
             */
            redirect('/');
        }
    }

}

?>