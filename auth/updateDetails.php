<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/auth.php";

$auth = new Auth;
if (!empty($_POST["userid"]) && !empty($_POST["fullname"])) {
    echo $auth::updateDetails(
        $_POST["userid"],
        $_POST["fullname"],
        $_POST["email"],
        $_POST["address"],
        $_POST["state"],
        $_POST["country"],
        $_POST["dob"],
    );
}
