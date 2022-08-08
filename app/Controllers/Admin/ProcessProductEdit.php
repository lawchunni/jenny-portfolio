<?php

namespace App\Controllers\Admin;

use App\Controllers\Controller;
use App\Lib\FormValidation;
use App\Lib\Utils;
use App\Models\Products;

class ProcessProductEdit extends Controller
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
            'category' => ['required', 'update'],
            'title' => ['required', 'update'],
            'summary' => ['required', 'update'],
            'description' => ['required', 'update'],
            'technology' => ['required', 'update'],
            'price' => ['required', 'update'],
            'discount_rate' => ['required', 'update'],
            'status' => ['required', 'update']
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
            $validator->validateImage('product_img', true);
            $errors = $validator->getErrors();

            if(empty($errors)) {

                // ========== [image upload] ========= //
                $image = imageUpload($_FILES, 'product_img');
                
                if(!empty($image)) { // pass if no image selected in edit mode
                    // new image is uploaded
                    if(isset($image['errors'])) {
                        $errors['image'][] = $image['errors'];
                        $utils->setFormSticky('/admin?p=product-edit', $_POST, $errors);
                    } else {
                        $_POST['image'] = $image['file_name'];
                    }
                } else {
                    $_POST['image'] = $_POST['existing_img'];
                }

                // ========== [Determine other values] ========= //
                // technology
                $_POST['technology'] = trim($_POST['technology'], '|');
                // discount
                $rate = intval($_POST['discount_rate']);
                $_POST['discount_available'] = $rate > 0 ? 1 : 0;
                $_POST['discount_rate'] = $rate / 100; // float

                try {
                    $products = new Products($dbh, 'product', 'id', null, $_POST);

                    $rowCount = $products->update();

                    if($rowCount > 0) {
                        $_SESSION['flash']['success'] = $_POST['title'] . ' is updated successfully!';
                        header('Location: /admin?p=products');
                        die;
                    } else {
                        $_SESSION['flash']['success'] = 'No changes for ' . $_POST['title'] .' is performed.';
                        header('Location: /admin?p=product-edit&id=' . $_POST['id']);
                        die;
                    }

                } catch(Exception $e) {
                    if(ENV === 'development') {
                        echo $e->getMessage();
                    } else {
                        $_SESSION['flash']['error'] = 'Sorry, update product in database failed. Please try again later';
                        header('Location: /admin/?p=products');
                        die;
                    }
                }

            } else {
                $utils->setFormSticky('/admin?p=product-edit&id=' . $_POST['id'] , $_POST, $errors);
            }
            
        }  
    }

}
