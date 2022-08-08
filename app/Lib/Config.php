<?php 

define('ENV', 'development');

define('PST', 0.07);
define('GST', 0.05);

/**
 * get the CSRF token deom session
 *
 * @return string
 */
function csrf(): string
{
    return $_SESSION['csrf_token'];
}
