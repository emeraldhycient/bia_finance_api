<?php

require "../Helpers/Helpers.php";

class Auth extends Connection
{

    public static  function login($email, $password)
    {
        $email = Helpers::filter($email);
        $password = Helpers::filter($password);

        $sql = "SELECT * FROM users WHERE email = ?";

        $query = self::$connect->prepare($sql);
        $query->bind_param("s", $email);
        $query->execute();

        $result = $query->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                //if(password_verify($password,$row->pass))
                if ($password === $row->pass) {
                    $_SESSION["userid"] = $row->userid;
                    $data = [
                        "userid" => $row->userid,
                        "fullname" => $row->fullname,
                        "email" => $row->email,
                        "isadmin" => (bool)$row->isadmin,
                    ];
                    if ((bool)$row->isadmin) {
                        $hash = "biafinance-" . uniqid();
                        $_SESSION["hash"] = $hash;
                        $data["hash"] = $hash;
                    }
                    return  Helpers::Response(200, "success", "login successful, you will be redirected now", $data);
                } else {
                    return  Helpers::Response(403, "failed", "check the eamil and password", '');
                }
            }
        } else {
            return Helpers::Response(404, "failed", "no user with email found", '');
        }
    }



    public static function createAccount($fullname, $email, $phone, $address, $password, $isadmin)
    {
        $userid = uniqid("bia-", true);
        $fullname = Helpers::filter($fullname);
        $email = Helpers::filter($email);
        $address = Helpers::filter($address);
        $phone = Helpers::filter($phone);
        $password = Helpers::filter($password);
        // $passwordhash = password_hash($password,PASSWORD_BCRYPT);
        $isadmin = Helpers::filter($isadmin);

        $sql = "INSERT INTO users (userid,fullname,email,pass,isadmin,addresses,phone) 
        VALUES (?,?,?,?,?,?,?)";
        $query = self::$connect->prepare($sql);
        $query->bind_param("ssssiss", $userid, $fullname, $email, $password, $isadmin,  $address, $phone);
        $query->execute();
        if ($query->affected_rows > 0) {
            $emailbody = "
                <h1> hello $fullname , your bia courier  account has been created  on " . date("y-m-d h:i:s") . "</h1>
                <h1> if you dont recognise this action please contact the support team  </h1>
                ";
            Helpers::sendmail($email, $fullname, "successful account creation", $emailbody);

            return Helpers::Response(200, "success", "account creation successfully now proceed to login ", "");
        } else {
            return Helpers::Response(500, "failed", "unable to createaccount due to :" . $query->error, "");
        }
    }
    public static function updateDetails($userid, $fullname, $email, $address, $state, $country, $dob)
    {
        $sql = "UPDATE users SET fullname =? , email = ? , addresses = ? , residentialstate =?,country =?,dob=? WHERE userid =?";
        $query = self::$connect->prepare($sql);
        $query->bind_param("sssssss", $fullname, $email, $address, $state, $country, $dob, $userid);
        $query->execute();

        if ($query->affected_rows > 0) {
            return Helpers::Response(200, "success", "update successful", "");
        } else {
            return Helpers::Response(500, "failed", "unable to update details due to :" . $query->error, "");
        }
    }

    public static function changePassword($userid, $oldpassword, $newpassword)
    {
    }
    public static function changePin($userid, $oldpin, $newpin)
    {
    }
}