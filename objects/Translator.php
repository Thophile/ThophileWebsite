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
    private $locale;

    function __construct(){

        //get default locale
        //if set on cookie take from cookie else :
        $this->locale = env("DEFAULT_LOCALE");

        //get dictionary data
        if(!file_exists($this->locale.".json")){
            $this->dictionary = json_decode(file_get_contents($this->locale.".json"), true);
        }


        /**
         * @param String $textCode the text code that point on the text we need
         */
        function translate(String $textCode){
            //recursively search text in nested array corresponding to textcode tree
            $branches = explode(".", $textCode);
            $text = $this->dictionary;
            foreach ($branches as $branche) {
                $text = $text[$branch];
            }
            echo $text;
            return;
        }
    }

    function changeLocale(String $newLocale){
        
        if(!file_exists($newLocale.".json")){
            $this->locale = $newLocale;
            //set on cookie for next time
            $this->dictionary = json_decode(file_get_contents($this->locale.".json"), true);
        }else{
            http_response_code(500);
            include($_SERVER['DOCUMENT_ROOT'].'/errors/500.html'); 
            die();
        }
    }

    

}