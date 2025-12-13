<?php

class Controller
{
    public function view($view, $data = [])
    {
        // var_dump($view);
        extract($data);
        require_once '../app/views/' . $view . '.php';
    }

    public function model($model)
    {
        $file = __DIR__ . '/../models/' . $model . '.php';
        if (!file_exists($file)) {
            throw new Exception("Model file not found: $file");
        }

        require_once $file;

        if (!class_exists($model)) {
            throw new Exception("Model class not found: $model");
        }

        return new $model;
    }
}