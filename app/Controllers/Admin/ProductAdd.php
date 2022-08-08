<?php

namespace App\Controllers\Admin;

use App\Lib\Utils;
use App\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;

class ProductAdd extends Controller
{
    
     /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void 
    {

        extract($this->args);

        $title = "Add Product";

        $utils = new Utils();

        $category = new Categories($dbh, 'category', 'id');

        $products = new Products($dbh, 'product', 'id');

        $categories = $category->getAllCategories();

        $product = $post;

        $status = productStatus();

        $utils->view($this->page, compact('title', 'utils', 'flash', 'errors', 'categories', 'product', 'status'), true);
        
    }

}