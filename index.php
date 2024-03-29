<?php
//Include classes
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Authenticator.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Database.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Request.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Router.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Translator.php';

//Include Environnement file
include_once $_SERVER['DOCUMENT_ROOT'].'/env.php';

//Instanciate objects
$db = new Database();
$auth = new Authenticator();
$translator = new Translator();
$router = new Router(new Request, $db, $auth);


//Prevent acces from file name
$router->get('/index.php', function() {
  include_once $_SERVER['DOCUMENT_ROOT'].'/errors/403.html';
  die();
});

$router->get('/test', function() {
  setTranslation("TEST.1","salut","fr");
  setTranslation("TEST.1","hello","en");
  setTranslation("TEST.2","911 is known in any languages");
});

//Home
$router->get('/', function($request) {

    $title = 'Thophile Labs | Home';
    include_once 'views/home.php';
});


//About page
$router->get('/about', function($request) {
  if(file_exists($_SERVER['DOCUMENT_ROOT']."/publicFolder/" . env("CV_FILENAME"))){
    $lastModified = date ("d F Y H:i:s.", filemtime($_SERVER['DOCUMENT_ROOT']."/publicFolder/" . env("CV_FILENAME")));
    $timezone = date ("P", filemtime($_SERVER['DOCUMENT_ROOT'] . "/publicFolder/" . env("CV_FILENAME")));
  }
  
  $title = 'Thophile Labs | About';
  include_once 'views/about.php';
});

//Download CV
$router->get('/dl_cv', function($request) {

  //Get variable from env
  $fileName = env('CV_FILENAME');
  $file = $_SERVER['DOCUMENT_ROOT']."/publicFolder/" . $fileName;
  
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
        move_uploaded_file($tmpFilePath, $_SERVER['DOCUMENT_ROOT'] . "/publicFolder/" .env('CV_FILENAME'));
      }
    }
  }else{
    //Error forbidden
    http_response_code(403);
    header("Location: https://{$request->httpHost}/admin");
  }
  die();
});




//All projects
$router->get('/projects', function($request, $db) {

  $title = 'Thophile Labs | Projects';
  $projects = $db->getAll("PROJECTS");
  include_once 'views/projects.php';
});

//View individual project
$router->get("/project", function($request, $db){

  $project = $db->get("PROJECTS", isset($_GET['id']) ? $_GET['id'] : "");
  $title = "Thophile Labs | ".translate($project['TITLE']);
  include_once 'views/project.php';
});



//Admin section
$router->get("/admin", function($request, $db, $auth){

  //Check for authorization
  if(isset($_COOKIE['token']) && $auth->validateToken($_COOKIE['token'])){
    
    $title = "Thophile Labs | Admin";
    $fileName = env("CV_FILENAME");
    
    if(file_exists($_SERVER['DOCUMENT_ROOT']."/publicFolder/" . env("CV_FILENAME"))){
      $lastModified = date ("d F Y H:i:s.", filemtime($_SERVER['DOCUMENT_ROOT']."/publicFolder/" . $fileName));
      $timezone = date ("P", filemtime($_SERVER['DOCUMENT_ROOT']."/publicFolder/" . $fileName));
    }
    //Getting all statistics
    //$statistics = $db->getStatistics();

    //Geting all projects
    $projects = $db->getAll("PROJECTS");

    //Getting currently editing project
    if(isset($_GET['id'])){
      //ID == 0 ? new Project : editing Project
      $project =  $db->get("PROJECTS", $_GET['id']);
    }
    if(isset($_GET['new'])){
      $project = [];
    }
    include_once 'views/admin.php';

  }else{
    header("Location: https://{$request->httpHost}/login");
    die();
  }
});


//Log in
$router->get("/login", function($request){
  $title = "Thophile Labs | Login";
  include_once 'views/login.php';
});

//Login handler
$router->post('/login', function($request, $db ,$auth) {
  //Password check
  if($auth->validatePassword($request->getBody()['password'])){

    //Setting token in cookies, will expire with session
    setcookie('token', $auth->generateToken(), 0);

    //Redirect
    header("Location: https://{$request->httpHost}/admin");
    die();

  }else{

    $title = "Thophile Labs | Login";
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
          move_uploaded_file($tmpFilePath, $_SERVER['DOCUMENT_ROOT']."/publicFolder/" . $_FILES['file']['name'][$i]);
        }
      }
    }

    //Handle project edit/new
    $project = json_decode($_POST['PROJECT'], true);

    if(isset($_GET['new']) && $_GET['new'] == true){
      //Create and return the id
      echo $db->set("PROJECTS", $project);
    }else{
      //Update
      $db->set("PROJECTS", $project);
    }

  }else{
    http_response_code(403);
    header("Location: https://{$request->httpHost}/admin");
  }
  die();
});

$router->get('/delete', function($request, $db, $auth) {

  //Check for authorization
  if(isset($_COOKIE['token']) && $auth->validateToken($_COOKIE['token'])){

    //Query the database
    $db->delete("PROJECTS", $_GET['id']);

  }else{

    //Set Error code if unauthorized
    http_response_code(403);
  }
  //Redirect
  header("Location: https://{$request->httpHost}/admin");
  die();
  });

$router->get('/setlocale', function(){

  if(isset($_GET['l']) && isset($_GET['r'])){
    changeLocale($_GET['l']);
    header("Location: ".$_GET['r']);
  }else{
    http_response_code(400);
  }
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

