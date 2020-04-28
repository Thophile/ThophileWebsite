<?php

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
$router->get('/', function() {

    $title = 'Thophile\'s Website';
    include_once 'views/home.php';
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

//Go to admin section
$router->get("/admin", function($request, $db, $auth){

  //Check for authorization
  if(isset($_COOKIE['token']) && $auth->validateToken($_COOKIE['token'])){
    $title = "Thophile's Website | Admin";

    //Geting all projects
    $projects = $db->getProjects();

    //Getting currently editing project
    if(isset($_GET['id'])){
      //ID == 0 ? new Project : editing Project
      $project = $_GET['id'] == "0" ? [] : $db->getProject($_GET['id']);
    }
    include_once 'views/admin.php';

  }else{
    $title = "Thophile's Website | Login";
    include_once 'views/admin_landing.php';
  }
});

//Log in
$router->post('/login', function($request, $db, $auth) {
  //Password check
  if($auth->validatePassword($request->getBody()['password'])){

    //Setting token in cookies, will expire with session
    setcookie('token', $auth->generateToken(), 0);

    //Redirect
    header("Location: http://{$_SERVER['HTTP_HOST']}/admin");
    die();

  }else{

    $title = "Thophile's Website | Login";
    $error="Wrong Password";
    include_once 'views/admin_landing.php';
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
          move_uploaded_file($tmpFilePath, "./uploadFolder/" . $_FILES['file']['name'][$i]);
        }
      }
    }

    //Handle project edit/new
    $project = json_decode($_POST['project'], true);

    if($project['id'] == 0){
      //Create and refresh
      $db->createProject($project);
      header("Location: http://{$_SERVER['HTTP_HOST']}/admin");
    }else{
      //Update
      $db->updateProject($project);
    }

  }else{
    http_response_code(401);
    header("Location: http://{$_SERVER['HTTP_HOST']}/admin");
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
    http_response_code(401);
  }
  //Redirect
  header("Location: http://{$_SERVER['HTTP_HOST']}/admin");
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

