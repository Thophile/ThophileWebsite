<?php
//Block access from file
if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){
    include_once $_SERVER['DOCUMENT_ROOT'].'/errors/403.html';
    die();
}
/**
 * The class that is responsible for route interpretation
 * 
 * @author Thophile
 * @license MIT
 */
class Router
{
  /**
   * Reference to the server's authenticator
   * @var Authenticator
   */
  private $auth;

  /**
   * Reference to the server's database abstraction layer
   * @var Database
   */
  private $db;

  /**
   * Reference to the current request
   * @var Request
   */
  private $request;

  /**
   * Array of supported http methods
   * @var array
   */
  private $supportedHttpMethods = array(
    "GET",
    "POST"
  );

  /**
   * Router object constructor
   * 
   * @param Request $request the current request
   * @param Database $db The server's database
   * @param Authenticator $auth The server's authenticator
   */
  function __construct(Request $request, Database $db, Authenticator $auth)
  {
   $this->request = $request;
   $this->db = $db;
   $this->auth = $auth;
  }

  /**
   * Router magic methode that is called when an unknown method is called
   * it will create method linked to http methode and route
   * 
   * @param string $name the name of the method that is called
   * @param array $args the arguments the methode is called with
   */
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
   * Format the route to keep uri before the get parameters
   * 
   * @param string $route the route to be formatted
   * @return $result the formatted route
   */
  private function formatRoute($route)
  {
    //trim first "/" and keep only uri before the get parameter
    $result = explode("?",rtrim($route, '/'), 2)[0];
    return $result === '' ? '/' : $result;
  }

  /**
   * Set header for the invalid method
   */
  private function invalidMethodHandler()
  {
    header("{$this->request->serverProtocol} 405 Method Not Allowed");
  }

  /**
   * Set header for the invalid method
   */
  private function defaultRequestHandler()
  {
    header("{$this->request->serverProtocol} 404 Not Found");
  }

  /**
   * Resolves a route
   */
  function resolve()
  {
    //find the method that match the route called
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
    //call the method that match the route with arguments
    echo call_user_func_array($method, array($this->request, $this->db, $this->auth));
  }

  /**
   * Magic method called on object destruction
   */
  function __destruct()
  {
    $this->resolve();
  }
}