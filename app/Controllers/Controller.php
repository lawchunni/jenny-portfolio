<?php

namespace App\Controllers;

abstract class Controller
{
    /**
     * String of page getted from url param
     *
     * @var string
     */
    protected $page;

    /**
     * Array of page params
     *
     * @var array- contains dbh, post, flash, errors
     */
    protected $args;

    public function __construct(string $page, array $args) 
    {   

        $this->page = $page;
        $this->args = $args;
       
    }

    abstract public function load(): void;

}