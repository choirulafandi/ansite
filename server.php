<?php
require 'Database.php';
require 'router.php';
require 'core.php';

class Application
{
    public function run()
    {
        $router = new Router();
        $server = explode('?', $_SERVER['REQUEST_URI']);
        if (array_key_exists($server[0], $router->getRoute())) {
            $class = explode('@', $router->getRoute()[$server[0]]);
            $uc_class = ucfirst($class[0]);
            $method = $class[1];
            include "controller/" . $uc_class . ".php";
            $app = new $uc_class;
            $app->$method();
        } else {
            include "controller/HomeController.php";
            $app = new HomeController;
            $app->index();
        }
    }
}