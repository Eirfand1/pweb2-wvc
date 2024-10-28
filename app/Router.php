<?php

namespace App;

class Router
{
    protected $routes = [];

    private function addRoute($route, $controller, $action, $method)
    {
        $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
    }

    public function get($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "GET");
    }

    public function post($route, $controller, $action)
    {
        $this->addRoute($route, $controller, $action, "POST");
    }

    public function dispatch()
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        $method =  $_SERVER['REQUEST_METHOD'];

        // Iterate through all routes and find a match
        foreach ($this->routes[$method] as $route => $target) {
            // Convert route pattern to regex, replace {parameter} with regex pattern
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_]+)', $route);
            
            // Check if the current URI matches the pattern
            if (preg_match("#^{$pattern}$#", $uri, $matches)) {
                array_shift($matches); // Remove full match from matches

                $controller = new $target['controller']();
                $action = $target['action'];

                // Call the controller method with the extracted parameters
                call_user_func_array([$controller, $action], $matches);
                return;
            }
        }

        // If no matching route is found, throw an exception
        throw new \Exception("No route found for URI: $uri");
    }
}
