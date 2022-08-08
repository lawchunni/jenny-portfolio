<?php 

namespace App\Lib\Traits;

trait StickyForm
{
    
    /**
     * set the $_post and error information to $_SESSION
     *
     * @param string '/?p=' . $location
     * @return void
     */
    function setFormSticky(string $location, array $post, array $errors): void {
        $_SESSION['post'] = $post;
        $_SESSION['errors'] = $errors;
        header('Location: ' . $location);
        die;
    }

}