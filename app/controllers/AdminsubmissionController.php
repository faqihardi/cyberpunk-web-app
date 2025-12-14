<?php

class AdminsubmissionController extends AdminController
{
    public function index($selectedId = null)
    {
        $admin = $this->getAdmin();
        
        // Dummy data sementara - nanti ambil dari database
        // TODO: $submissions = $this->model('Submission')->getAll();
        $submissions = [
            [
                'id' => 1,
                'title' => 'Submission 1',
                'image' => '/img/bghome.png',
                'resolution' => '3840 x 2160',
                'theme' => 'City 77 Streets',
                'author' => 'argel',
                'user' => 'Admin 1'
            ],
            [
                'id' => 2,
                'title' => 'Submission 2',
                'image' => '/img/2.png',
                'resolution' => '1920 x 1080',
                'theme' => 'Neon Nights',
                'author' => 'john',
                'user' => 'User 1'
            ],
            [
                'id' => 3, 
                'title' => 'Submission 3', 
                'image' => '/img/2.png', 
                'resolution' => '2560 x 1440', 
                'theme' => 'Badlands', 
                'author' => 'sarah', 
                'user' => 'User 2'
            ],
            [
                'id' => 4, 
                'title' => 'Submission 4', 
                'image' => '/img/2.png', 
                'resolution' => '3840 x 2160', 
                'theme' => 'Corporate', 
                'author' => 'mike', 
                'user' => 'Admin 2'
            ],
            [
                'id' => 5, 
                'title' => 
                'Submission 5', 
                'image' => '/img/2.png', 
                'resolution' => '1920 x 1080', 
                'theme' => 'Street Life', 
                'author' => 'lisa', 
                'user' => 'User 3'
            ],
        ];

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

        // TODO: Hapus dari database
        // $submissionModel = $this->model('Submission');
        // $submissionModel->delete($id);

        // TODO: Set flash message untuk sukses
        header('Location: ' . BASE_URL . '/adminsubmission');
        exit;
    }
}