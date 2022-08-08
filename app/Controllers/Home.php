<?php

namespace App\Controllers;

use App\Lib\Utils;

class Home extends Controller
{

    /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void 
    {

        extract($this->args);

        $title = "Home";

        $utils = new Utils();

        $utils->view($this->page, compact('title', 'utils', 'flash'));
    }
    
}