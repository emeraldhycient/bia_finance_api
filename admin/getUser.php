<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/admin.php";

$admin = new Admin();

if (isset($_POST["userid"])) {
    echo $admin::getUser($_POST["userid"]);
}