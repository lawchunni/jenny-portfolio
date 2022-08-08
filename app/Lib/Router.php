<?php

namespace App\Lib;

use App\Controllers\Home;
use App\Controllers\Portfolio;
use App\Controllers\AllServices;
use App\Controllers\ServiceDetails;
use App\Controllers\ContactMe;
use App\Controllers\Profile;
use App\Controllers\Register;
use App\Controllers\Login;
use App\Controllers\ProcessRegister;
use App\Controllers\ProcessLogin;
use App\Controllers\ProcessLogout;
use App\Controllers\Cart;
use App\Controllers\ProcessCart;
use App\Controllers\Checkout;
use App\Controllers\ProcessCheckout;
use App\Controllers\Thankyou;
use App\Controllers\Error404;
use App\Controllers\Admin\Dashboard;
use App\Controllers\Admin\Categories;
use App\Controllers\Admin\Products;
use App\Controllers\Admin\ProductAdd;
use App\Controllers\Admin\ProductEdit;
use App\Controllers\Admin\ProcessProductAdd;
use App\Controllers\Admin\ProcessProductEdit;
use App\Controllers\Admin\ProcessProductDelete;
use App\Controllers\Admin\Orders;
use App\Controllers\Admin\Users;
use App\Controllers\Admin\Logs;

class Router
{

    /**
     * String of page getted from url param
     *
     * @var string
     */
    private $page;

    /**
     * Array of page params
     *
     * @var array
     */
    private $args;

    public function __construct(string $page, array $args)
    {
        
        $this->page = $page;
        $this->args = $args;
        
    }

    /**
     * Route to selected controller
     *
     * @return void
     */
    public function route(): void
    {

        switch($this->page)
        {
            case 'home':
                $route = new Home('index', $this->args);
                $route->load();
                break;
            case 'portfolio':
                $route = new Portfolio($this->page, $this->args);
                $route->load();
                break;
            case 'all-services':
                $route = new AllServices($this->page, $this->args);
                $route->load();
                break;
            case 'service-details':
                $route = new ServiceDetails($this->page, $this->args);
                $route->load();
                break;
            case 'contact-me':
                $route = new ContactMe($this->page, $this->args);
                $route->load();
                break;
            case 'profile':
                $route = new Profile($this->page, $this->args);
                $route->load();
                break;
            case 'register':
                $route = new Register($this->page, $this->args);
                $route->load();
                break;
            case 'login':
                $route = new Login($this->page, $this->args);
                $route->load();
                break;
            case 'process_register':
                $route = new ProcessRegister($this->page, $this->args);
                $route->load();
                break;
            case 'process_login':
                $route = new ProcessLogin($this->page, $this->args);
                $route->load();
                break;
            case 'process_logout':
                $route = new ProcessLogout($this->page, $this->args);
                $route->load();
                break;
            case 'cart':
                $route = new Cart($this->page, $this->args);
                $route->load();
                break;
            case 'process-cart':
                $route = new ProcessCart($this->page, $this->args);
                $route->load();
                break;
            case 'checkout':
                $route = new Checkout($this->page, $this->args);
                $route->load();
                break;
            case 'process-checkout':
                $route = new ProcessCheckout($this->page, $this->args);
                $route->load();
                break;
            case 'thank-you':
                $route = new ThankYou($this->page, $this->args);
                $route->load();
                break;
            case 'dashboard':
                $route = new Dashboard($this->page, $this->args);
                $route->load();
                break;
            case 'categories':
                $route = new Categories($this->page, $this->args);
                $route->load();
                break;
            case 'products':
                $route = new Products($this->page, $this->args);
                $route->load();
                break;
            case 'product-add':
                $route = new ProductAdd($this->page, $this->args);
                $route->load();
                break;
            case 'product-edit':
                $route = new ProductEdit($this->page, $this->args);
                $route->load();
                break;
            case 'process-product-add':
                $route = new ProcessProductAdd($this->page, $this->args);
                $route->load();
                break;
            case 'process-product-edit':
                $route = new ProcessProductEdit($this->page, $this->args);
                $route->load();
                break;
            case 'process-product-delete':
                $route = new ProcessProductDelete($this->page, $this->args);
                $route->load();
                break;
            case 'users':
                $route = new Users($this->page, $this->args);
                $route->load();
                break;
            case 'orders':
                $route = new Orders($this->page, $this->args);
                $route->load();
                break;
            case 'logs':
                $route = new Logs($this->page, $this->args);
                $route->load();
                break;
            case 'error404':
                $route = new Error404($this->page, $this->args);
                $route->load();
                break;
        }

    }
    
}