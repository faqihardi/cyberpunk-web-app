<?php
class UserController extends Controller
{
    public function dashboard()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin']) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
        $this->view('user/dashboard', ['user' => $_SESSION['user']]);
    }
}
