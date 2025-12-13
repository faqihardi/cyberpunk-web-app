<?php

class AdminnewsController extends AdminController
{
    public function index()
    {
        // Dummy sementara
        $newsData = [
            'version' => 'update 2.3 Patch Notes',
            'header'  => 'Added 2 new vehicles',
            'content' => 'Update 2.3 lands tomorrow on PC...'
        ];

        $this->view('admin/news_control', [
            'news'      => $newsData,
            'adminName' => $this->admin()['name']
        ]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/adminnews');
            exit;
        }

        $version = trim($_POST['version']);
        $header  = trim($_POST['header']);
        $content = trim($_POST['content']);

        // TODO:
        // $this->model('News')->update($version, $header, $content);

        header('Location: ' . BASE_URL . '/adminnews');
        exit;
    }
}
