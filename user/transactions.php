<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');


require "../Models/user.php";

$user = new User();

if(!empty($_POST["userid"])){
    echo $user::Transactions($_POST["userid"]);
}

//echo $user::Transactions("unixtojd");
