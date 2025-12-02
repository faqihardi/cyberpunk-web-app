<?php

class App {
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // Controllers
        if (isset($url[0]))
        {
            if (file_exists('../app/controllers/' . $url[0] . 'Controller.php'))
            {
                $this->controller = ucfirst($url[0]) . 'Controller';
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

        // Params
        if (!empty($url))
        {
            $this->params = array_values($url);
        }

        // Run
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
    }
}