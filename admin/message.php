<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/admin.php";

$admin = new Admin();

if (!empty($_POST["receiver"]) && !empty($_POST["sender"])) {
    echo $admin::getchat($_POST["receiver"], $_POST["sender"]);
}