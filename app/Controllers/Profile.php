<?php

namespace App\Controllers;

use App\Models\User;
use App\Lib\Utils;

class Profile extends Controller
{

    public function __construct(string $page, array $args) 
    {

        parent::__construct($page, $args);

        if(empty($_SESSION['user_id'])) {
            $_SESSION['flash']['error'] = "Please login to view the profile";
            header('Location: /?p=login');
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

        $fieldsRules = [
            'id' => ['read'],
            'first_name' => ['read'],
            'last_name' => ['read'],
            'street' => ['read'],
            'city' => ['read'],
            'postal_code' => ['read'],
            'province' => ['read'],
            'country' => ['read'],
            'phone' => ['read'],
            'email' => ['read'],
            'subscribe_to_newsletter' => ['read']
        ];

        $user = new User($dbh, 'user', 'id', $post, $_SESSION, $fieldsRules);

        $title = "Profile";

        $utils = new Utils();
        
        if(!empty($_SESSION['user_id'])) {
            $result = $user->getUserProfile();

            $utils->view($this->page, compact('title', 'result', 'utils', 'flash'));
        }

    }
}
