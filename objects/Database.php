<?php
//Block access from file
if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){
    include_once $_SERVER['DOCUMENT_ROOT'].'/errors/403.html';
    die();
}

/**
 * The class that is responsible for database connection and that stores and handle allowed queries
 * 
 * @author Thophile
 * @license MIT
 */
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

    /**
     * The connection to the database
     * @var PDO|null 
     */
    private $conn = null;
    
    /** @var string $project_table the project table name */
    private $project_table;

    /** @var string $stat_table the stat table name*/
    private $stat_table;
    /**
     * Get the database connection
     */
    public function connect(){

        try{
            $this->conn = new PDO("mysql:host=" . env("DB_HOST") . ";port=" . env("DB_PORT") . ";dbname=" . env("DB_NAME"), env("DB_USERNAME"), env("DB_PASSWORD"));
            $this->project_table = env('DB_PROJECT_TABLE');
            $this->stat_table = env('DB_STAT_TABLE');
        }catch(PDOException $exception){
            echo $exception->getMessage();
            http_response_code(500);
            include($_SERVER['DOCUMENT_ROOT'].'/errors/500.html');
            die();
        }
    }

    /**
     * Get projects from database
     * 
     * @return void|array An array of all the projects in database
     */
    public function getProjects(){

        
        //Prepare the query
        if($this->conn == null){
            $this->connect();
        }
        $query = "SELECT * FROM ".$this->project_table;
        $stmt = $this->conn->prepare($query);
    
        //Execute the query, also check if query was successful
        if($stmt->execute()){
            //Get record
            $projects = $stmt->fetchAll();
            return $projects;
        }else{
            http_response_code(400);
            include($_SERVER['DOCUMENT_ROOT'].'/errors/400.html'); 
            die();
        }
    }

    /**
     * Get a project by its id
     * 
     * @param int $id the id to look for
     * @return void|array the project that matche the id as an associative array
     */
    public function getProject($id){
        
        //Prepare the query
        if($this->conn == null){
            $this->connect();
        }
        $query = "SELECT * FROM ".$this->project_table." WHERE id= :id";
        $stmt = $this->conn->prepare($query);
    
        //Execute the query, also check if query was successful
        $stmt->execute(['id' => $id]);
        
        if($stmt->rowCount() > 0){
            //Get record
            $project = $stmt->fetch();
            return $project;
        }else{
            http_response_code(400);
            include($_SERVER['DOCUMENT_ROOT'].'/errors/400.html'); 
            die();
        }
    }

    /**
     * Create a new project
     * 
     * @param array $project An array that will be saved in database
     * @return void|int the newly created project id
     */
    public function createProject($project){

        
        //Prepare the query
        if($this->conn == null){
            $this->connect();
        }
        $query = "INSERT INTO ".$this->project_table." (title, category, banner_image, images, links, article) VALUES (:title, :category, :banner_image, :images, :links, :article)";
        $stmt = $this->conn->prepare($query);
        
        //Execute the query, also check if query was successful
        $stmt->execute([
        'title' => $project['title'],
        'category' => $project['category'],
        'banner_image' => $project['banner_image'],
        'images' => json_encode($project['images']),
        'links' => json_encode($project['links']),
        'article' => json_encode($project['article'])
        ]);

        if($stmt->rowCount() <= 0){
            http_response_code(400);
            include($_SERVER['DOCUMENT_ROOT'].'/errors/400.html'); 
            die();
        }

        //Return newly created project's id
        
        if($this->conn == null){
            $this->connect();
        }
        $query = "SELECT id FROM ".$this->project_table." ORDER BY id DESC LIMIT 1";
        $stmt = $this->conn->query($query);

        $id = $stmt->fetch();
        return $id;
    }

    /**
     * Update an existing project
     * 
     * @param array $project An array that will be saved in database
     */
    public function updateProject($project){
        //Prepare the query
        if($this->conn == null){
            $this->connect();
        }
        $query = "UPDATE ".$this->project_table." SET title =:title, category =:category, banner_image =:banner_image, images =:images, links =:links, article =:article WHERE id= :id";
        $stmt = $this->conn->prepare($query);
    
        //Execute the query, also check if query was successful
        $stmt->execute([
            'id' => $project['id'],
            'title' => $project['title'],
            'category' => $project['category'],
            'banner_image' => $project['banner_image'],
            'images' => json_encode($project['images']),
            'links' => json_encode($project['links']),
            'article' => json_encode($project['article'])
            ]);
    }

    /**
     * Delete a row in database
     * 
     * @param int $id the of of the projects that will be deleted
     */
    public function deleteProject($id){
        
        //Prepare the query
        if($this->conn == null){
            $this->connect();
        }
        $query = "DELETE FROM ".$this->project_table." WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->execute(['id' => $id]);

        if($stmt->rowCount() <= 0){
            http_response_code(400);
            include($_SERVER['DOCUMENT_ROOT'].'/errors/400.html'); 
            die();
        }
    }
    
    
    /**
     * Get the statistics entries in the database
     * 
     * @return array $statistics An array of all the statistics in database
     */
    public function getStatistics(){
        
        //Prepare the query
        if($this->conn == null){
            $this->connect();
        }
        $query = "SELECT * FROM ".$this->stat_table;
        $stmt = $this->conn->prepare($query);
    
        //Execute the query, also check if query was successful
        $stmt->execute();
        
        if($stmt->rowCount() > 0){
            //Get record
            $statistics = $stmt->fetchAll();
            return $statistics;
        }else{
            http_response_code(400);
            include($_SERVER['DOCUMENT_ROOT'].'/errors/400.html'); 
            die();
        }
    }

    /**
     * Increment view count of a page
     * 
     * @param string $page The page that the view count should be incremented
     */
    public function hit($page){
        //Get values from server
        //Add the id to "page" if it's a project page
        if($page === "/project") $page .= " ".$_GET['id'];
        //Referer checks
        if(isset($_SERVER['HTTP_REFERER']) 
        && (strtolower(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST)) != strtolower($_SERVER['HTTP_HOST']))
        && parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != "127.0.0.1"
        ){
            $referer = $_SERVER['HTTP_REFERER'];
        }else $referer = "";

        $ip = $_SERVER['REMOTE_ADDR'];


        /**    Get the page statistics    **/
        //Prepare the query
        if($this->conn == null){
            $this->connect();
        }
        $query = "SELECT * FROM " . $this->stat_table . " WHERE page = :page";
        $stmt = $this->conn->prepare($query);
        //Execute the query, also check if query was successful
        $stmt->execute(['page' => $page]);

        //Initialise tmp
        $views = 0;
        $ips = [];
        $referers = [];

        // If the page already has an entry

        if($stmt->rowCount() > 0){

            //Get old data
            $data = $stmt->fetch();
            $ips = json_decode($data['ip_adress'], true);
            $views = $data['views'];
            $referers = json_decode($data['referer'], true);

            //Search for ip in ips
            $patern = '/'.$ip.' [0-9]+/';
            $ip_key = array_keys(preg_grep($patern, $ips));
            //Increment ip num
            if (sizeof($ip_key) == 1){
                $ip_tmp = explode(" ", $ips[$ip_key[0]]);
                $ip_tmp[1]++;
                $ips[$ip_key[0]] = implode(" ", $ip_tmp);
            }
            //Add ip to array if no match
            else{
                $ips[] = $ip.' 1';
            }

            //Increment views
            $views++ ;

            //If a referer is set
            if($referer != ""){
                //Search for referer in referers
                $patern = "{".$referer." [0-9]+}";
                $referer_key = array_keys(preg_grep($patern, $referers));
                //Increment referer num
                if (sizeof($referer_key) == 1){
                    $referer_tmp = explode(" ", $referers[$referer_key[0]]);
                    $referer_tmp[1]++;
                    $referers[$referer_key[0]] = implode(" ", $referer_tmp);
                }
                //Add referer to array if no match
                else{
                    $referers[] = $referer.' 1';
                }
            }
            
        //Update datas
        
            //Prepare the query
            if($this->conn == null){
                $this->connect();
            }
            $query = "UPDATE ".$this->stat_table." SET ip_adress =:ip_adress, views =:views, referer =:referer WHERE page= :page";
            $stmt = $this->conn->prepare($query);

        //if the page hasn't already an entry
        }else{

        //Initialise field to database format
            $ips[] = $ip.' 1';
            $views = '1';
            if($referer != "") $referers[] = $referer.' 1';
           

        //Create page in statistics database

            //Prepare the query
            if($this->conn == null){
                $this->connect();
            }
            $query = "INSERT INTO ".$this->stat_table." (page, ip_adress, views, referer) VALUES (:page, :ip_adress, :views, :referer)";
            $stmt = $this->conn->prepare($query);
        }
        
        //Execute the query, statement can be insert or update here, also check if query was successful
        $stmt->execute([
            'page' => $page,
            'ip_adress' =>  json_encode($ips),
            'views' => $views,
            'referer' =>  json_encode($referers)
            ]);
        
        if($stmt->rowCount() <= 0){
            http_response_code(400);
            include($_SERVER['DOCUMENT_ROOT'].'/errors/400.html'); 
            die();
        }

    }
    

}
?>