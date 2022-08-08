<?php 

namespace App\Controllers;

use App\Lib\Utils;

class Cart extends Controller
{
    
    /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void 
    {

        // clear cart items
        if(isset($_GET['clear']) && $_GET['clear'] == '1') {
            $_SESSION['flash']['success'] = "Shopping cart is empty now.";
            unset($_SESSION['cart']);
            header('Location: /?p=cart');
            die;
        }

        extract($this->args);

        $title = "Shopping Cart";

        $utils = new Utils();

        $cart = $_SESSION['cart'] ?? [];

        $total = checkoutTotal($cart);

        $utils->view($this->page, compact('title', 'utils', 'flash', 'cart', 'total'));

    }

}
