<?php

namespace App\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Lib\Utils;

class AllServices extends Controller
{

    /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void 
    {

        extract($this->args);

        $title = "All Services";

        $utils = new Utils();

        $category = new Categories($dbh, 'category', 'id');

        $products = new Products($dbh, 'product', 'id', $_GET);

        $categories = $category->getAllCategories();

        if(!empty($_GET['category'])) {
            $productResults = $products->getProductsByCategory();
        } else if(isset($_GET['search'])) {
            if(empty($_GET['search'])) {
                header('Location: /');
                die;
            }
            $productResults = $products->getProductsBySearch();
        }else {
            $productResults = $products->getAllProducts();
        }

        $utils->view($this->page, compact('title', 'post', 'utils', 'flash', 'categories', 'productResults'));
    }
    
}
