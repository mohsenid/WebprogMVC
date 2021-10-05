<?php
    class Pages extends Controller{
        public function __construct()
        {
            // echo 'Pages Load';
            // $this->articleModel = $this->model('Article');
        }
        public function index(){
            // $articles = $this->model();
            // $articles = $this->articleModel->getArticle();
            $data = [
                'title' => 'Webprog.ir' ,
                // 'article' => $articles
                
            ];
            $this->view('Pages/index', $data);
        }
        public function about(){
            $this->view('Pages/about');
            $data = [
                'title' => 'About Us'
            ];
        }
    }