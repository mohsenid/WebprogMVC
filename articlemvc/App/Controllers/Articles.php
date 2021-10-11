<?php
    class Articles extends controller{
        public function __construct()
        {
            if(!isLoggedIn()){
                redirect('users/login');
            }
            $this->articleModel = $this->model('Article');
        }
        public function index(){
            // Get Aricle
            $articles = $this->articleModel->getArticle();
            $data = [
                'articles' => $articles
            ];
            $this->view('articles/index', $data);
        }
    }