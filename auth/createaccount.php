<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/auth.php";

$auth = new Auth;
//$fullname, $email, $address,  $password, $isadmin
if (!empty($_POST["fullname"]) && !empty($_POST["email"])  && !empty($_POST["password"])) {
    echo $auth::createAccount(
        $_POST["fullname"],
        $_POST["email"],
        $_POST["address"],
        $_POST["phone"],
        $_POST["password"],
        $_POST["isadmin"]
    );
}