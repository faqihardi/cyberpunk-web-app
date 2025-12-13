<?php

class AdmindashboardController extends AdminController
{
    public function index()
    {
        $this->view('admin/dashboard', [
            'admin_name'  => $this->admin()['name'],
            'admin_email' => $this->admin()['email']
        ]);
    }
}
