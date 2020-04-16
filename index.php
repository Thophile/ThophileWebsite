<?php
//This file recieve request and send back the good page
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Request.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Router.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Database.php';

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
  $project = $db->getProject($_GET['id']);
  $title = "Thophile's Website | {$project['title']}";
  include_once 'views/project.php';
});

//Go to admin section
  $router->get("/admin", function($request){
  $title = "Thophile's Website | Admin";
  include_once 'views/admin_landing.php';
});


$router->post('/admin', function($request, $db) {
  $title = "Thophile's Website | Admin";
  //insert password check here
  if($request->getBody()["password"] == "salut"){
    
    include_once 'views/admin.php';

  }else{

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

