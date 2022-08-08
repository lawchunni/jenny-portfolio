<?php

namespace App\Controllers;

use App\Lib\Utils;
use App\Models\Order;

class ThankYou extends Controller
{

    /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void 
    {

        extract($this->args);

        if(!isAuth() || !isset($_SESSION['latest_order'])) {
            header('Location: /?p=home');
            die;
        }

        $title = 'Thank You for Your Order!';

        $utils = new Utils();

        $order = new Order($dbh, 'invoice', 'id', $_SESSION);
        $invoice = $order->getInvoiceById();
        $invoiceline = $order->getInvoicelineByInvoiceId();

        $customer = json_decode($invoice['user_information'], true);
        
        $utils->view($this->page, compact('title', 'utils', 'flash', 'invoice', 'invoiceline', 'customer'));
    }
    
}
