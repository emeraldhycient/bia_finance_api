<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/admin.php";

$admin = new Admin();

if(!empty($_POST["tracking"])){
    echo $admin::editCashMail($_POST["tracking"],$_POST["address"],$_POST["zipcode"],$_POST["amount"],$_POST["location"],$_POST["status"]);
}
