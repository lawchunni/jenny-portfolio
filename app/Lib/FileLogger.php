<?php

namespace App\Lib;

use \App\Lib\Interfaces\ILogger;

class FileLogger implements ILogger
{
    /**
     * Undocumented variable
     *
     * @var resource
     */
    private $handler;

    public function __construct($handler) 
    {   

        if(is_resource($handler)) {
            $this->handler = $handler;
        } else {
            if(ENV === 'development') {
                throw new \InvalidArgumentException('handler must be an valid resource type, do not accept: '.gettype($handler));
            }
        }
    }

    /**
     * Write the log message to log file
     *
     * @param string $event
     * @return void
     */
    public function write(string $event): void 
    {

        if(!empty($event)) {
            $write = fwrite($this->handler, $event);

            if(!$write) {
                die('Failed to write file.');
            }
        }
        
    }
}