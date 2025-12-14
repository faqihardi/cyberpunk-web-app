<?php

class AdminnewsController extends AdminController
{
    public function index()
    {
        $admin = $this->getAdmin();
        
        // Dummy sementara - nanti ambil dari database
        $newsData = [
            'version' => 'update 2.3 Patch Notes',
            'header'  => 'Added 2 new vehicles',
            'content' => 'Update 2.3 lands tomorrow on PC...'
        ];

        $this->view('admin/news_control', [
            'news'      => $newsData,
            'adminName' => $admin['name']
        ]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/adminnews');
            exit;
        }

        $version = trim($_POST['version'] ?? '');
        $header  = trim($_POST['header'] ?? '');
        $content = trim($_POST['content'] ?? '');

        // Validasi input
        if (empty($version) || empty($header) || empty($content)) {
            // TODO: Set flash message untuk error
            header('Location: ' . BASE_URL . '/adminnews');
            exit;
        }

        // TODO: Simpan ke database
        // $newsModel = $this->model('News');
        // $newsModel->update($version, $header, $content);

        // TODO: Set flash message untuk sukses
        header('Location: ' . BASE_URL . '/adminnews');
        exit;
    }
}