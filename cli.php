<?php
//Ensure that the script is called is console line
if(php_sapi_name() !== 'cli') { 
    include_once $_SERVER['DOCUMENT_ROOT'].'/errors/403.html';
    die();
}

/**
 * Hash a password 
 * @param  string $password The password to be hashed
 */
function generatePassword($password){
    echo password_hash($password, PASSWORD_DEFAULT);
}

/**
 * Generate a secret key
 * @param int $size The size of the key to be generated
 */
function generateSecret($size){
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $secret = '';
    for($i = 0; $i < $size; $i++) {
        $random_character = $permitted_chars[mt_rand(0, strlen($permitted_chars) - 1)];
        $secret .= $random_character;
    }
 
    echo $secret;
}
?>