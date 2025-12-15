<?php

class AdminaccountController extends AdminController
{
    public function index($selectedId = null)
    {
        $admin = $this->getAdmin();
        
        $userModel = $this->model('User');
        $users = $userModel->getAll();

        // Set default selected ID ke user pertama jika tidak ada
        if ($selectedId === null && !empty($users)) {
            $selectedId = $users[0]['id'];
        }

        // Cari user yang dipilih
        $selected = null;
        foreach ($users as $user) {
            if ($user['id'] == $selectedId) {
                $selected = $user;
                break;
            }
        }

        // Jika user tidak ditemukan, redirect ke user pertama
        if ($selected === null && !empty($users)) {
            header('Location: ' . BASE_URL . '/adminaccount/index/' . $users[0]['id']);
            exit;
        }

        $this->view('admin/account_control', [
            'users'      => $users,
            'selected'   => $selected,
            'selectedId' => $selectedId,
            'adminName'  => $admin['name']
        ]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/adminaccount');
            exit;
        }

        $userId = $_POST['user_id'] ?? null;

        if (empty($userId)) {
            // TODO: Set flash message - invalid user
            header('Location: ' . BASE_URL . '/adminaccount');
            exit;
        }

        // Validasi input
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $isAdmin = isset($_POST['is_admin']) ? 1 : 0;

        if (empty($username) || empty($email)) {
            // TODO: Set flash message - required fields
            header('Location: ' . BASE_URL . '/adminaccount/index/' . $userId);
            exit;
        }

        // Validasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // TODO: Set flash message - invalid email
            header('Location: ' . BASE_URL . '/adminaccount/index/' . $userId);
            exit;
        }

        $userModel = $this->model('User');
        $updateData = [
            'name' => trim($_POST['name'] ?? ''),
            'username' => $username,
            'email' => $email,
            'is_admin' => $isAdmin
        ];
        if (!empty($password)) {
            $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }
        $userModel->update($userId, $updateData);

        // TODO: Set flash message - success
        header('Location: ' . BASE_URL . '/adminaccount/index/' . $userId);
        exit;
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/adminaccount');
            exit;
        }

        $userId = $_POST['user_id'] ?? null;

        if (empty($userId)) {
            // TODO: Set flash message - invalid user
            header('Location: ' . BASE_URL . '/adminaccount');
            exit;
        }

        // Cek jangan sampai hapus diri sendiri
        if ($userId == $this->getAdmin()['id']) {
            // TODO: Set flash message - cannot delete self
            header('Location: ' . BASE_URL . '/adminaccount/index/' . $userId);
            exit;
        }

        $userModel = $this->model('User');
        $userModel->delete($userId);

        // TODO: Set flash message - success
        header('Location: ' . BASE_URL . '/adminaccount');
        exit;
    }

    public function create()
    {
        $admin = $this->getAdmin();
        
        $this->view('admin/account_create', [
            'adminName' => $admin['name']
        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/adminaccount');
            exit;
        }

        // Validasi input
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $isAdmin = isset($_POST['is_admin']) ? 1 : 0;

        if (empty($username) || empty($email) || empty($password)) {
            // TODO: Set flash message - required fields
            header('Location: ' . BASE_URL . '/adminaccount/create');
            exit;
        }

        // Validasi email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // TODO: Set flash message - invalid email
            header('Location: ' . BASE_URL . '/adminaccount/create');
            exit;
        }

        $userModel = $this->model('User');
        // Optionally check for duplicate email/username here
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userModel->create([
            'name' => trim($_POST['name'] ?? ''),
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword,
            'is_admin' => $isAdmin
        ]);

        // TODO: Set flash message - success
        header('Location: ' . BASE_URL . '/adminaccount');
        exit;
    }
}