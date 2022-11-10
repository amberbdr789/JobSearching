<?php
    class Database{
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS ;
        private $dbname = DB_NAME;

        private $dbh;//database handler
        private $error;
        private $stmt;

        //database connection
        public function __construct() {
            //we can use 12 database, mysql is one of them
            $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;

            //set options
            $options = array (
                PDO::ATTR_PERSISTENT =>true, //we want persistant connection
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            //PDO instance
            //catch and throw error
            try {
                //
                $this->dbh = new PDO($dsn, $this->user, $this->pass, $options); 
            } catch(PDOException $e) {
                $this->error = $e-> getMessage();
            }
        }
        //create the method called query
        public function query($query) {
            $this->stmt = $this->dbh->prepare($query);//prepared statements
        }

        //when working with values, we have to bind the values.
        public function bind($param, $value, $type=null) {
            if(is_null($type)) {
                switch(true) {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool ($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null ($value):
                        $type = PDO::PARAM_INT;
                        break;
                    default :
                        $type = PDO::PARAM_STR;
                }   
            }
            $this->stmt->bindvalue($param, $value, $type);
        }

        public function execute() {
            return $this->stmt->execute();
        }

        //get results/data from database;
        public function resultSet() {
            $this->execute();
            //return as a statements, 
            //"PDO::FETCH_OBJ", return as an objects
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        //fetching single value, ex. only single job
        public function single() {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }   
    }
    
?>

