<?php
//This file recieve request and sned back the good page
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Request.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Router.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Database.php';

$db = new Database();
$router = new Router(new Request, $db);

$router->get('/', function() {
    $title = 'Thophile\'s Website';
    include_once 'views/home.php';
});


$router->get('/projects', function($request, $db) {
  $title = 'Thophile\'s Website | Projects';
  $projects = $db->getProjects();
  include_once 'views/projects.php';
});
$router->get("/project", function($request, $db){
  $project = $db->getProject($_GET['id']);
  $title = "Thophile\'s Website | {$project['h1']}";
  include_once 'views/project.php';
});


$router->post('/data', function($request) {

  return json_encode($request->getBody());
});

