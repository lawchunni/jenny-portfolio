<?php

namespace App\Lib;

class FormValidation
{
    
    use Traits\NameFormatter;

    /**
     * Array required fields
     *
     * @var array
     */
    private $required;

    /**
     * Array of key/value pairs to be validated
     *
     * @var array
     */
    private $post = [];

    /**
     * Array of errors and messages
     *
     * @var array
     */
    private $errors = [];


    /**
     * Init
     *
     * @param array $post - request method
     */
    public function __construct(array $post, array $fieldsRules)
    {
        $this->post = $post;
        $this->required = $this->getRequiredFields($fieldsRules);
    }

    /**
     * trim $this->post values
     *
     * @return void
     */
    public function trimValue(): void
    {
        foreach($this->post as $key => $value) {
            $this->post[$key] = trim($value);
        }
    }

    /**
     * check required fileds filled
     *
     * @return void
     */
    public function checkRequired(): void 
    {
        foreach($this->required as $field) {
            if(empty($this->post[$field]) && $this->post[$field] != '0') {
                $this->errors[$field][] = $this->nameFormatter($field) . " is required.";
            }
        }
    }

    /**
     * check if name is valid
     *
     * @param [type] $name
     * @return void
     */
    public function validateName(string $field): void
    {
        $pattern = '/^[A-Za-z0-9\s\-\,\']{1,50}$/';

        if(!preg_match($pattern, $this->post[$field])) {
            $this->errors[$field][] = $this->nameFormatter($field) . ' contains invalid characters or over 50 charactors in length.';
        }
    }

    /**
     * check if street is valid
     *
     * @param [type] $value
     * @return void
     */
    public function validateStreet(string $field): void
    {
        $pattern = '/^[A-Za-z0-9\s\-\,\.\*\#\(\)\"\'\:\;\@\&]{1,255}$/';

        if(!preg_match($pattern, $this->post[$field])) {
            $this->errors[$field][] = $this->nameFormatter($field) . ' contains invalid characters';
        }
    }

    /**
     * check if city is valid
     *
     * @param [type] $value
     * @return void
     */ 
    public function validateCity(string $field): void
    {
        $pattern = '/^[A-Za-z\s\-\.\']{1,36}$/';

        if(!preg_match($pattern, $this->post[$field])) {
            $this->errors[$field][] = $this->nameFormatter($field) . ' contains invalid characters';
        }
    }

    /**
     * check if postal_code is valid
     *
     * @param [type] $value
     * @return void
     */
    public function validatePostalCode(string $field): void
    {
        $pattern = '/^[A-Za-z][0-9][A-Za-z]\s?[0-9][A-Za-z][0-9]$/';

        if(!preg_match($pattern, $this->post[$field])) {
            $this->errors[$field][] = 'Please input a valid ' . $this->nameFormatter($field) . '. e.g. V5X 2H6';
        }
    }

    /**
     * validate basic string
     *
     * @param [type] $value
     * @return void
     */
    public function validateAlphabet(string $field): void
    {
        $pattern = '/^[A-Za-z\s]{1,255}$/';

        if(!preg_match($pattern, $this->post[$field])) {
            $this->errors[$field][] = $this->nameFormatter($field) . ' contains invalid characters';
        }
    }

    /**
     * check if phone is valid
     *
     * @param [type] $value
     * @return void
     */
    public function validatePhone(string $field): void
    {
        $pattern = '/^[\[\(]?\d{3}[\]\)]?[\s\-]?\d{3}[\s\-]?\d{4}$/';

        if(!preg_match($pattern, $this->post[$field])) {
            $this->errors[$field][] = $this->nameFormatter($field) . ' should contain 10 digits in length. e.g. (###) ###-#### or ##########';
        }
    }

    /**
     * check if email is valid
     *
     * @param [type] $value
     * @return void
     */
    public function validateEmail(string $field): void
    {
        if(!filter_var($this->post[$field], FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = 'Please input a valid ' . $this->nameFormatter($field) . ' . e.g. example@example.com';
        }
    }

    /**
     * check if password is valid
     *
     * @param [type] $value
     * @return void
     */
    public function validatePassword(string $field): void
    {
        $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W\^\_]).{8,255}$/';

