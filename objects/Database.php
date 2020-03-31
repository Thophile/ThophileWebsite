<?php
// used to get mysql database connection
class Database{
    /**
     * @Reminder
     * 
     * prepare statement
     * $stmt = $this->conn->prepare($query);
     * 
     * bind param
     * $stmt->bindParam(':email', $this->email);
     * 
     * execute statement
     * $stmt->execute()
     * 
     * count the number of result
     * $num = $stmt->rowCount();
     * 
     * fetching rows
     * $row = $stmt->fetch(PDO::FETCH_ASSOC);
     */

    // Database credentials
    private $host = "localhost";
    private $port = "3308";
    private $db_name = "thophile_website";
    private $username = "root";
    private $password = "";
    private $conn = null;
 
    // Get the database connection
    public function connect(){

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo $exception->getMessage();
            http_response_code(500);
            include($_SERVER['DOCUMENT_ROOT'].'/errors/500.html');
            die();
        }
    }

    //Get projects from database
    public function getProjects(){

        $query = "SELECT * FROM projects";
 
        //Prepare the query
        if($this->conn == null){
            $this->connect();
        }
        $stmt = $this->conn->prepare($query);
    
        //Execute the query, also check if query was successful
        $stmt->execute();
        
        //count the number of result
        $num = $stmt->rowCount();

        if($num>0){
            //Get record
            $projects = $stmt->fetchAll();
            return $projects;
        }
    }
    public function getProject($id){
        $query = "SELECT * FROM projects WHERE id= :id";
 
        //Prepare the query
        if($this->conn == null){
            $this->connect();
        }
        $stmt = $this->conn->prepare($query);
    
        //Execute the query, also check if query was successful
        $stmt->execute(['id' => $id]);
        
        //count the number of result
        $num = $stmt->rowCount();

        if($num>0){
            //Get record
            $project = $stmt->fetch();
            return $project;
        }else{
            http_response_code(404);
            include($_SERVER['DOCUMENT_ROOT'].'/errors/404.html'); 
            die();
        }
    }

}
?>