<?php
    class User{
        private $db;
        public function __construct()
        {
            $this->db = new Database;
        }
        // Find user by email
        public function findUserByEmail($email){
            $this->db->query('SELECT * FROM users WHERE email = :email');

            // Bind param
            $this->db->bind(':email', $email);
            // Execute
            $this->db->fetch();

            // Check row
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }
        }
    }