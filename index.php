<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Request.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/objects/Router.php';
$router = new Router(new Request);

$router->get('/', function() {
    $title = 'Thophile\'s Website';
    $header = file_get_contents('views/navbar.html');
    $main =<<<HTML
    <h1>Home</h1>
  HTML;
    $footer = '';
    include_once 'views/base.php';
});


$router->get('/blog', function($request) {
  return <<<HTML
  <h1>Blog</h1>
HTML;
});

$router->get('/render', function($request) {
    $title = 'Thophile\'s Website';
    $header = file_get_contents('views/navbar.html');
    $main ='';
    $footer = '';
    include_once 'views/base.php';
  });

$router->post('/data', function($request) {

  return json_encode($request->getBody());
});

