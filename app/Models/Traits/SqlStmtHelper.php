<?php

namespace App\Models\Traits;

trait SqlStmtHelper
{

    /**
     * create dynamic statements for sql statement
     *
     * @param string $operator - CRUD
     * @param array $fieldsRules - pass from form controller
     * @param array $post - request method
     * @return array
     */
    protected function stmtFormatter(string $operator, array $fieldsRules, array $post = []): array 
    {
        $rawFieldsArr = [];
        $fieldStr = '';
        $valueArr = [];
        $valueStr = '';
        $postArrForCheck = [];
        $postArr = [];
        $finalFieldsArr = [];

        // get the fields to be executed for the selected CRUD $operators 
        foreach($fieldsRules as $key => $value) {
            if(in_array($operator, $value)) {
                // store the fields in the in-function array
                $rawFieldsArr[] = $key;
                $postArr[$key] = null;
            }
        }

        // implode the fields a string
        $fieldStr = implode(', ', $rawFieldsArr);

        if ( $operator == 'create' || $operator == 'update') {
            // format the statement values
            $valueArr = array_map(function($ele) {
                return ":$ele";
            }, $rawFieldsArr);

            // implode the values a string
            $valueStr = implode(', ', $valueArr);

            // get the post keys/values to be interacted with database
            foreach($post as $key => $value) {
                if(in_array($key, $rawFieldsArr)) {
                    // store the key/value in the in-function array
                    $postArr[$key] = $value;
                }
            }

            $finalFieldsArr = [
                'fieldStr' => $fieldStr,
                'valueStr' => $valueStr,
                'post' => $postArr
            ];
        } else {
            $finalFieldsArr = [
                'fieldStr' => $fieldStr
            ];
        }

        return $finalFieldsArr;
    }
}