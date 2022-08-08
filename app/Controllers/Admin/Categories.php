<?php

namespace App\Controllers\Admin;

use App\Lib\Utils;
use App\Controllers\Controller;

class Categories extends Controller
{

     /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void 
    {

        extract($this->args);

        $title = "Categories";

        $utils = new Utils();

        $utils->view($this->page, compact('title', 'utils', 'flash'), true);
    }

}