<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/admin.php";

$admin = new Admin();

echo $admin::allbookings();