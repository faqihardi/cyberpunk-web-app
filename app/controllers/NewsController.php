<?php

class NewsController extends Controller
{
    public function index()
    {
        $this->view('news/index');   
    }
}