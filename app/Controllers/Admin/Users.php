<?php

namespace App\Controllers\Admin;

use App\Lib\Utils;
use App\Controllers\Controller;
use App\Models\User;

class Users extends Controller
{
    
     /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void 
    {

        extract($this->args);

        $title = "Users";

        $utils = new Utils();

        $user = new User($dbh, 'user', 'id');

        $result = $user->getAllUsers();

        $utils->view($this->page, compact('title', 'utils', 'flash', 'result'), true);
    }

}