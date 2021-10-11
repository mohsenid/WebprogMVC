<?php
    class Articles extends controller{
        public function __construct()
        {
            if(!isLoggedIn()){
                redirect('users/login');
            }
        }
        public function index(){
            $data = [];
            $this->view('articles/index', $data);
        }
    }