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

        if(isset($this->data[$table][$id - 1])){
            return $this->data[$table][$id - 1];
        }else return false;
    }

    function set(String $table, array $row ){
        if(!isset($this->data[$table])) $this->createTable($table);

        if($row['id'] !== 0 && $this->get($table, $row['id'])){
            $this->update($table, $row);
        }else{
            $this->create($table, $row);
        }
        $this->writeData();
        
    }

    function update(String $table, array $row){

        $id = array_column($this->data[$table], 'id');
        $rowKey = array_search($row['id'], $id);
        $this->data[$table][$rowKey] = $row;
        $this->writeData();
    }

    function create(String $table, array $row){
        
        $id = array_column($this->data[$table], 'id');
        $row['id'] = ($id == []) ? 1 : sizeof($id)+1;
        $this->data[$table][] = $row;

        return $row['id'];
        $this->writeData();
    }

    function delete(String $table, $id){
        unset($this->data[$table][$id - 1]);
        //reindex array
        foreach (array_column($this->data[$table], 'id') as $key => $value) {
            $value = $key - 1;
        }
        $this->writeData();
    }

    function createTable(String $table){
        $this->data[$table] = [];
        $this->writeData();
    }

    function writeData(){
        $f = fopen($this->file, 'w');
        fwrite($f, json_encode($this->data));
        fclose($f);
    }
}