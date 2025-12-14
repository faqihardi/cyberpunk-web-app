<?php

class NewsController extends Controller
{
    public function index()
    {
        $newsModel = $this->model('News');
        $newsList = $newsModel->getAll();
        $news = !empty($newsList) ? $newsList[0] : null;
        $this->view('news/index', [
            'news' => $news
        ]);
    }
}