<?php

namespace App\Lib;

class Utils
{
    
    use Traits\LoadView;

    use Traits\Escape;
    
    use Traits\Debug;

    use Traits\NameFormatter;
    
    use Traits\StickyForm;

    /**
     * log servenr event to database & log file
     *
     * @param Interfaces\ILogger $logger
     * @param string $event
     * @return void
     */
    public function logEvent(\App\Lib\Interfaces\ILogger $logger, string $event = '')
    {

        if(empty($event)) {

            $array = [
                'daytime' => date('Y-m-d H:i:s'),
                'method' => $_SERVER['REQUEST_METHOD'],
                'page' => $_SERVER['REQUEST_URI'],
                'status' => http_response_code(),
                'browser_info' => $_SERVER['HTTP_USER_AGENT']
            ];

            $event = implode(' | ', $array) . PHP_EOL;

        }
        
        // save the log message in a database, or written to file
        $logger->write($event);
    }

    /**
     * split the value with '|' seperator
     *
     * @param string $val
     * @return array
     */
    public function tagFormatter(string $val): array
    {
        $arr = explode('|', $val);

        return $arr;
    }

}
