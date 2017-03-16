<?php

/**
 * Created by DoAnChuyenNganhTeam.
 * User: TungHH
 * Date: 03/16/2017
 * Time: 9:37 AM
 */

namespace fonda;

use Slim\App;

require __DIR__.'/../../vendor/autoload.php';

class Program
{

    private $app;

    private $controllers = array();

    private function __construct()
    {
        $this->app = new App();
    }

    static function instance()
    {
        static $instance;
        if ($instance === null)
        {
            $instance = new Program();
        }
        return $instance;
    }

    function registerHandler($controller)
    {
        array_push($this->controllers, $controller);
    }

    function start()
    {
        $this->preProcess();
        $this->app->run();
    }

    private function preProcess()
    {
        foreach ($this->controllers as $controller)
        {
            $this->app->map($controller->getMethod(), $controller->getUrl(), array($controller, 'exec'));
        }
    }
}