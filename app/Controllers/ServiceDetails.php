<?php

namespace App\Controllers;

use App\Models\Products;
use App\Lib\Utils;

class ServiceDetails extends Controller
{

    public function __construct(string $page, array $args)
    {
        parent::__construct($page, $args);

        if(empty($_GET['id'])) {
            header("Location: /?p=all-services");
            die;
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

        $title = "Service Details";

        $products = new Products($dbh, 'product', 'id', $_GET);

        $product = $products->getOneProduct();

        $utils = new Utils();

        $utils->view($this->page, compact('title', 'utils', 'flash', 'product'));
    }
    
}
