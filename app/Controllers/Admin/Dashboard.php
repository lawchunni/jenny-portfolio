<?php

namespace App\Controllers\Admin;

use App\Lib\Utils;
use App\Controllers\Controller;
use App\Models\Log;
use App\Models\Dashboard as DashboardModel;

class Dashboard extends Controller
{

     /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void 
    {

        extract($this->args);

        $title = "Dashboard";

        $utils = new Utils();

        $dashboard = new DashboardModel($dbh, '', 'id');

        $log = new Log($dbh, 'log', 'id');

        $countProducts = $dashboard->countProducts();
        $countUsers = $dashboard->countUsers();
        $countOrders = $dashboard->countInvoice();
        
        $productOverview = $dashboard->productsOverview();
        $invoiceOverview = $dashboard->invoicesOverview();

        $glance = [
            'books' => $countProducts['total'],
            'users' => $countUsers['total'],
            'orders' => $countOrders['total'],
            'product' => $productOverview,
            'invoice' => $invoiceOverview
        ];

        $logEvent = $log->getRecord('10');

        $utils->view($this->page, compact('title', 'utils', 'flash', 'glance', 'logEvent'), true);
    }

}