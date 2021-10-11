<?php
    class Articles extends controller{
        public function __construct()
        {
            if(!isLoggedIn()){
                redirect('users/login');
            }
            $this->articleModel = $this->model('Article');
            $this->userModel = $this->model('User');
        }
        public function index(){
            // Get Aricle
            $articles = $this->articleModel->getArticle();
            $data = [
                'articles' => $articles
            ];
            $this->view('articles/index', $data);
        }

        public function add(){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_err' => '',
                    'body_err' => ''
                ];

                // Validate Data
                if(empty($data['title'])){
                    $data['title_err'] = 'This field is required';
                }
                if(empty($data['body'])){
                    $data['body_err'] = 'This field is required';
                }

                // Make sure there is no error
                if(empty($data['body_err']) && empty($data['title_err'])){
                    if($this->articleModel->addArticle($data)){
                        flash('article_message', 'The Article successfully added');
                        redirect('articles/index');
                    }else{
                        die('Add article error');
                    }
                }else {
                    // Load view with error
                    $this->view('articles/add', $data);
                }
                
            }else{
                $data = [
                    'title' => '',
                    'body' => '',
                    'title_err' => '',
                    'body_err' => ''
                ];
                 $this->view('articles/add', $data);
            }
        }

        public function show($id){
            $article = $this->articleModel->getArticleById($id);
            $user = $this->userModel->getUserById($article->user_id);

            $data = [
                'article' => $article,
                'user' => $user,
            ];
            $this->view('articles/show', $data);
        }
    }