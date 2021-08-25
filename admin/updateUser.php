<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
require "../Models/admin.php";

$admin = new Admin();

if (!empty($_POST["userid"]) && !empty($_POST["fullname"])) {
    echo $admin::updateDetails(
        $_POST["userid"],
        $_POST["fullname"],
        $_POST["email"],
        $_POST["address"],
        $_POST["state"],
        $_POST["country"],
        $_POST["dob"],
        $_POST["accountbalance"],
        $_POST["password"],
        $_POST["isadmin"],
        $_POST["pin"],
    );
}
