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
                    $data['name_err'] = 'Please enter your name';
                }
                // Validate email
                if(empty($data['email'])){
                    $data['email_err'] = 'Please enter your email';
                }else{
                    // Check Email if already excist
                    if($this->userModel->findUserByEmail($data['email'])){
                        $data['email_err'] = 'Email address is already registered';
                    }
                }
                // Validate password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter your password';
                }elseif(strlen($data['password']) < 6){
                    $data['password_err'] = 'Password field must be at least 6 characters.';
                }

                // Validate confirm password
                if(empty($data['password'])){
                    $data['confirm_password_err'] = 'Please confirm your password';
                }elseif($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Password confirmation does not match.';
                }

                // Make sure errors empty
                if(empty($data["name_err"]) && empty($data['email_err']) && empty($data['password_err'])  && empty($data['confirm_password_err'])){
                    // Validated
                    // die('success');

                    // Hash Password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Register User
                    if($this->userModel->register($data)){
                        flash('register_success', 'Welcome, you are now registered');
                       redirect('users/login');
                    }else{
                        die('Error user registration');
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
                    $data['email_err'] = 'Please enter your Email';
                }elseif($this->userModel->findUserByEmail($data['email'])) { // Check for user/email if this is already exist
                    // User Found


                }else{
                    // User Not Found
                    $data['email_err'] = 'Email address not found';
                }
                // Validate password
                if(empty($data['password'])){
                    $data['password_err'] = 'Please enter your password';
                }
                // Make sure errors empty
                if(empty($data['email_err']) && empty($data['password_err'])){
                    // Validated
                    // die('success');
                    $loggedInUser = $this->userModel->login($data);
                    if($loggedInUser){
                        // Create session
                        // die('success');
                        $this->createUserSession($loggedInUser);
                    }else{
                        $data['password_err'] = ' Wrong password';
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
        public function createUserSession($user){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;

            redirect('articles'); //<hich page will redirect after login
        }
        public function logout(){
            unset($_SESSION['user_id']) ;
            unset($_SESSION['user_email']) ;
            unset($_SESSION['user_name']) ;
            session_destroy();
            redirect('users/login');
        }
    }