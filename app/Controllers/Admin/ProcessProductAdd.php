<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Lib\FormValidation;
use App\Lib\Utils;
use App\Models\Products;

class ProcessProductAdd extends Controller
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

        // validation
        $fieldsRules = [
            'category' => ['required', 'create'],
            'title' => ['required', 'create'],
            'product_img' => ['create'],
            'summary' => ['required', 'create'],
            'description' => ['required', 'create'],
            'technology' => ['required', 'create'],
            'price' => ['required', 'create'],
            'discount_rate' => ['required', 'create'],
            'status' => ['required', 'create']
        ];

        $validator = new FormValidation($_POST, $fieldsRules);
        
        $utils = new Utils();

        if('POST' == $_SERVER['REQUEST_METHOD']) {

            if(isset($_POST['csrf_token']) && ($_POST['csrf_token'] !== $_SESSION['csrf_token'])) {
                die('CSRF token mismatch.');
            } 

            // validate form fields input
            $validator->trimValue();
            $validator->checkRequired();
            $validator->validateName('title');
            $validator->validateWordLimit('summary', 200);
            $validator->validateWordLimit('description', 900);
            $validator->validatePrice('price');
            $validator->validateTechnology('technology');
            $validator->validateImage('product_img');
            $errors = $validator->getErrors();

            if(empty($errors)) {

                // ========== [image upload] ========= //
                $image = imageUpload($_FILES, 'product_img');
                
                // new image is uploaded
                if(isset($image['errors'])) {
                    $errors['image'][] = $image['errors'];
                    $utils->setFormSticky('/admin?p=product-add', $_POST, $errors);
                } 

                $_POST['image'] = $image['file_name'];
                
                // ========== [Determine other values] ========= //
                // technology
                $_POST['technology'] = trim($_POST['technology'], '|');
                // discount
                $rate = intval($_POST['discount_rate']);
                $_POST['discount_available'] = $rate > 0 ? 1 : 0;
                $_POST['discount_rate'] = $rate / 100; // float

                // deleted
                $_POST['deleted'] = 0;

                try {
                    $products = new Products($dbh, 'product', 'id', null, $_POST);

                    $product = $products->create();

                    if($product['id']) {
                        $_SESSION['flash']['success'] = 'New product ' . $product['title'] . ' is created successfully!';
                        // when form success, redirect website to product add page
                        header('Location: /admin?p=products');
                        die;
                    }

                } catch(Exception $e) {
                    if(ENV === 'development') {
                        echo $e->getMessage();
                    } else {
                        $_SESSION['flash']['error'] = 'Sorry, insert product into database failed. Please try again later';
                        header('Location: /admin/?p=products');
                        die;
                    }
                }

            } else {
                $utils->setFormSticky('/admin?p=product-add', $_POST, $errors);
            }
            
        }  
    }
}
