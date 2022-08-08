<?php

namespace App\Controllers;

use App\Lib\Utils;
use App\Lib\Config;

class Checkout extends Controller
{

    public function __construct(string $page, array $args) 
    {

        parent::__construct($page, $args);
        
    }

    /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void
    {
        extract($this->args);
        
        if(!isAuth()) {
            $_SESSION['flash']['error'] = "Please login before checking out the shopping cart.";
            $_SESSION['target_page'] = '/?p=checkout';
            header('Location: /?p=login');
            die;
        }

        if(!isset($_SESSION['cart'])) {
            header('Location: /?p=home');
            die;
        }

        $title = "Checkout";

        $utils = new Utils();

        $cart = $_SESSION['cart'] ?? [];

        $total = checkoutTotal($cart);

        $utils->view($this->page, compact('title', 'utils', 'cart', 'total', 'post', 'errors'));

    }
}
