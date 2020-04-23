<?php
function encrypt($password){
    echo password_hash($password, PASSWORD_DEFAULT);
}
?>