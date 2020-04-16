<?php
//This file recieve request and send back the good page
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Request.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Router.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Database.php';
session_start();
//Explicit enough
$db = new Database();
$router = new Router(new Request, $db);

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
$router->get("/admin", function($request, $db){
  $title = "Thophile's Website | Admin";
  if(isset($_SESSION['token']) && $_SESSION['token'] === "foo"){

    //fillin the field if a get is present
    $projects = $db->getProjects();
    if(isset($_GET['id'])){
    $project = $db->getProject($_GET['id']);
    }

    $title = "Thophile's Website | Admin";
    include_once 'views/admin.php';
  }else{
    $title = "Thophile's Website | Login";
    include_once 'views/admin_landing.php';
  }
});

//Log in
$router->post('/login', function($request, $db) {
  if($request->getBody()["password"] == "salut"){
    $_SESSION['token'] = "foo";
    header("Location: http://{$_SERVER['HTTP_HOST']}/admin");
    die();
  }else{
    $title = "Thophile's Website | Login";
    $error="Wrong Password";
    include_once 'views/admin_landing.php';
  }
});

/**
 * post request template
 *$router->post('/data', function($request) {
 *
 *  return json_encode($request->getBody());
 *});
 * 
 */

