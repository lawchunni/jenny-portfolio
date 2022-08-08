<?php

namespace App\Lib\Traits;

trait NameFormatter
{
    /**
     * Remove underscore in string and Capitalize the first letter of the string
     *
     * @param string $str
     * @return string
     */
    public function nameFormatter(string $str): string
    {
        return ucwords(str_replace('_', ' ', $str));
    }
}