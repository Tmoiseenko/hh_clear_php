<?php

namespace App;

class Route
{
    private $method;
    private $path;
    private $callback;
    private $params = [];

    public function __construct($method, $uri, $callback)
    {
        $this->method = $method;
        $this->path = $uri;
        $this->callback = $callback;
    }

    private function prepareCallback($callback)
    {
        if (is_callable($callback)) {
            return call_user_func_array($callback, $this->params);
        } else {
            list($className, $classMethod) = explode('@', $callback);
            if (class_exists($className) && method_exists($className, $classMethod)) {
                return call_user_func_array([$className, $classMethod], $this->params);
            }
        }
    }

    public function getPath()
    {
        return $this->path;
    }

    public function match($method, $uri)
    {
        if ($this->method === $method && preg_match('/^' . str_replace(['*', '/'], ['.*', '\/'], $this->getPath()) . '$/', $uri)) {
            return true;
        }
        return false;
    }

    public function run($uri)
    {
        $this->parseUri($uri);
        return $this->prepareCallback($this->callback);
    }

    public function parseUri($uri)
    {
        $url_path = parse_url($uri, PHP_URL_PATH);
        $url_path = trim($url_path, '/');
        $uri_parts = explode('/', $url_path);
        if (count($uri_parts) > 1) {
//            if($uri_parts[0] === 'admin') {
//                array_shift($uri_parts);
//            }
            $params = [];
            $i = 0;
            while (count($uri_parts) >= $i) {
                if (isset($uri_parts[$i + 1])) {
                    $params[$uri_parts[$i]] = $uri_parts[$i + 1];
                }
                $i = $i + 2;
            }
            $this->params = $params;
        }
    }
}
