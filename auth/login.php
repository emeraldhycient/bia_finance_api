<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/auth.php";

$auth = new Auth;

if(!empty($_POST["email"]) && !empty($_POST["password"]) ){
    echo $auth::login($_POST["email"],$_POST["password"]);
}

//echo Auth::login("emekaemmanuel@gmail.com","12345678");