<?php

class AdminnewsController extends AdminController
{
    public function index()
    {
        $admin = $this->getAdmin();
        $newsModel = $this->model('News');
        $newsList = $newsModel->getAll();
        $newsData = !empty($newsList) ? $newsList[0] : [
            'version' => '',
            'header' => '',
            'content' => ''
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

        $newsModel = $this->model('News');
        $newsList = $newsModel->getAll();
        $admin = $this->getAdmin();
        if (!empty($newsList)) {
            // Update the latest news entry
            $newsModel->update($newsList[0]['id'], [
                'version' => $version,
                'header' => $header,
                'content' => $content,
                'updated_by' => $admin['user_id']
            ]);
        } else {
            // Create new news entry
            $newsModel->create([
                'version' => $version,
                'header' => $header,
                'content' => $content,
                'updated_by' => $admin['user_id']
            ]);
        }
        // TODO: Set flash message untuk sukses
        header('Location: ' . BASE_URL . '/adminnews');
        exit;
    }
}