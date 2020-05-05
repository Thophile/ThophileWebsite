<?php
if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){
    include_once $_SERVER['DOCUMENT_ROOT'].'/errors/403.html';
    die();
}
class Router
{
  private $auth;
  private $db;
  private $request;
  private $supportedHttpMethods = array(
    "GET",
    "POST"
  );

  function __construct(IRequest $request, Database $db, Authenticator $auth)
  {
   $this->request = $request;
   $this->db = $db;
   $this->auth = $auth;
  }

  function __call($name, $args)
  {
    list($route, $method) = $args;

    if(!in_array(strtoupper($name), $this->supportedHttpMethods))
    {
      $this->invalidMethodHandler();
    }

    $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
  }

  /**
   * Removes trailing forward slashes from the right of the route.
   */
  private function formatRoute($route)
  {
    //trim first "/" and keep only uri before the get parameter
    $result = explode("?",rtrim($route, '/'), 2)[0];
    return $result === '' ? '/' : $result;
  }

  private function invalidMethodHandler()
  {
    header("{$this->request->serverProtocol} 405 Method Not Allowed");
  }

  private function defaultRequestHandler()
  {
    header("{$this->request->serverProtocol} 404 Not Found");
  }

  /**
   * Resolves a route
   */
  function resolve()
  {
    $methodDictionary = $this->{strtolower($this->request->requestMethod)};
    $formatedRoute = $this->formatRoute($this->request->requestUri);
    $method = $methodDictionary[$formatedRoute];
    
    

    if(is_null($method))
    {
      $this->defaultRequestHandler();
      return;
    }
    
    //Hit the db with a route entry
    $this->db->hit($formatedRoute);
    echo call_user_func_array($method, array($this->request, $this->db, $this->auth));
  }

  function __destruct()
  {
    $this->resolve();
  }
}