<?php
if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){
    include_once $_SERVER['DOCUMENT_ROOT'].'/errors/403.html';
    die();
}
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

    //Connection to database
    private $conn = null;
 
    // Get the database connection
    public function connect(){

        try{
            $this->conn = new PDO("mysql:host=" . env("DB_HOST") . ";port=" . env("DB_PORT") . ";dbname=" . env("DB_NAME"), env("DB_USERNAME"), env("DB_PASSWORD"));
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
            //Get records
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
    public function createProject($project){

        $query = "INSERT INTO projects (title, category, banner_image, images, links, article) VALUES (:title, :category, :banner_image, :images, :links, :article)";

        //Prepare the query
        if($this->conn == null){
            $this->connect();
        }
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
        $query = "SELECT id FROM projects ORDER BY id DESC LIMIT 1";

        if($this->conn == null){
            $this->connect();
        }
        $stmt = $this->conn->query($query);

        $id = $stmt->fetch();
        return $id;
    }
    public function updateProject($project){
        $query = "UPDATE projects SET title =:title, category =:category, banner_image =:banner_image, images =:images, links =:links, article =:article WHERE id= :id";
 
        //Prepare the query
        if($this->conn == null){
            $this->connect();
        }
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
    public function deleteProject($id){
        $query = "DELETE FROM projects WHERE id = :id";

        //Prepare the query
        if($this->conn == null){
            $this->connect();
        }
        $stmt = $this->conn->prepare($query);

        $stmt->execute(['id' => $id]);

        if($stmt->rowCount() <= 0){
            http_response_code(400);
            include($_SERVER['DOCUMENT_ROOT'].'/errors/400.html'); 
            die();
        }
    }

//Update Site statistics
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
        $query = "SELECT * FROM statistics WHERE page = :page";

        //Prepare the query
        if($this->conn == null){
            $this->connect();
        }
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
            //Add ip to tab if no match
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
                //Add referer to tab if no match
                else{
                    $referers[] = $referer.' 1';
                }
            }
            
        //Update datas
            $query = "UPDATE statistics SET ip_adress =:ip_adress, views =:views, referer =:referer WHERE page= :page";
 
            //Prepare the query
            if($this->conn == null){
                $this->connect();
            }
            $stmt = $this->conn->prepare($query);

//if the page hasn't already an dentry
        }else{

        //Initialise field to database format
            $ips[] = $ip.' 1';
            $views = '1';
            if($referer != "") $referers[] = $referer.' 1';
           

        //Create page in statistics database

            $query = "INSERT INTO statistics (page, ip_adress, views, referer) VALUES (:page, :ip_adress, :views, :referer)";
            //Prepare the query
            if($this->conn == null){
                $this->connect();
            }
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