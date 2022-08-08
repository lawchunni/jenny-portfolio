<?php

namespace App\Lib;

use \App\Models\Log;
use \App\Lib\Interfaces\ILogger;

class DatabaseLogger implements ILogger
{

    /**
     * database handle
     *
     * @var \PDO
     */
    private $handler;

    public function __construct(\PDO $handler) 
    {
        $this->handler = $handler;
    }

    /**
     * Save the log message to database
     *
     * @param string $event
     * @return void
     */
    public function write(string $event): void
    {
        $log = new Log($this->handler, 'log', 'id', $event);

        if(!empty($event)) {
            $record = $log->create();
        }
    }
}