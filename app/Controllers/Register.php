<?php

namespace App\Controllers;

use App\Lib\Utils;

class Register extends Controller
{
    /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void 
    {

        extract($this->args);

        $title = "Registration";

        $utils = new Utils();

        $utils->view('register', compact('title', 'post', 'errors', 'flash', 'utils'));
    }
}

