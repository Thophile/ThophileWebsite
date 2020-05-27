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

        /* Check for Brute force */
        $isBanned = false;
        $ip = $_SERVER["REMOTE_ADDR"];
        $data = [];
        $ipGuard = $_SERVER['DOCUMENT_ROOT']."/ipGuard.json";

        // Create the file if it does not exist or get the data
        if(!file_exists($ipGuard)){
            $f = fopen($ipGuard, 'w');
            fwrite($f, json_encode($data));
            fclose($f);            
        }else $data = json_decode(file_get_contents($ipGuard), true);

        if(!empty($data)){

            // Check rows
            foreach ($data as $key => $row) {

                //Remove unlocked entries
                if( time() > ($row["timestamp"] + (5 ** $row["level"])) ){// if unlocking time is passed
                    unset($data[$key]);
                }elseif($this->ipSubnetCheck($ip, $row["ip"])){ // if ip is locked and match the remote host
                    //ban longer existing ip
                    $data[$key]["timestamp"] = time();
                    $data[$key]["level"]++;

                    $isBanned = true;
                }   
            }
        }else{
                //Create an entry for the next time
                $row["ip"] = $ip;
                $row["timestamp"] = time();
                $row["level"] = 0;
                array_push($data, $row);

        }
        
        //Write the file with updated data
        $f = fopen($ipGuard, 'w');
        fwrite($f, json_encode($data));
        fclose($f);
        
        return password_verify($password,env('APP_PASSWORD')) && !$isBanned;
    }

    /**
     * Check if an ip is in the same subnet as another
     * 
     * @param string $ip the ip to be checked
     * @param string $host the ip to check against
     * 
     * @return bool
     */
    public function ipSubnetCheck($ip, $host){
        
        if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) & filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            
            //Valid IPv6
            $ipBin = inet_pton($ip);
            if($ipBin === false){
                return false;
            }else{
                $ipSubnet = substr_replace($ipBin, str_repeat("\000", 8), -8);;
            }
            $hostBin = inet_pton($host);
            if($hostBin === false){
                return false;
            }else{
                $hostSubnet = substr_replace($hostBin, str_repeat("\000", 8), -8);;
            }
            
            return $ipSubnet == $hostSubnet;

            
              
            return true;
        }elseif(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) & filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {   

            //Valid IPv4
            $ipSubnet = explode(".", $ip)[0].explode(".", $ip)[1].explode(".", $ip)[2];
            $hostSubnet = explode(".", $host)[0].explode(".", $host)[1].explode(".", $host)[2];

            return $ipSubnet == $hostSubnet;

        }else {
            return false;
        }
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