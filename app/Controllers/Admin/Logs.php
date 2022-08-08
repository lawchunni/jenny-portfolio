<?php

namespace App\Controllers\Admin;

use App\Lib\Utils;
use App\Controllers\Controller;
use App\Models\Log;

class Logs extends Controller
{

     /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void 
    {

        extract($this->args);

        $title = "Logs";

        $utils = new Utils();

        $log = New Log($dbh, 'log', 'id');

        $logEvent = $log->getRecord('100');

        $utils->view($this->page, compact('title', 'utils', 'flash', 'logEvent'), true);
    }

}