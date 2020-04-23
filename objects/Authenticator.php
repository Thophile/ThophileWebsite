<?php
class Authenticator{

    //validate the password with the env app_password
    public function validatePassword($password){
        return password_verify($password,env('APP_PASSWORD'));
    }

    //generate a token
    public function generateToken(){

    }

    //validate a token
    public function validateToken($token){

    }
}