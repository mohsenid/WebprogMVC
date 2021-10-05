<?php
    /* PDO Database Class
    * Connect to database
    * Create Prepared statments
    * Bind Values
    * Return rows and value
    */

    class Database{
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;

        private $dbh;
        private $stmt;
        private $error;

        public function __construct()
        {
            // Set DNS
            $dsn = 'mysql:host='. $this->host . ';dbname='.$this->dbname.';charset=utf8';

            // Create PDO instance
            try{
                $this->dbh = new PDO($dsn, $this->user, $this->pass);

                $this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

                // $article['title'] pour recupere les information comme un array
                // $article->title pour recuperer les informations comme un objet apres fetch
            }catch(PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }
        // Prepare Statement with query
        public function query($sql){
            // SELECT * FROM articles WHERE id=:id;
            $this->stmt = $this->dbh->prepare($sql);
        }

        // Bind Value
        public function bind($param, $value){
            $this->stmt->bindParam($param, $value);
        }

        // Execute the prepared statment
        public function execute(){
            return $this->stmt->execute();
        }

        // Get ressualt set as array of object
        public function fetchAll(){
            $this->execute();
            return $this->stmt->fetchAll();
        }

        // Get single record as object
        public function fetch(){
            $this->execute();
            return $this->stmt->fetch();
        }

        // Get row count
        public function rowCount(){
            return $this->stmt->rowCount();
        }
    }