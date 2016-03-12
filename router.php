<?php

class Router
{
    public function getRoute()
    {
        $route = [
            '/' => 'homeController@index',
        ];

        return $route;
    }
}