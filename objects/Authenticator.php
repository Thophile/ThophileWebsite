<?php
class Authenticator{

    //validate the password with the env app_password
    public function validatePassword($password){
        return password_verify($password,env('APP_PASSWORD'));
    }

    //generate a token
    public function generateToken(){
        
        //set expiration time at t + 2hour and encode it to b64
        $exp = json_encode(['expire' => (time() + 7200)]);
        $b64exp = base64_encode($exp);

        //generate signature and encode it to b64
        $signature = hash_hmac('sha256', $b64exp, env('APP_KEY'), true);
        $b64sign = base64_encode($signature);

        return $token = $b64exp .".". $b64sign;
    }

    //validate a token
    public function validateToken($token){

    }
}