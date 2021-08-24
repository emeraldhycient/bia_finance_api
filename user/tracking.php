<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/user.php";

$user = new User();

if(!empty($_POST["tracking"])){
    echo $user::cashMail($_POST["tracking"]);
}

