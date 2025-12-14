<?php

class AdminController extends Controller
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            !isset($_SESSION['user']) ||
            (int)$_SESSION['user']['is_admin'] !== 1
        ) {
            header('Location: ' . BASE_URL . '/auth/showlogin');
            exit;
        }
    }

    protected function getAdmin()
    {
        return $_SESSION['user'];
    }
}