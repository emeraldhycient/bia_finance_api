<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/auth.php";

$auth = new Auth;

if(!empty($_POST["userid"]) && !empty($_POST["email"]) ){
    echo $auth::sendOtp($_POST["userid"],$_POST["email"]);
}

