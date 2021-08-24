<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');


require "../Models/user.php";

$user = new User();

if (
    !empty($_POST["userid"]) && !empty($_POST["accountnumber"]) && !empty($_POST["routing"]) &&
    !empty($_POST["accountname"])  && !empty($_POST["amount"])  && !empty($_POST["pin"]) && $_POST["otp"]  && $_POST["email"]
) {
    echo $user::transfer($_POST["userid"], $_POST["accountnumber"], $_POST["routing"], $_POST["accountname"], $_POST["amount"], $_POST["pin"],$_POST["otp"],$_POST["email"]);
}

//echo User::transfer('unixtojd',1234556677,122344556,"emeka wood",3000,1178);