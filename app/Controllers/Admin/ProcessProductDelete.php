<?php

namespace App\Controllers\Admin;

use App\Lib\Utils;
use App\Controllers\Controller;
use App\Models\Products;

class ProcessProductDelete extends Controller
{

    public function __construction(string $page, array $args)
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

        $utils = new Utils();

        $products = new Products($dbh, 'product', 'id', null, $_POST);

        if('POST' == $_SERVER['REQUEST_METHOD']) {

            if(isset($_POST['csrf_token']) && ($_POST['csrf_token'] !== $_SESSION['csrf_token'])) {
                die('CSRF token mismatch.');
            } 
            
            if(isset($_POST['deleted'])) {
                try {
                    $rowCount = $products->delete();
        
                    if($rowCount > 0) {
                        if($_POST['deleted'] == '0') {
                            $_SESSION['flash']['success'] = $_POST['title'] . ' is activated in customer site.';
                        } else {
                            $_SESSION['flash']['success'] = $_POST['title'] . ' is deleted from customer site.';
                        }
                        
                        header('Location: /admin/?p=products');
                        die;
                    }
        
                } catch (Exception $e) {
                    if(ENV === 'development') {
                        echo $e->getMessage();
                    } else {
                        $_SESSION['flash']['error'] = 'Sorry, delete product from database failed. Please try again later';
                        header('Location: /admin/?p=products');
                        die;
                    }
                }
            }
            
        }

    }

}