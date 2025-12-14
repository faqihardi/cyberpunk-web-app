<?php

class GalleryController extends Controller
{
    public function index() 
    {
        $submissionModel = $this->model('Submission');
        $submissions = $submissionModel->getAll();
        $this->view('gallery/index', [
            'submissions' => $submissions
        ]);
    }
}