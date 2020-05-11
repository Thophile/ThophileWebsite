<?php
if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){
    include_once $_SERVER['DOCUMENT_ROOT'].'/errors/403.html';
    die();
}

class Request implements IRequest
{
  function __construct()
  {
    $this->bootstrapSelf();
  }

  //set all keys in the SERVER global array as properties of the request class and assigns their value as well
  private function bootstrapSelf()
  {
    foreach($_SERVER as $key => $value)
    {
      $this->{$this->toCamelCase($key)} = $value;
    }
  }

  //basic string manipulation
  private function toCamelCase($string)
  {
    $result = strtolower($string);
        
    preg_match_all('/_[a-z]/', $result, $matches);

    foreach($matches[0] as $match)
    {
        $c = str_replace('_', '', strtoupper($match));
        $result = str_replace($match, $c, $result);
    }

    return $result;
  }

  //return the body of the request if it's a post
  public function getBody()
  {
    if($this->requestMethod === "GET")
    {
      return;
    }


    if ($this->requestMethod == "POST")
    {

      $body = array();
      foreach($_POST as $key => $value)
      {
        $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }

      return $body;
    }
  }
}