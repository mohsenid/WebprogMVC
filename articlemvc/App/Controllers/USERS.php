<?php

    class Users extends Controller{
        public function __construct()
        {
            $this->userModel = $this->model('User');
        }
        public function register() {
            // Check for methode post
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                // Process Form
                // die('Submit Form') test if it works
                // Sanitize post data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                 // Init Data
                 $data =[
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),

                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];
                // Validate Name
                if(empty($data['name'])){
                    $data['name_err'] = 'Please inter your Name';
                }
                // Validate email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please inter your Email';
                }else{
                    // Check Email if already excist
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_err'] = 'Email address is already registered';
                    }
                }
                // Validate password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please inter your Password';
                }elseif(strlen($data['password']) < 6){
                    $data['password_err'] = 'The Password field must be at least 6 characters.';
                }

                // Validate confirm password
                if(empty($data['password'])){
                    $data['confirm_password_err'] = 'Please confirm your Password';
                }elseif($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'The confirm Password confirmation does not match.';
                }

                // Make sure errors empty
                if(empty($data["name_err"]) && empty($data['email_err']) && empty($data['password_err'])  && empty($data['confirm_password_err'])){
                    // Validated
                    // die('success');

                    // Hash Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Register User
                    if($this->userModel->register($data)){
                        flash('register_success', 'Welcome, You are now registered');
                       redirect('users/login');
                    }else{
                        die('Error User Registeration');
                    }
                }else{
                    // Load view register with errors
                    $this->view('users/register', $data);
                }

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
                // die('Submit Form');
                 // Sanitize post data
                 $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                 // Init Data
                 $data =[
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => '',
                ];

                // Validate email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please inter your Email';
                }elseif($this->userModel->findUserByEmail($data['email'])) { // Check for user/email if this is already exist
                    // User Found


                }else{
                    // User Not Found
                    $data['email_err'] = 'The email address doesn\'t found';
                }
                // Validate password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please inter your Password';
                }
                // Make sure errors empty
                if(empty($data['email_err']) && empty($data['password_err'])){
                    // Validated
                    // die('success');
                    $loggedInUser = $this->userModel->login($data);
                    if($loggedInUser){
                        // Create session
                        die('success');
                    }else{
                        $data['password_err'] = 'Your Password is incorrect';
                        $this->view('users/login', $data);
                    }
                }else{
                    // Load view register with errors
                    $this->view('users/login', $data);
                }
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