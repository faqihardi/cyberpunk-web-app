<?php

class UsersubmissionsController extends Controller
{
    public function index($id = null)
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin']) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $submissionModel = $this->model('Submission');
        $submissions = $submissionModel->getByUserId($_SESSION['user']['user_id']);
        $userName = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 'User';

        // Get selected submission (first one by default, or by ID)
        $selected = null;
        $selectedId = null;
        
        if ($id) {
            // Find submission by ID
            $selected = $submissionModel->findById($id);
            // Verify ownership
            if ($selected && $selected['user_id'] == $_SESSION['user']['user_id']) {
                $selectedId = $id;
            } else {
                $selected = null;
            }
        }
        
        // If no valid selection, pick first submission
        if (!$selected && !empty($submissions)) {
            $selected = $submissions[0];
            $selectedId = $selected['id'];
        }

        $this->view('user/submission_control', [
            'submissions' => $submissions,
            'userName'    => $userName,
            'selected'    => $selected,
            'selectedId'  => $selectedId
        ]);
    }

    public function create()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin']) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $userName = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 'User';

        $this->view('user/submission_create', [
            'userName' => $userName,
            'editMode' => false
        ]);
    }

    public function store()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin']) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $data = [
            'title'      => $_POST['title'] ?? '',
            'resolution' => $_POST['resolution'] ?? '',
            'theme'      => $_POST['theme'] ?? '',
            'author'     => $_POST['author'] ?? '',
            'user_id'    => $_SESSION['user']['user_id'],
            'image'      => ''
        ];

        // Handle image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Buat folder jika belum ada
            $uploadDir = __DIR__ . '/../../public/uploads/submissions/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = uniqid('sub_') . '.' . $ext;
            $target = $uploadDir . $filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $data['image'] = '/uploads/submissions/' . $filename;
            }
        }

        $submissionModel = $this->model('Submission');
        $newId = $submissionModel->create($data);

        // Redirect ke submission yang baru dibuat
        header('Location: ' . BASE_URL . '/usersubmissions/index/' . $newId);
        exit;
    }

    public function edit($id)
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin']) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $submissionModel = $this->model('Submission');
        $submission = $submissionModel->findById($id);

        if (!$submission || $submission['user_id'] != $_SESSION['user']['user_id']) {
            header('Location: ' . BASE_URL . '/usersubmissions');
            exit;
        }

        $userName = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 'User';

        $this->view('user/submission_create', [
            'userName'   => $userName,
            'editMode'   => true,
            'submission' => $submission
        ]);
    }

    public function update()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin']) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $id = $_POST['id'] ?? null;
        $submissionModel = $this->model('Submission');
        $submission = $submissionModel->findById($id);

        if (!$submission || $submission['user_id'] != $_SESSION['user']['user_id']) {
            header('Location: ' . BASE_URL . '/usersubmissions');
            exit;
        }

        $data = [
            'title'      => $_POST['title'] ?? '',
            'resolution' => $_POST['resolution'] ?? '',
            'theme'      => $_POST['theme'] ?? '',
            'author'     => $_POST['author'] ?? '',
            'user_id'    => $_SESSION['user']['user_id'],
            'image'      => $submission['image'] // Keep old image by default
        ];

        // Handle new image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Delete old image if exists
            if (!empty($submission['image'])) {
                $oldImagePath = __DIR__ . '/../../public' . $submission['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Upload new image
            $uploadDir = __DIR__ . '/../../public/uploads/submissions/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = uniqid('sub_') . '.' . $ext;
            $target = $uploadDir . $filename;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $data['image'] = '/uploads/submissions/' . $filename;
            }
        }

        $submissionModel->update($id, $data);

        // Redirect ke submission yang baru di-update
        header('Location: ' . BASE_URL . '/usersubmissions/index/' . $id);
        exit;
    }

    public function delete($id)
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['is_admin']) {
            header('Location: ' . BASE_URL . '/auth/login');
            exit;
        }

        $submissionModel = $this->model('Submission');
        $submission = $submissionModel->findById($id);

        if ($submission && $submission['user_id'] == $_SESSION['user']['user_id']) {
            // Delete image file from filesystem
            if (!empty($submission['image'])) {
                $imagePath = __DIR__ . '/../../public' . $submission['image'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            
            // Delete from database
            $submissionModel->delete($id);
        }

        header('Location: ' . BASE_URL . '/usersubmissions');
        exit;
    }
}