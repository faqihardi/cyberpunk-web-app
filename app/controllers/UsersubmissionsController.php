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

        $selected = null;
        $selectedId = null;
        
        if ($id) {
            $selected = $submissionModel->findById($id);
            if ($selected && $selected['user_id'] == $_SESSION['user']['user_id']) {
                $selectedId = $id;
            } else {
                $selected = null;
            }
        }
        
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

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
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
            'image'      => $submission['image']
        ];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            if (!empty($submission['image'])) {
                $oldImagePath = __DIR__ . '/../../public' . $submission['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

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
            if (!empty($submission['image'])) {
                $imagePath = __DIR__ . '/../../public' . $submission['image'];
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            
            $submissionModel->delete($id);
        }

        header('Location: ' . BASE_URL . '/usersubmissions');
        exit;
    }
}