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
class JsonDatabase{
    private $data = [];
    private $file;

    function __construct(){
        $this->file = env("DATABASE");

        if(!file_exists($this->file)){
            $this->data = json_decode(file_get_contents($this->file), true);
        }else{
            //No file error
            http_response_code(500);
            include($_SERVER['DOCUMENT_ROOT'].'/errors/500.html'); 
            die();
        }
    }

    function getAll(String $table){
        return $data[$table];
    }
    
    function get(String $table, String $id){
        return array_search($id, $data[$table]);
    }

    function set(String $table, array $row ){

        if(!isset($data[$table])) createTable($table);

        if(isset($row["id"]) && get($table, $row["id"])){
            $this->update($table, $row);
        }else{
            $this->create($table, $row);
        }
       
        
    }

    function update(String $table, array $row){

        $id = array_column($data[$table], 'id');
        $rowKey = array_search($row["id"], $id);
        $data[$table][$rowKey] = $row;
    }

    function create(String $table, array $row){
        
        $id = array_column($data[$table], 'id');
        $row["id"] = ($id == []) ? 0 : sizeof($id);
        $data[$table][] = $row;
    }

    function createTable(String $table){
        $data[$table] = [];
    }

    function __destruct(){
        $f = fopen($this->file, 'w');
        fwrite($f, json_encode($data));
        fclose($f);
    }
}