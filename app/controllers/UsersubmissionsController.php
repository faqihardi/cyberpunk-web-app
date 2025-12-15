<?php
class UseraccountController extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin']) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }
        
        $userModel = $this->model('User');
        $user = $userModel->findById($_SESSION['user']['user_id']);
        $userName = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 'User';
        
        $this->view('user/your_account', [
            'user' => $user,
            'userName' => $userName
        ]);
    }

    public function update()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin']) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $userId = $_POST['user_id'] ?? null;
        if ($userId != $_SESSION['user']['user_id']) {
            header('Location: ' . BASE_URL . '/useraccount');
            exit;
        }

        $userModel = $this->model('User');
        
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        
        $existingUser = $userModel->findByUsername($username);
        if ($existingUser && $existingUser['id'] != $userId) {
            $_SESSION['error'] = 'Username already taken';
            header('Location: ' . BASE_URL . '/useraccount');
            exit;
        }
        
        $existingEmail = $userModel->findByEmail($email);
        if ($existingEmail && $existingEmail['id'] != $userId) {
            $_SESSION['error'] = 'Email already registered';
            header('Location: ' . BASE_URL . '/useraccount');
            exit;
        }

        $data = [
            'name'     => $_POST['name'] ?? '',
            'username' => $username,
            'email'    => $email
        ];

        if (!empty($_POST['password'])) {
            $data['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
        }

        if ($userModel->update($userId, $data)) {
            $_SESSION['user']['name'] = $data['name'];
            $_SESSION['user']['username'] = $data['username'];
            $_SESSION['user']['email'] = $data['email'];
            
            $_SESSION['success'] = 'Account updated successfully';
        } else {
            $_SESSION['error'] = 'Failed to update account';
        }

        header('Location: ' . BASE_URL . '/useraccount');
        exit;
    }

    public function delete()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin']) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $userId = $_POST['user_id'] ?? null;
        if ($userId != $_SESSION['user']['user_id']) {
            header('Location: ' . BASE_URL . '/useraccount');
            exit;
        }

        $userModel = $this->model('User');
        
        $submissionModel = $this->model('Submission');
        $submissions = $submissionModel->getByUserId($userId);
        
        foreach ($submissions as $submission) {
            if (!empty($submission['image'])) {
                $imagePath = __DIR__ . '/../../public' . $submission['image'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }
        

        $submissionModel->deleteByUserId($userId);
        
        if ($userModel->delete($userId)) {
            session_destroy();
            header('Location: ' . BASE_URL . '/auth/login');
        } else {
            $_SESSION['error'] = 'Failed to delete account';
            header('Location: ' . BASE_URL . '/useraccount');
        }
        exit;
    }
}