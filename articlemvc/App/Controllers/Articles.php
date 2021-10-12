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

        public function edit($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => '',
            ];

            // Validate Data
            if (empty($data['title'])) {
                $data['title_err'] = 'Article title field is required';
            }

            if (empty($data['body'])) {
                $data['body_err'] = 'Article text field is required';
            }

            // Make sure no errors
            if (empty($data['title_err']) && empty($data['body_err'])) {

                if ( $this->articleModel->updateArticle($data) ) {

                    flash('article_message', 'Article edited');
                    redirect('articles/index');

                } else {
                    die('udate article error');
                }

            } else {
                // Load view with error
                $this->view('articles/edit', $data);
            }
            } else {

            // Get article
            $article = $this->articleModel->getArticleById($id);

            // Check for owner
            if ($article->user_id != $_SESSION['user_id']) {
                redirect('articles/index');
            }

            $data = [
                'id' => $id,
                'title' => $article->title,
                'body' => $article->body,
                'title_err' => '',
                'body_err' => ''
            ];

            $this->view('articles/edit', $data);
            }
        }

        public function delete($id)
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                // Get article
                $article = $this->articleModel->getArticleById($id);

                // Check for owner
                if ($article->user_id != $_SESSION['user_id']) {
                    redirect('articles/index');
                }

                if ($this->articleModel->deleteArticle($id)) {
                    flash('article_message', 'Article deleted');
                    redirect('articles/index');
                } else {
                    die('Delete Article Error');
                }
            }else {
            redirect('articles/index');
            }
        }
    }