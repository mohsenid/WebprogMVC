<?php

    class Users extends Controller{
        public function __construct()
        {
            
        }
        public function register() {
            // Check for methode post
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process Form
                // die('Submit Form') test if it works
            }else{
                // Load Form
                //die('Load Form');
                // Init Data
                $data =[
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',

                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];
                $this->view('users/register', $data);
            }
        }
    
        public function login() {
            // Check for methode post
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process Form
            }else{
                // Load Form
                //die('Load Form');
                // Init Data
                $data =[
                    'email' => '',
                    'password' => '',
                    
                    'email_err' => '',
                    'password_err' => '',
                ];
                $this->view('users/login', $data);
            }
        }
    }