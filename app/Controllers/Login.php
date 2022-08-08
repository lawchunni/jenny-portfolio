<?php

namespace App\Controllers;

use App\Lib\Utils;

class Login extends Controller
{

    /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void 
    {

        extract($this->args);

        $title = "Login";

        $utils = new Utils();

        $utils->view($this->page, compact('title', 'post', 'errors', 'utils', 'flash'));
    }

}
