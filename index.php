<?php
//This file recieve request and sned back the good page
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Request.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Router.php';
$router = new Router(new Request);

$router->get('/', function() {
    $title = 'Thophile\'s Website';
    include_once 'views/home.php';
});


$router->get('/projects', function($request) {
  $title = 'Thophile\'s Website | Projects';
  //pdo -> get all projects
  include_once 'views/projects.php';
});


$router->post('/data', function($request) {

  return json_encode($request->getBody());
});

