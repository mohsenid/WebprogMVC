<?php
    class Pages extends Controller{
        public function __construct()
        {
            // echo 'Pages Load';
        }
        public function index(){
            // $articles = $this->model();
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