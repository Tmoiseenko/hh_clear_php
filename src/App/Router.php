<?php

namespace App;

use App\Exception\NotFoundException;
use App\Route as Route;

class Router
{
    protected $routes = [];

    public function get(string $path,  $callback)
    {
        $this->routes[] = new Route("GET", $path, $callback);
    }

    public function post(string $path,  $callback)
    {
        $this->routes[] = new Route("POST", $path, $callback);
    }

    public function dispatch()
    {
        foreach ($this->routes as $route) {
            if ($route->match($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'])) {
                return $route->run($_SERVER['REQUEST_URI']);
            }
        }
        throw new NotFoundException('Страница не найдена', 404);

    }
}
