<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/admin.php";

$admin = new Admin();

if (!empty($_POST["sender"]) && !empty($_POST["receiver"]) && !empty($_POST["message"])) {
    echo $admin::sendMessage($_POST["sender"], $_POST["receiver"], $_POST["message"]);
}