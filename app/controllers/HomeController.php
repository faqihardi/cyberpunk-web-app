<?php

class HomeController extends Controller
{
    public function index()
    {
        $data['name'] = 'Pengguna';
        $this->view('home/index', $data);
    }

    public function test()
    {
        $data['name'] = 'Halo Wok';
        $this->view('home/test', $data);
    }
}