<?php

namespace App\Controllers;

use App\Lib\FormValidation;
use App\Lib\Auth;
use App\Lib\Utils;
use App\Models\User;
use App\Models\Order;

class ProcessCheckout extends Controller
{

    public function __construct(string $page, array $args) 
    {

        parent::__construct($page, $args);
        
        if('POST' !== $_SERVER['REQUEST_METHOD']) {
            http_response_code(405);
            die('405 - Unsupported Request Method');
        }

    }

    /**
     * Load page and pass page arguments
     *
     * @return void
     */
    public function load(): void
    {
        extract($this->args);

        if('POST' == $_SERVER['REQUEST_METHOD']) {

            if(isset($_POST['csrf_token']) && ($_POST['csrf_token'] !== $_SESSION['csrf_token'])) {
                die('CSRF token mismatch.');
            } 
            
            // form validation & create rules
            $fieldsRules = [
                // from payment form
                'name_on_card' => ['required'],
                'credit_card_number' => ['required'], // full credit card
                'expiry_date' => ['required'],
                'cvv' => ['required'],
                // user of ordering information
                'id' => ['read'],
                'first_name' => ['read'],
                'last_name' => ['read'],
                'street' => ['read'],
                'city' => ['read'],
                'postal_code' => ['read'],
                'province' => ['read'],
                'country' => ['read'],
                'phone' => ['read'],
                'email' => ['read']
            ];

            $validator = new FormValidation($_POST, $fieldsRules);

            $utils = new Utils();
            
            // validate form fields input
            $validator->trimValue();
            $validator->checkRequired();
            $validator->validateName('name_on_card');
            $validator->validateCreditCard('credit_card_number');
            $validator->validateCreditCvv('cvv');

            $errors = $validator->getErrors();

            if(empty($errors)) {

                $user = new User($dbh, 'user', 'id', [], $_SESSION, $fieldsRules);
                    
                    $customer = $user->getUserProfile();

                    $customer_info = [
                        'name' => $customer['first_name'] . ' ' . $customer['last_name'],
                        'street' => $customer['street'],
                        'city' => $customer['city'],
                        'postal_code' => $customer['postal_code'],
                        'province' => $customer['province'],
                        'country' => $customer['country'],
                        'phone' => $customer['phone'],
                        'email' => $customer['email'],
                        'credit_card' => substr($_POST['credit_card_number'], -4)
                    ];
                    
                    $customer_json = json_encode($customer_info);

                    $orderArray = [
                        ':subtotal' => $_POST['subtotal'],
                        ':discount_amount' => $_POST['discount_amount'],
                        ':gst_amount' => $_POST['gst'],
                        ':pst_amount' => $_POST['pst'],
                        ':total_amount' => $_POST['total'],
                        ':user_id' => $_SESSION['user_id'],
                        ':user_information' => $customer_json
                    ];

                try {
                    
                    // insert data to invoice table
                    $dbh->beginTransaction();

                    $order = new Order($dbh, 'invoice', 'id');
                    $orderId = $order->createOrder($orderArray);

                    if($orderId) {
                        // insert data to invoice line table
                        foreach ($_SESSION['cart'] as $item) {

                            if(!empty($item)) {
                                $lineItemArray = [
                                    ':product_name' => $item['title'],
                                    ':product_price' => ($item['price'] + $item['discount_amount']) / $item['quantity'],
                                    ':line_price' => $item['price'],
                                    ':quantity' => $item['quantity'],
                                    ':invoice_id' => $orderId,
                                    ':product_id' => $item['id']
                                ];
        
                                $lineItemId = $order->createOrderLineItem($lineItemArray);
                            }
                        }
                    }

                    if($lineItemId) {
                        $dbh->commit();
                        unset($_SESSION['cart']);
                        $_SESSION['latest_order'] = $orderId;
                        $_SESSION['flash']['success'] = "Thank you for your order!";
                        header('Location: /?p=thank-you');
                        die;
                    }

                } catch(Exception $e) {
                    $dbh->rollBack();
                    if(ENV === 'development') {
                        echo $e->getMessage();
                    } else {
                        $_SESSION['flash']['error'] = 'Sorry, checkout progress failed. Please try again later';
                        header('Location: /?p=cart');
                        die;
                    }
                }

            } else {
                $utils->setFormSticky('/?p=checkout', $_POST, $errors);
            }

        }

    }
}
