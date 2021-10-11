<?php
    class Articles extends controller{
        public function __construct()
        {
            
        }
        public function index(){
            $data = [];
            $this->view('articles/index', $data);
        }
    }