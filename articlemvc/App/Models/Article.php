<?php
    class Article{
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }
        public function getArticle(){
            $this->db->query("SELECT *,
            articles.id articleId, users.id as userId,
            articles.created_at as articleCreated,
            users.created_at as userCreated 
            FROM articles 
            INNER JOIN users 
            ON articles.user_id = users.id 
            ORDER BY articles.created_at DESC ");

            return $this->db->fetchAll();
        }
        public function addArticle($data){
        $this->db->query('INSERT INTO articles ( title, user_id , body) VALUES (:title , :user_id ,:body)');
        // Bind value
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':user_id',$data['user_id']);
        $this->db->bind(':body',$data['body']);

        // Execute
        if( $this->db->execute() ){
            return true;
        }else{
            return false;
        }
        }
        
    }