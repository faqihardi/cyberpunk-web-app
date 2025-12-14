<?php

class AuthController extends Controller
{
    public function showregister() {
        $this->view('auth/register'); 
    }

    public function showlogin() {
        $this->view('auth/login'); 
    }

    public function register() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Only handle POST requests for registration
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location:'.BASE_URL.'/auth/showregister');
            exit;
        }

        $userModel = $this->model('User');

        // Simple input retrieval and trimming
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $password_confirm = isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '';

        $errors = [];

        if ($name === '') {
            $errors[] = 'Name is required.';
        }
        if ($username === '') {
            $errors[] = 'Username is required.';
        }
        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Valid email is required.';
        }
        if ($password === '') {
            $errors[] = 'Password is required.';
        }
        if (strlen($password) > 0 && strlen($password) < 6) {
            $errors[] = 'Password must be at least 6 characters.';
        }
        if ($password !== $password_confirm) {
            $errors[] = 'Passwords do not match.';
        }

        if (!empty($errors)) {
            $_SESSION['auth_errors'] = $errors;
            $_SESSION['old'] = [
                'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
                'username' => htmlspecialchars($username, ENT_QUOTES, 'UTF-8'),
                'email' => htmlspecialchars($email, ENT_QUOTES, 'UTF-8')
            ];
            header('Location:'.BASE_URL.'/auth/showregister');
            exit;
        }

        // Check for existing username or email
        if ($userModel->existsByUsernameOrEmail($username, $email)) {
            $_SESSION['auth_errors'] = ['Username or email already taken.'];
            $_SESSION['old'] = [
                'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
                'username' => htmlspecialchars($username, ENT_QUOTES, 'UTF-8'),
                'email' => htmlspecialchars($email, ENT_QUOTES, 'UTF-8')
            ];
            header('Location:'.BASE_URL.'/auth/showregister');
            exit;
        }

        // Hash password and insert user
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $created = $userModel->create([
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $password_hash,
            'is_admin' => 0
        ]);

        if ($created) {
            if (isset($_SESSION['old'])) unset($_SESSION['old']);
            $_SESSION['auth_success'] = 'Registration successful. Please log in.';
            header('Location: '.BASE_URL.'/auth/showlogin');
            exit;
        } else {
            $_SESSION['auth_errors'] = ['Registration failed. Please try again.'];
            $_SESSION['old'] = [
                'name' => htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
                'username' => htmlspecialchars($username, ENT_QUOTES, 'UTF-8'),
                'email' => htmlspecialchars($email, ENT_QUOTES, 'UTF-8')
            ];
            header('Location:'.BASE_URL.'/auth/showregister');
            exit;
        }
    }

    public function login() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location:'.BASE_URL.'/auth/showlogin');
            exit;
        }

        $userModel = $this->model('User');
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        if ($username === '' || $password === '') {
            $_SESSION['auth_errors'] = ['Username/email and password are required.'];
            $_SESSION['old'] = ['username' => htmlspecialchars($username, ENT_QUOTES, 'UTF-8')];
            header('Location:'.BASE_URL.'/auth/showlogin');
            exit;
        }

        $user = $userModel->findByUsernameOrEmail($username);

        if (!$user) {
            $_SESSION['auth_errors'] = ['Invalid credentials.'];
            $_SESSION['old'] = ['username' => htmlspecialchars($username, ENT_QUOTES, 'UTF-8')];
            header('Location:'.BASE_URL.'/auth/showlogin');
            exit;
        }

        if (!password_verify($password, $user['password'])) {
            $_SESSION['auth_errors'] = ['Invalid credentials.'];
            $_SESSION['old'] = ['username' => htmlspecialchars($username, ENT_QUOTES, 'UTF-8')];
            header('Location:'.BASE_URL.'/auth/showlogin');
            exit;
        }

        // Successful login: regenerate session id to prevent fixation
        session_regenerate_id(true);

        $_SESSION['user'] = [
            'user_id' => $user['user_id'],
            'name' => $user['name'],
            'username' => $user['username'],
            'email' => $user['email'],
            'is_admin' => (int) $user['is_admin']
        ];

        // 🔥 REDIRECT BERDASARKAN ROLE
        if ((int)$user['is_admin'] === 1) {
            header('Location: ' . BASE_URL . '/admindashboard');
        } else {
            header('Location: ' . BASE_URL . '/user/dashboard');
        }
        exit;
    }

    public function logout() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Unset and destroy session
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }

        // Clear any auth messages
        if (isset($_SESSION['auth_errors'])) {
            unset($_SESSION['auth_errors']);
        }
        if (isset($_SESSION['auth_success'])) {
            unset($_SESSION['auth_success']);
        }

        session_destroy();
        header('Location:'.BASE_URL);
        exit;
    }
}