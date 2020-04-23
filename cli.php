<?php
function generatePassword($password){
    echo password_hash($password, PASSWORD_DEFAULT);
}
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