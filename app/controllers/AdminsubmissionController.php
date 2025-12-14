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
        // TODO: Implementasi edit submission
        // $admin = $this->getAdmin();
        // $submission = $this->model('Submission')->getById($id);
        // $this->view('admin/submission_edit', [...]);
        
        header('Location: ' . BASE_URL . '/adminsubmission/' . $id);
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