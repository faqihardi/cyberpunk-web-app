<?php

class AdminsubmissionController extends AdminController
{
    public function index($selectedId = null)
    {
        // Dummy data sementara
        $submissions = [
            ['id' => 1, 'title' => 'Submission 1', 'image' => '/images/sub1.jpg', 'resolution' => '3840 x 2160', 'theme' => 'City 77 Streets', 'author' => 'argel', 'user' => 'Admin 1'],
            ['id' => 2, 'title' => 'Submission 2', 'image' => '/images/sub2.jpg', 'resolution' => '1920 x 1080', 'theme' => 'Neon Nights', 'author' => 'john', 'user' => 'User 1'],
        ];

        $selectedId = $selectedId ?? $submissions[0]['id'];
        $selected = null;

        foreach ($submissions as $sub) {
            if ($sub['id'] == $selectedId) {
                $selected = $sub;
                break;
            }
        }

        $this->view('admin/submission_control', [
            'submissions' => $submissions,
            'selected'    => $selected,
            'selectedId'  => $selectedId,
            'adminName'   => $this->admin()['name']
        ]);
    }

    public function delete($id)
    {
        // TODO:
        // $this->model('Submission')->delete($id);

        header('Location: ' . BASE_URL . '/adminsubmission');
        exit;
    }
}
