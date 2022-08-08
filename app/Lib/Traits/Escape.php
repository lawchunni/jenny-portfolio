<?php

namespace App\Lib\Traits;

trait Escape
{
    /**
     * Escape string for output
     *
     * @param string $str
     * @return string
     */
    public function esc(string $str): string
    {
        return htmlentities($str, ENT_QUOTES, "UTF-8");
    }

    /**
     * Escape string for use in HTML attribute
     *
     * @param string $str
     * @return string
     */
    public function escAttr(string $str):string 
    {
        return htmlentities($str, ENT_QUOTES, "UTF-8");
    }

    /**
     * Escape the input string and allow designated HTML tags to be output to HTML
     *
     * @param string $str
     * @return string
     */
    public function html(string $str):string
    {
        $allowed = [
            '<p>',
            '<br>',
            '<hr>',
            '<em>',
            '<strong>',
            '<b>',
            '<i>',
            '<img>',
            '<h1>',
            '<h2>',
            '<h3>',
            '<h4>',
            '<h5>',
            '<h6>',
            '<ul>',
            '<ol>',
            '<li>'
        ];
        
        $stripped = strip_tags($str, $allowed);

        // < > & " ' TM Coperight R
        $entitiesed = htmlentities($str, ENT_QUOTES, "UTF-8");

        $clean_html = htmlspecialchars_decode($entitiesed, ENT_NOQUOTES);

        return $clean_html;
    }
}