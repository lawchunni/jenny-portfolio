<?php

namespace App\Controllers;

class ProcessLogout extends Controller
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

        if(!empty($_POST['logout'])) {
            unset($_SESSION['user_id']);
            
            if(isset($_SESSION['is_admin'])) unset($_SESSION['is_admin']);

            $_SESSION['flash']['success'] = 'You have successfully logged out.';
            // Go back to the page where user loggod out
            $previous_url = $_SERVER['HTTP_REFERER'];
            $extracted_url = explode('/?p=', $previous_url)[1];
            $final_url = ($extracted_url == 'profile') ? 'home' : $extracted_url;
            header('Location: /?p=' . $final_url);
            die;
        }

    }

}



