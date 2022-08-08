<?php 

namespace App\Controllers;

use App\Lib\FormValidation;
use App\Models\User;
use App\Lib\Utils;

class ProcessLogin extends Controller
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
            'id' => ['read'],
            'first_name' => ['read'],
            'email' => ['required', 'read'],
            'password' => ['required', 'read'],
            'is_admin' => ['read']
        ];
        
        $validator = new FormValidation($_POST, $fieldsRules);
        
        $user = new User($dbh, 'user', 'email', $_POST, $_SESSION, $fieldsRules);
        
        $utils = new Utils();
        
        if('POST' == $_SERVER['REQUEST_METHOD']) {
        
            // validate form fields input
            $validator->trimValue();
            $validator->checkRequired();
            $validator->validateEmail('email');
        
            $errors = $validator->getErrors();
        
            if(empty($errors)) {
        
                // check email exist - model
                $user = $user->getUserLogin($_POST['email']);
        
                if(empty($user)) {
                    $errors['email'][] = "Email does not exist.";
        
                    $utils->setFormSticky('/?p=login', $_POST, $errors);
        
                } elseif ( !password_verify($_POST['password'], $user['password']) ) {
                    // verify password if email exist
                   $errors['password'][] = "Password is incorrect.";
        
                   $utils->setFormSticky('/?p=login', $_POST, $errors);
                   
                } else {
                    try {
        
                        if($user['id']) {

                            session_regenerate_id(true);

                            $_SESSION['user_id'] = $user['id'];
                            $_SESSION['flash']['success'] = 'Hi ' . $user['first_name'] . '! Welcome back!';

                            $target = $_SESSION['target_page'] ?? '';
                            unset($_SESSION['target_page']);
                             
                            if($user['is_admin'] == '1') {
                                $_SESSION['is_admin'] = true;
                                header('Location: /admin/');
                            } else if (!empty($target)) {
                                // when target page is stored in session
                                header('Location: ' . $target);
                            } else {
                                header('Location: /?p=profile');
                            }
                            die;
                        }
                    } catch(Exception $e) {
                        if(ENV === 'development') {
                            echo $e->getMessage();
                        } else {
                            $_SESSION['falsh']['error'] = 'Sorry, login failed. Please try again later';
                            header('Location: /?p=login');
                            die;
                        }
                    }
                }
            } else {
                $utils->setFormSticky('/?p=login', $_POST, $errors);
            }

        }
    }

}
