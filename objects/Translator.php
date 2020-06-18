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
    public static $dictionary = [];

    function __construct(){

        //get default locale
        //if set on cookie take from cookie else :
        if(isset($_COOKIE["locale"])){
            $locale = $_COOKIE["locale"];
        }else{
            $locale = env("DEFAULT_LOCALE");
        }

        //get dictionary data
        if(file_exists("./translations/".$locale.".json")){
            self::$dictionary = json_decode(file_get_contents("./translations/".$locale.".json"), true);
        }else{
            //No file error
            http_response_code(500);
            include($_SERVER['DOCUMENT_ROOT'].'/errors/500.html'); 
            die();
        }


        /**
         * @param String $textCode the text code that point on the text we need
         */
        function translate(String $textCode){

            //recursively search text in nested array corresponding to textcode tree
            $tree = explode(".", $textCode);
            $text = Translator::$dictionary;
            foreach ($tree as $branche) {
                $text = $text[$branche];
            }
            return $text;
        }
    }

    function changeLocale(String $locale){
        
        if(file_exists("./translations/".$locale.".json")){
            setcookie("locale", $locale);

            $this->dictionary = json_decode(file_get_contents("translations/".$locale.".json"), true);
        }else{
            //No file error
            http_response_code(500);
            include($_SERVER['DOCUMENT_ROOT'].'/errors/500.html'); 
            die();
        }
    }

    

}