<?php
    class Job {
        private $db;

        public function __construct(){
            //instentiate object $db with class
            $this->db=new Database;
        }

        //get all jobs
       public function getAllJobs() {
            //getting data from database and saving into 'db' object
            //using query function since we have used database class.
            $this->db->query("SELECT jobs.*,categories.name AS cname
                    FROM jobs
                    INNER JOIN categories
                    ON jobs.category_id = categories.id
                    ORDER BY post_data DESC
                    ");
            //assign the above operations to result set
            $results = $this->db->resultSet();
            return $results;
        }

    }


?>