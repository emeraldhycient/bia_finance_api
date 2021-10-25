<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/admin.php";

$admin = new Admin();

if (!empty($_POST["tracking"])) {
    echo $admin::updatelocation($_POST["tracking"], $_POST["lat"], $_POST["lng"], $_POST["currentlocation"], $_POST["detail1"], $_POST["detail2"], $_POST["detail3"], $_POST["detail4"], $_POST["detail5"], $_POST["detail6"],);
}