<?php

namespace App\Models\Traits;

trait FieldFormatter
{
    /**
     * Format field's value before inserting to database table
     *
     * @param array $post
     * @return array
     */
    protected function formatField(array $post):array
    {
        $array = [];

        foreach($post as $key => $value) {

            $newKey = ':' . $key;

            switch ($key) {
                case 'postal_code':
                    $array[$newKey] = $this->formatPostalCode($value);
                    break;
                case 'phone':
                    $array[$newKey] = $this->formatPhone($value);
                    break;
                case 'password':
                    $array[$newKey] = $this->encryptPassword($value);
                    break;
                case 'subscribe_to_newsletter':
                    $array[$newKey] = isset($value) ? 1 : 0;
                    break;
                case 'email':
                    $array[$newKey] = $value;
                    break;
                default:
                    $array[$newKey] = ucwords($value);
                    break;
            }
        }

        return $array ?? [];
    }

    /**
     * Format Phone before inserting into database
     *
     * @param string $value
     * @return string
     */
    private function formatPhone(string $value): string
    {
        // keep only number
        $extractedNum = preg_replace('/[^0-9]/', '',  $value);
        // format number to (xxx) xxx-xxxx
        return '(' . substr($extractedNum, 0, 3) . ') '
                . substr($extractedNum, 3, 3) . '-'
                . substr($extractedNum, 6, 4);
    }

    /**
     * Format Postal Code before inserting into database
     *
     * @param string $value
     * @return string
     */
    private function formatPostalCode(string $value): string
    {
        // check if white space exist
        $whitespace = strpos($value, ' ');
        if(!$whitespace) {
            // add white space in the middle if does not exist eg. R7B &R&
            $value = substr_replace($value, ' ', 3, 0);
        }
        return strtoupper($value);
    }

    /**
     * Create password hash before inserting into database
     *
     * @param string $value
     * @return string
     */
    private function encryptPassword(string $value): string
    {
        return password_hash($value, PASSWORD_DEFAULT);
    } 

   


}
