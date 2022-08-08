<?php

namespace App\Controllers\Admin;

use App\Lib\Utils;
use App\Controllers\Controller;
use App\Models\Products as ProductsModel;

class Products extends Controller
{
    
     /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void 
    {

        extract($this->args);

        $title = "Products";

        $utils = new Utils();

        $products = new ProductsModel($dbh, 'product', 'id', $_GET);

        if(isset($_GET['search'])) {
            $result = $products->getProductsBySearchAdmin();
        } else {
            $result = $products->getAllProductsAdminList();
        }

        $utils->view($this->page, compact('title', 'utils', 'flash', 'result'), true);
    }

}