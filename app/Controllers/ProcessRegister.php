<?php

namespace App\Controllers;

use App\Lib\FormValidation;
use App\Models\User;
use App\Lib\Utils;

class ProcessRegister extends Controller
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

        $fieldsRules = [
            'first_name' => ['required', 'create'],
            'last_name' => ['required', 'create'],
            'street' => ['required', 'create'],
            'city' => ['required', 'create'],
            'postal_code' => ['required', 'create'],
            'province' => ['required', 'create'],
            'country' => ['required', 'create'],
            'phone' => ['required', 'create'],
            'email' => ['required', 'create'],
            'password' => ['required', 'create'],
            'subscribe_to_newsletter' => ['create'],
            'confirm_password' => ['required'],
            'terms' => ['required']
        ];
        
        $validator = new FormValidation($_POST, $fieldsRules);
        
        $user = new User($dbh, 'user', 'id', $_POST, $_SESSION, $fieldsRules);
        
        $utils = new Utils();
        
        if('POST' == $_SERVER['REQUEST_METHOD']) {

            if(isset($_POST['csrf_token']) && ($_POST['csrf_token'] !== $_SESSION['csrf_token'])) {
                die('CSRF token mismatch.');
            } 
        
            // validate form fields input
            $validator->trimValue();
            $validator->checkRequired();
            $validator->validateName('first_name');
            $validator->validateName('last_name');
            $validator->validateStreet('street');
            $validator->validateCity('city');
            $validator->validatePostalCode('postal_code');
            $validator->validateAlphabet('province');
            $validator->validateAlphabet('country');
            $validator->validatePhone('phone');
            $validator->validateEmail('email');
            $validator->validatePassword('password');
            $validator->validateConfirmPassword('confirm_password');
            
            $errors = $validator->getErrors();
        
            // insert new customer data when no errors
            if(empty($errors)) {
        
                if($user->checkEmailExist($_POST['email'])) {
                    $errors['email'][] = 'This email address is already being used';
        
                    $utils->setFormSticky('/?p=register', $_POST, $errors);
        
                } else {
                   
                    try {
        
                        $user = $user->create();
        
                        if($user['id']) {
                            $_SESSION['user_id'] = $user['id'];
                            $_SESSION['flash']['success'] = 'Hi ' . $user['name'] . '! Thank you for your registering!';
                            // when form success, redirect website to profile page
                            header('Location: /?p=profile');
                            die;
                        }
        
                    } catch(Exception $e) {
                        if(ENV === 'development') {
                            echo $e->getMessage();
                        } else {
                            $_SESSION['flash']['error'] = 'Sorry, registration failed. Please try again later';
                            header('Location: /?p=register');
                            die;
                        }
                    }
                }
                
            } else {
                $utils->setFormSticky('/?p=register', $_POST, $errors);
            }
        }
    }

}
