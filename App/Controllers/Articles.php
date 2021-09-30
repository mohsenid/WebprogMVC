<?php
    class Articles{
        public function __construct()
        {
            echo 'Article Load';
        }
        public function index(){
            
        }
        public function edit($id){
            echo $id;
        }
    }