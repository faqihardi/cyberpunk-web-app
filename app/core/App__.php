<?php

class App {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        spl_autoload_register(function($class) {
            $paths = [
                '../app/controllers/' . $class . '.php',
                '../app/core/' . $class . '.php',
                '../app/models/' . $class . '.php'
            ];

            foreach ($paths as $file) {
                if (file_exists($file)) {
                    require_once $file;
                    return;
                }
            }
        });

        $url = $this->parseURL();

        // Controller
        if (isset($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            if (file_exists('../app/controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Method
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Params
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }
}
