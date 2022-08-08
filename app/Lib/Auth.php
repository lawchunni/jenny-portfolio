<?php

/**
 * Check user logged in
 *
 * @return boolean
 */
function isAuth(): bool
{
    return isset($_SESSION['user_id']);
}

/**
 * Check Admin user logged in
 *
 * @return boolean
 */
function isAdmin(): bool
{
    return isset($_SESSION['is_admin']);
}
