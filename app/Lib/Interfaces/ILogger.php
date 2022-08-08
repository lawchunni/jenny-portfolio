<?php

namespace App\Lib\Interfaces;

interface ILogger
{
    public function write(string $event): void;
}
