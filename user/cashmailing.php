<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');

require "../Models/user.php";

$user = new User();

if (
    !empty($_POST["userid"]) && !empty($_POST["address"]) && !empty($_POST["zipcode"]) &&
   !empty($_POST["amount"])  && !empty($_POST["pin"])
) {
    echo $user::cashMailing($_POST["userid"], $_POST["address"], $_POST["zipcode"], $_POST["amount"],$_POST["pin"],$_POST["otp"],$_POST["email"],);
}

//echo User::cashMailing('unixtojd',"6 somerandom address in full",12236,5000,1078);