<?php

namespace App\Lib\Traits;

trait Debug
{
    /**
     * Check data details 
     *
     * @param mixed $var
     * @param boolean $die
     * @return void
     */
    function dd(mixed $var, $die = true): void
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        if($die) {
            die;
        }
    }

    /**
     * Show server config only when the environment is not in 'production' mode
     *
     * @return void
     */
    public function dc(): void
    {
        if(defined('ENV') && ENV !== 'production') {
            if(func_num_args()) {
                $out = func_get_args();
            } else {
                $out = $GLOBALS;
            }
            $json = json_encode($out);
            echo "<script>console.log($json)</script>";
        }
    }
}