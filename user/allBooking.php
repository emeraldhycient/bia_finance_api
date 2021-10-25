<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/user.php";

if (!empty($_GET["userid"])) {
    echo User::allBooking($_GET["userid"]);
}