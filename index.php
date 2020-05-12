<?php
ini_set('display_errors',1);
//This file recieve request and send back the good page
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Request.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Router.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Database.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Authenticator.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/env.php';


//Explicit enough
$db = new Database();
$authenticator = new Authenticator();
$router = new Router(new Request, $db, $authenticator);


//Prevent acces from file name
$router->get('/index.php', function() {
  include_once $_SERVER['DOCUMENT_ROOT'].'/errors/403.html';
  die();
});

//Home
$router->get('/', function($request) {

    $title = 'Thophile\'s Website';
    include_once 'views/home.php';
});


//About page
$router->get('/about', function($request) {
  $lastModified = date ("d F Y H:i:s.", filemtime("publicFolder/" . env("CV_FILENAME")));
  $timezone = date ("P", filemtime("publicFolder/" . env("CV_FILENAME")));
  
  $title = 'Thophile\'s Website | About';
  include_once 'views/about.php';
});

//Download CV
$router->get('/dl_cv', function($request) {

  //Get variable from env
  $fileName = env('CV_FILENAME');
  $file = "publicFolder/" . $fileName;
  
  if(file_exists($file)){

    //Get the file type for the header
    $type = filetype($file);
    
    // Get a date and timestamp
    $today = date("F j, Y, g:i a");
    $time = time();

    //Setting headers
    header("Content-type: $type");
    header("Content-Disposition: attachment;filename={$fileName}");
    header("Content-Transfer-Encoding: binary"); 
    header('Pragma: no-cache'); 
    header('Expires: 0');

    //Send the file
    set_time_limit(0);
    ob_clean();
    flush();
    readfile($file);

  }else{
    //No file, internal error
    http_response_code(500);
    include($_SERVER['DOCUMENT_ROOT'].'/errors/500.html'); 
    die();
  }
});

//Upload a cv
$router->post('/ul_cv', function($request,$db, $auth) {
  //Check for authorization
  if(isset($_COOKIE['token']) && $auth->validateToken($_COOKIE['token'])){
      
    //Handle files if submitted
    if (isset($_FILES['file'])) {

      $tmpFilePath = $_FILES['file']['tmp_name'][0];
      if ($tmpFilePath != ""){
        //Upload the file from the tmp dir
        move_uploaded_file($tmpFilePath, "./publicFolder/" .env('CV_FILENAME'));
      }
    }
  }else{
    //Error forbidden
    http_response_code(403);
    header("Location: http://{$request->httpHost}/admin");
  }
  die();
});




//All projects
$router->get('/projects', function($request, $db) {

  $title = 'Thophile\'s Website | Projects';
  $projects = $db->getProjects();
  include_once 'views/projects.php';
});

//View individual project
$router->get("/project", function($request, $db){

  $project = $db->getProject(isset($_GET['id']) ? $_GET['id'] : "");
  $title = "Thophile's Website | {$project['title']}";
  include_once 'views/project.php';
});



//Admin section
$router->get("/admin", function($request, $db, $auth){

  //Check for authorization
  if(isset($_COOKIE['token']) && $auth->validateToken($_COOKIE['token'])){
    
    $title = "Thophile's Website | Admin";
    $fileName = env("CV_FILENAME");
    $lastModified = date ("d F Y H:i:s.", filemtime("publicFolder/" . $fileName));
    $timezone = date ("P", filemtime("publicFolder/" . $fileName));

    //Getting all statistics
    $statistics = $db->getStatistics();

    //Geting all projects
    $projects = $db->getProjects();

    //Getting currently editing project
    if(isset($_GET['id'])){
      //ID == 0 ? new Project : editing Project
      $project = $_GET['id'] == "0" ? [] : $db->getProject($_GET['id']);
    }
    include_once 'views/admin.php';

  }else{
    header("Location: http://{$request->httpHost}/login");
    die();
  }
});


//Log in
$router->get("/login", function($request){
  $title = "Thophile's Website | Login";
  include_once 'views/login.php';
});

//Login handler
$router->post('/login', function($request, $db, $auth) {
  //Password check
  if($auth->validatePassword($request->getBody()['password'])){

    //Setting token in cookies, will expire with session
    setcookie('token', $auth->generateToken(), 0);

    //Redirect
    header("Location: http://{$request->httpHost}/admin");
    die();

  }else{

    $title = "Thophile's Website | Login";
    $error="Wrong Password";
    include_once 'views/login.php';
  }
});

//Submit data changes
$router->post('/upload', function($request, $db, $auth) {

  //Check for authorization
  if(isset($_COOKIE['token']) && $auth->validateToken($_COOKIE['token'])){
    
    //Handle files if some are submitted
    if (isset($_FILES['file'])) {

      // Loop throught each file
      for( $i = 0; $i < sizeof($_FILES['file']['name']); $i++ ) {
  

        $tmpFilePath = $_FILES['file']['tmp_name'][$i];
        if ($tmpFilePath != ""){

          //Upload the file from the tmp dir
          move_uploaded_file($tmpFilePath, "./publicFolder/" . $_FILES['file']['name'][$i]);
        }
      }
    }

    //Handle project edit/new
    $project = json_decode($_POST['project'], true);

    if($project['id'] == 0){
      //Create and return the id
      echo $db->createProject($project)[0];
    }else{
      //Update
      $db->updateProject($project);
    }

  }else{
    http_response_code(403);
    header("Location: http://{$request->httpHost}/admin");
  }
  die();
});

$router->get('/delete', function($request, $db, $auth) {

  //Check for authorization
  if(isset($_COOKIE['token']) && $auth->validateToken($_COOKIE['token'])){

    //Query the database
    $db->deleteProject($_GET['id']);

  }else{

    //Set Error code if unauthorized
    http_response_code(403);
  }
  //Redirect
  header("Location: http://{$request->httpHost}/admin");
  die();
  });

/**
 * post request template
 *$router->post('/data', function($request) {
 *
 *  return json_encode($request->getBody());
 *});
 * 
 */

