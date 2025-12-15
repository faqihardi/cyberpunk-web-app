<?php

class App {
    protected $controller = 'home';
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

        // Controllers
        if (isset($url[0]))
        {
            $controllerName = ucfirst($url[0]) . 'Controller';
            if (file_exists('../app/controllers/' . $controllerName . '.php'))
            {
                $this->controller = ucfirst($url[0]);
                unset($url[0]);
            }
        }
        
        $this->controller = ucfirst($this->controller) . 'Controller';
        
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Method
        if (isset($url[1]))
        {
            if (method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Parametrrs
        if (!empty($url))
        {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET['url']))
        {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
}