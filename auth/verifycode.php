<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/auth.php";

$auth = new Auth;

if(!empty($_POST["userid"]) && !empty($_POST["pin"]) ){
    echo $auth::verifycode($_POST["userid"],$_POST["pin"]);
}

//echo Auth::login("emekaemmanuel@gmail.com","12345678");