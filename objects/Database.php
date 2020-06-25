<?php
//Block access from file
if(__FILE__ == $_SERVER['SCRIPT_FILENAME']){
    include_once $_SERVER['DOCUMENT_ROOT'].'/errors/403.html';
    die();
}

/**
 * The class that is responsible for database connection and that stores and handle allowed queries
 * 
 * @author Thophile
 * @license MIT
 */
class Database{
    private $data = [];
    private $file;

    function __construct(){
        $this->file = env('DATABASE');
        if(file_exists($this->file)){
            $this->data = json_decode(file_get_contents($this->file), true);
        }else{
            //No file error
            http_response_code(500);
            include($_SERVER['DOCUMENT_ROOT'].'/errors/500.html'); 
            die();

        }
    }

    function getAll(String $table){
        return isset($this->data[$table]) ? $this->data[$table] : [] ;
    }
    
    function get(String $table, String $id){

        if(isset($this->data[$table][$id])){
            return $this->data[$table][$id];
        }else return false;
    }

    function set(String $table, array $row ){
        if(!isset($this->data[$table])) $this->createTable($table);

        //if translator module existe parse data to send for translation generation
        if(class_exists("Translator")){
            sendToTranslation($row);
        }

        if(isset($row['id']) && $this->get($table, $row['id'])){
            $this->update($table, $row);
        }else{
            $this->create($table, $row);
        }
        
    }

    function update(String $table, array $row){

        $id = array_column($this->data[$table], 'id');
        $rowKey = array_search($row['id'], $id);
        $this->data[$table][$rowKey] = $row;
        $this->writeData();
    }

    function create(String $table, array $row){
        
        if(empty($this->data[$table])){
            $row['id'] = 0;
        } else{
            $row['id'] = array_key_last($this->data[$table]) + 1;
        }
        $this->data[$table][] = $row;

        
        $this->writeData();
        return $row['id'];
    }

    function delete(String $table, $id){

        unset($this->data[$table][$id]);

        $this->writeData();
    }

    function createTable(String $table){
        $this->data[$table] = [];
        $this->writeData();
    }

    function writeData(){
        $f = fopen($this->file, 'w');
        fwrite($f, json_encode($this->data, JSON_FORCE_OBJECT));
        fclose($f);
    }

    function sendToTranslation($row){
        //create array to associate textcode with value
        $translationList = [];

        //declare recursion and then call it
        function findTranslation(array $haystack, array $path = []) {
            foreach ($haystack as $key => $value) {
                $currentPath = array_merge($path, [$key]);
                if (is_array($value)) {
                    findTranslation($value, $currentPath);
                } else {
                    //capitals separated by dots
                    $textCode = strtoupper(implode(".",$currentPath));
                    $translationList[$textCode] = $value;
                }
            }
        }
        findTranslation($row);


        var_dump($translationList);
        foreach ($translationList as $textCode => $value) {
            Translator::setTranslation($textCode,$value);
        } 
    }
}