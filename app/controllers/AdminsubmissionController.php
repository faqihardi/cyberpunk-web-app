<?php

class AdminsubmissionController extends AdminController
{
    public function index($selectedId = null)
    {
        $admin = $this->getAdmin();
        
        $submissionModel = $this->model('Submission');
        $submissions = $submissionModel->getAll();

        if ($selectedId === null && !empty($submissions)) {
            $selectedId = $submissions[0]['id'];
        }

        $selected = null;
        foreach ($submissions as $sub) {
            if ($sub['id'] == $selectedId) {
                $selected = $sub;
                break;
            }
        }

        if ($selected === null && !empty($submissions)) {
            header('Location: ' . BASE_URL . "/adminsubmission/" . $submissions[0]['id']);
            exit;
        }

        $this->view('admin/submission_control', [
            'submissions' => $submissions,
            'selected'    => $selected,
            'selectedId'  => $selectedId,
            'adminName'   => $admin['name']
        ]);
    }

    public function edit($id)
    {
        $admin = $this->getAdmin();
        $submissionModel = $this->model('Submission');
        $submission = $submissionModel->findById($id);
        if (!$submission) {
            header('Location: ' . BASE_URL . '/adminsubmission');
            exit;
        }
        // Map DB fields to form fields
        $submission['user'] = $admin['name'];
        $this->view('admin/submission_create', [
            'adminName' => $admin['name'],
            'editMode' => true,
            'submission' => $submission
        ]);
    }

    public function update()
    {
        $admin = $this->getAdmin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
            header('Location: ' . BASE_URL . '/adminsubmission');
            exit;
        }

        $id = $_POST['id'];
        $title = isset($_POST['title']) ? trim($_POST['title']) : 'Untitled';
        $resolution = isset($_POST['resolution']) ? trim($_POST['resolution']) : '';
        $theme = isset($_POST['theme']) ? trim($_POST['theme']) : '';
        $author = isset($_POST['author']) ? trim($_POST['author']) : '';
        $user_id = $admin['user_id'];

        $submissionModel = $this->model('Submission');
        $existing = $submissionModel->findById($id);
        if (!$existing) {
            header('Location: ' . BASE_URL . '/adminsubmission');
            exit;
        }

        // Handle image upload (keep old if not replaced)
        $imagePath = $existing['image'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/uploads/submission/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = 'submission_' . time() . '_' . rand(1000,9999) . '.' . $ext;
            $target = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $imagePath = '/uploads/submission/' . $filename;
            }
        }

        $submissionModel->update($id, [
            'title' => $title,
            'image' => $imagePath,
            'resolution' => $resolution,
            'theme' => $theme,
            'author' => $author,
            'user_id' => $user_id
        ]);

        header('Location: ' . BASE_URL . '/adminsubmission');
        exit;
    }

    public function create()
    {
        $admin = $this->getAdmin();
        
        $this->view('admin/submission_create', [
            'adminName' => $admin['name'],
            'editMode' => false,
            'submission' => [
                'resolution' => '',
                'theme' => '',
                'author' => '',
                'user' => $admin['name'], // Default ke nama admin yang login
                'image' => ''
            ]
        ]);
    }

    public function store()
    {
        $admin = $this->getAdmin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/adminsubmission/create');
            exit;
        }

        $title = isset($_POST['title']) ? trim($_POST['title']) : 'Untitled';
        $resolution = isset($_POST['resolution']) ? trim($_POST['resolution']) : '';
        $theme = isset($_POST['theme']) ? trim($_POST['theme']) : '';
        $author = isset($_POST['author']) ? trim($_POST['author']) : '';
        $user_id = $admin['user_id'];

        // Handle image upload
        $imagePath = '/uploads/submission/default.png'; // default fallback (ensure this file exists)
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../public/uploads/submission/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $filename = 'submission_' . time() . '_' . rand(1000,9999) . '.' . $ext;
            $target = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $imagePath = '/uploads/submission/' . $filename;
            }
        }

        $submissionModel = $this->model('Submission');
        $submissionModel->create([
            'title' => $title,
            'image' => $imagePath,
            'resolution' => $resolution,
            'theme' => $theme,
            'author' => $author,
            'user_id' => $user_id
        ]);

        header('Location: ' . BASE_URL . '/adminsubmission');
        exit;
    }

    public function delete($id)
    {
        if (empty($id)) {
            header('Location: ' . BASE_URL . '/adminsubmission');
            exit;
        }

        $submissionModel = $this->model('Submission');
        $submissionModel->delete($id);

        // TODO: Set flash message untuk sukses
        header('Location: ' . BASE_URL . '/adminsubmission');
        exit;
    }
}