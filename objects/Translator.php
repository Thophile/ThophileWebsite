<?php
//Block access from file
if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){
    include_once $_SERVER['DOCUMENT_ROOT'].'/errors/403.html';
    die();
}

/**
 * The class that is responsible for authentication
 * 
 * @author Thophile
 * @license MIT
 */
class Translator
{
    private $dictionary = [];

    function __construct($locale){
        if(!file_exists($locale.".json")){
            $this->dictionary = json_decode(file_get_contents($locale.".json"), true);
        }
    }

    function translate(String $textCode){
        return $dictionary[$textCode];
    }

}