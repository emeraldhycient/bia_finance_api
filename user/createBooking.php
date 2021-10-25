<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/user.php";

if (
    !empty($_POST["receivername"]) && !empty($_POST["receiveremail"]) && !empty($_POST["receiveraddress"]) &&
    !empty($_POST["postalcode"]) && !empty($_POST["quantity"]) &&
    !empty($_POST["weight"]) && !empty($_POST["bookingdate"]) && !empty($_POST["expected"])
    && !empty($_POST["instruction"])
    && !empty($_POST["senderid"])
) {

    echo User::createBooking(
        $_POST["senderid"],
        $_POST["receivername"],
        $_POST["receiveremail"],
        $_POST["receiveraddress"],
        $_POST["postalcode"],
        $_POST["quantity"],
        $_POST["weight"],
        $_POST["bookingdate"],
        $_POST["expected"],
        $_POST["instruction"]
    );
}