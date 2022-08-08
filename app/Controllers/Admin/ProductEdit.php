<?php

namespace App\Controllers\Admin;

use App\Lib\Utils;
use App\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;

class ProductEdit extends Controller
{
    
     /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void 
    {

        extract($this->args);

        $title = "Edit Product";

        $utils = new Utils();

        $category = new Categories($dbh, 'category', 'id');

        $products = new Products($dbh, 'product', 'id', $_GET);

        $categories = $category->getAllCategories();

        $product = $products->getOneProductAdmin();

        if(!empty($product)) {
            $product['category'] = $product['category_id'];
            $product['discount_rate'] = floatval($product['discount_rate']) * 100; // convert to percentage
        }

        if(!empty($post)) {
            $product = $post;
        }

        $status = productStatus();

        $utils->view($this->page, compact('title', 'utils', 'flash', 'errors', 'categories', 'product', 'status'), true);
    }

}
