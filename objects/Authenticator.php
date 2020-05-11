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
class Authenticator{

    /**
     * Validate the password against the app password
     * 
     * @param string $password the password to be validated
     * @return bool 
     */
    public function validatePassword($password){
        return password_verify($password,env('APP_PASSWORD'));
    }

    /**
     * Generate a JWT-like token to keep the user authenticated
     * 
     * @return string The generated token
     */
    public function generateToken(){
        
        //set expiration time at t + 2hour and encode it to b64
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        $b64header = base64_encode($header);
        $exp = json_encode(['expire' => (time() + 7200)]);
        $b64exp = base64_encode($exp);

        //generate signature and encode it to b64
        $signature = hash_hmac('sha256', $b64header . '.' . $b64exp, env('APP_KEY'), true);
        $b64sign = base64_encode($signature);

        return $token = $b64header . "." . $b64exp . "." . $b64sign;
    }

    /**
     * Validate token authenticity and check for it's timeout
     * 
     * @param string $token the token to validate
     * @return bool
     */
    public function validateToken($token){

        //cut the token
        $data = explode('.', $token);

        //if the token has 3 parts
        if(sizeof($data) === 3 ){

            //decode data
            $header = base64_decode($data[0]);
            $exp = base64_decode($data[1]);
            $sign = base64_decode($data[2]);

            //if the token has not expired
            if(json_decode($exp)->expire > time()){

                //create hash from user stored data
                $hash = hash_hmac('sha256', $data[0] . '.' . $data[1], env('APP_KEY'), true);
    
                //using time attack safe comparison to check if token is valid
                return hash_equals($hash, $sign);
            }
        }
        return false;

       
    }
}