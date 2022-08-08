<?php 

namespace App\Lib\Traits;

trait LoadView
{
    /**
     * Load view with data
     *
     * @param string $view_name
     * @param array $data
     * @return void
     */
    public function view(string $view_name, array $data = [], bool $isAdmin = false):void
    {
        try {
            extract($data);
            // title and content now visible in this scope
            if(!$isAdmin) {
                $path = __DIR__ . '/../../Views/' . $view_name . '.view.php';
            } else {
                $path = __DIR__ . '/../../Views/admin/' . $view_name . '.view.php';
            }
            
            if(!file_exists($path)) {
                throw new \Exception('View ' . $path . ' not found.');
            }
            require($path);
        } catch(\Exception $e) {
            echo $e->getMessage();
            die;
        }
    }
}