        if(!preg_match($pattern, $this->post[$field])) {
            $this->errors[$field][] = $this->nameFormatter($field) . ' should contain at least: <br />1. one uppercase letter<br />2. one lowercase letter<br />3. one number<br />4. one special character<br />5. minimum 8 characters in length';
        }
    }

    /**
     * check if confirm_password matchs password
     *
     * @param [type] $value
     * @return void
     */
    public function validateConfirmPassword(string $field): void
    {
        // check if confirm_password match password
        if($this->post['password'] != $this->post[$field]) {
            $this->errors[$field][] = $this->nameFormatter($field) . ' must be the same as Password.';
        }
    }

    /**
     * validate if credit card is valid
     *
     * @param [type] $value
     * @return void
     */
    public function validateCreditCard(string $field): void
    {
        $pattern = '/^[0-9]{16}$/';

        if(!preg_match($pattern, $this->post[$field])) {
            $this->errors[$field][] = $this->nameFormatter($field) . ' should be 16 digits in length';
        }
    }

    /**
     * validate if credit card cvv is valid
     *
     * @param [type] $value
     * @return void
     */
    public function validateCreditCvv(string $field): void
    {
        $pattern = '/^[0-9]{3}$/';

        if(!preg_match($pattern, $this->post[$field])) {
            $this->errors[$field][] = $this->nameFormatter($field) . ' should be 3 digits in length';
        }
    }

    /**
     * validate word count
     *
     * @param [type] $value
     * @return void
     */
    public function validateWordLimit(string $field, int $limit): void
    {
        if(str_word_count($this->post[$field]) > $limit) {
            $this->errors[$field][] = $this->nameFormatter($field) . ' should not exceed ' . $limit . ' words. ' 
            . ' Current word count is ' . str_word_count($this->post[$field]) . '.';
        }
    }

    /**
     * validate if price is valid
     *
     * @param [type] $value
     * @return void
     */
    public function validatePrice(string $field): void
    {
        $pattern = '/^[0-9\.]{1,}$/';

        if(!preg_match($pattern, $this->post[$field])) {
            $this->errors[$field][] = $this->nameFormatter($field) . ' should contain only digit and/or dot.';
        }
    }

    /**
     * validate if technology is valid
     *
     * @param [type] $value
     * @return void
     */
    public function validateTechnology(string $field): void
    {
        $pattern = '/^[A-Za-z0-9\|\'\,\.\$\+\s]{1,}$/';

        if(!preg_match($pattern, $this->post[$field])) {
            $this->errors[$field][] = $this->nameFormatter($field) . " contains invalid characters. Only A-Z a-z 0-9 | ' , . $ + and space is allowed.";
        }
    }

    /**
     * validate if image is valid
     *
     * @param [type] $value
     * @return void
     */
    public function validateImage(string $field, bool $editMode = false): void
    {
        if(!$editMode) {
            // check image exists
            if(empty($_FILES[$field]['tmp_name'])) {
                $this->errors[$field][] = $this->nameFormatter($field) . " is required.";
            }
        }
        if(!empty($_FILES[$field]['tmp_name'])) {
            // check if uploaded file is an image
            if(str_contains($_FILES[$field]['type'], 'image') === false) {
                $this->errors[$field][] = "The file uploaded is not an image.";
            } else if(strlen($_FILES[$field]['name']) > 50){
                $this->errors[$field][] = "The uploaded file name exceeds 50 characters limit. Please rename the image file.";
            }
        }
    }


    /* ------------- Getter ------------- */

    /**
     * Return the error message for form validation 
     *
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Return the post 
     *
     * @return array
     */
    public function getPost(): array
    {
        return $this->post;
    }

    /*---------- Utility function --------- */

    /**
     * get only the required fields from rules
     *
     * @param array $fieldsRules
     * @return array
     */
    private function getRequiredFields(array $fieldsRules): array
    {
        $array = [];

        foreach($fieldsRules as $key => $value) {
            if(in_array('required', $value)) {
                $array[] = $key;
            }
        }

        return $array;
    }
}
