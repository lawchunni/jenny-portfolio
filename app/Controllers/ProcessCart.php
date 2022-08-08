<?php

namespace App\Controllers;

use App\Models\Products;

class ProcessCart extends Controller
{

    public function __construct(string $page, array $args) 
    {

        parent::__construct($page, $args);
        
        if('POST' !== $_SERVER['REQUEST_METHOD']) {
            http_response_code(405);
            die('405 - Unsupported Request Method');
        }
    }

    /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void
    {
        extract($this->args);

        if(isset($_POST['csrf_token']) && ($_POST['csrf_token'] !== $_SESSION['csrf_token'])) {
            die('CSRF token mismatch.');
        } 

        // Remove item deom $_SESSION when customer pressed delete
        if(isset($_POST['delete_id']) && isset($_SESSION['cart'])) {
            
            $_SESSION['flash']['success'] = "Item has been removed from shopping cart.";
            unset($_SESSION['cart'][$_POST['delete_id']]);

        } else {

            $products = new Products($dbh, 'product', 'id', $post = $_POST);

            $result = $products->getOneProduct();

            if(!empty($result)) {

                // Item quantity
                if(isset($_POST['quantity'])) {
                    // trigger when customer change item quantity from shopping cart
                    $quantity = intval($_POST['quantity']);
                } else if(isset($_SESSION['cart']) && array_key_exists($result['id'], $_SESSION['cart'])) {
                    // (add to cart action) increment item quantity when item already exists in $_SESSION
                    $quantity = intval($_SESSION['cart'][$result['id']]['quantity']) + 1;
                } else {
                    // default
                    $quantity = 1;
                }

                $amount_after_discount = floatval($result['price']) * (1 - floatval($result['discount_rate']));

                // multiply the final price with discount rate
                $price = $result['discount_available'] == '1'
                            ? $amount_after_discount * $quantity
                            : floatval($result['price']) * $quantity;

                // manually create item array
                $item = [
                    'id' => $result['id'],
                    'title' => $result['title'],
                    'quantity' => $quantity,
                    'price' => $price,
                    'discount_available' => $result['discount_available'],
                    'discount_rate' => floatVal($result['discount_rate']) * 100,
                    'discount_amount' => (floatval($result['price']) - $amount_after_discount) * $quantity
                ];

                $_SESSION['flash']['success'] = "{$item['title']} has been added to shopping cart.";
                $_SESSION['cart'][$item['id']] = $item;
                
            }
        }

        // redirect
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die;
    }
}
