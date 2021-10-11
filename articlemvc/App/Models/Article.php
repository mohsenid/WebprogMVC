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
    }