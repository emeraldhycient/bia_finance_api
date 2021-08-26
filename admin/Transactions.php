<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/admin.php";

$admin = new Admin();

if($_POST["transactions"]){

    echo $admin::Transactions();
}
