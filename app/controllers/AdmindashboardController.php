<?php

class AdmindashboardController extends AdminController
{
    public function index()
    {
        $admin = $this->getAdmin();
        
        $this->view('admin/dashboard', [
            'admin_name'  => $admin['name'],
            'admin_email' => $admin['email']
        ]);
    }
}