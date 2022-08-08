<?php

namespace App\Controllers;

use App\Lib\Utils;

class Portfolio extends Controller
{

    /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void 
    {

        extract($this->args);

        $title = 'Portfolio';

        $utils = new Utils();

        $utils->view($this->page, compact('title', 'utils', 'flash'));
    }
    
}
