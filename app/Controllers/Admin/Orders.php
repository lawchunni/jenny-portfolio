<?php

namespace App\Controllers\Admin;

use App\Lib\Utils;
use App\Controllers\Controller;
use App\Models\Order as OrderModel;

class Orders extends Controller
{
    
     /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void 
    {

        extract($this->args);

        $title = "Orders";

        $utils = new Utils();

        $order = new OrderModel($dbh, 'invoice', 'id');

        $result = $order->getAllAdmin();

        if(!empty($result)) {
            foreach($result as $key => $value) {
                $result[$key]['user_information'] = json_decode($value['user_information'], true);
            }
        }

        $utils->view($this->page, compact('title', 'utils', 'flash', 'result'), true);
    }

}