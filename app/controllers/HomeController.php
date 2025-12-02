<?php

class HomeController extends Controller
{
    public function index()
    {
        $data['name'] = 'Faqih';
        $this->view('home/index', $data);
    }
}