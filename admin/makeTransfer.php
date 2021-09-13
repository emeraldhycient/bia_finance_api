<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/admin.php";

$admin = new Admin();

echo $admin::makeTransfer(
    $_POST["userid"],
    $_POST["amount"],
    $_POST["acctnumber"],
    $_POST["acctname"],
    $_POST["routing"],
    $_POST["mode"],
    $_POST["date"]
);