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

    public static  function verifycode($userid, $pin)
    {
        $userid = Helpers::filter($userid);
        $pin = Helpers::filter($pin);

        $sql = "SELECT * FROM users WHERE userid = ?";

        $query = self::$connect->prepare($sql);
        $query->bind_param("s", $userid);
        $query->execute();

        $result = $query->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                //if(password_verify($password,$row->pass))
                if ($pin == $row->pin) {

                    $hash = "biafinance-" . uniqid();
                    $_SESSION["hash"] = $hash;
                    $_SESSION["pin"] = $row->pin;

                    $data["user"] = [
                        "userid" => $row->userid,
                        "fullname" => $row->fullname,
                        "email" => $row->email,
                        "accoutnumber" => $row->accountNumber,
                        "accountbalance" => $row->accountbalance,
                        "address" => $row->addresses,
                        "state" => $row->residentialstate,
                        "country" => $row->country,
                        "dob" => $row->dob,
                    ];
                    $data["hash"] = $hash;
  
                    $emailbody = "
                    <p> hello $row->fullname , your bia finance bank account was accessed on ". date("y-m-d h:i:s")."</p>
                    <p> if you dont recognise this action please login to your account and change your password </p>
                    ";
                    Helpers::sendmail($row->email,$row->fullname,"successful login",$emailbody);

                    return  Helpers::Response(200, "success", "pin verified, you will be redirected now", $data);
                } else {
                    return  Helpers::Response(403, "failed", "check the pin and try again", '');
                }
            }
        } else {
            return Helpers::Response(404, "failed", "unable to validate pin please relogin", '');
        }
    }


    public static  function sendOtp($userid,$email)
{
    $otp = Helpers::generateNumber(6);
    $sql = "INSERT INTO otp (userid,otp) VALUES (?,?)";
    $query=self::$connect->prepare($sql);
    $query->bind_param("si",$userid,$otp);
    $query->execute();

    if($query->affected_rows > 0){
        $body = "
        <center>
        <h6>your otp is : $otp</h6>
        </center>
        ";
        Helpers::sendmail($email,"biafinancebank","transaction otp",$body);
        return Helpers::Response(200,"success","otp sent pls check your email","");
    }else{
        return Helpers::Response(500,"failed","unable to send otp","");
    }

}

    public static function createAccount($fullname, $email, $address, $state, $country, $dob, $pin, $password, $accountbalance, $isadmin)
    {
        $userid = uniqid();
        $fullname = Helpers::filter($fullname);
        $email = Helpers::filter($email);
        $address = Helpers::filter($address);
        $state = Helpers::filter($state);
        $country = Helpers::filter($country);
        $dob = Helpers::filter($dob);
        $pin = Helpers::filter($pin);
        $password = Helpers::filter($password);
        // $passwordhash = password_hash($password,PASSWORD_BCRYPT);
        $accountbalance = Helpers::filter($accountbalance);
        $accountNumber = Helpers::generateNumber(11);
        $isadmin = Helpers::filter($isadmin);

        $sql = "INSERT INTO users (userid,fullname,email,pass,isadmin,accountbalance,addresses,residentialstate,country,dob,pin,accountNumber) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $query = self::$connect->prepare($sql);
        $query->bind_param("sssssissssii", $userid, $fullname, $email, $password, $isadmin, $accountbalance, $address, $state, $country, $dob, $pin, $accountNumber);
        $query->execute();
        if ($query->affected_rows > 0) {
            if (Helpers::createCards($userid, $fullname)) {
                $emailbody = "
                <p> hello $fullname , your bia finance bank account has been created  on ". date("y-m-d h:i:s")."</p>
                <p> if you dont recognise this action please contact the support team  </p>
                ";
                Helpers::sendmail($email,$fullname,"successful login",$emailbody);

                return Helpers::Response(200, "success", "account creation successfully now proceed to login ", "");
            } else {
                return Helpers::Response(500, "failed", "card creation failed", "");
            }
        } else {
            return Helpers::Response(500, "failed", "unable to createaccount due to :" . $query->error, "");
        }
    }
    public static function updateDetails($userid,$fullname, $email, $address, $state, $country, $dob)
    {
        $sql = "UPDATE users SET fullname =? , email = ? , addresses = ? , residentialstate =?,country =?,dob=? WHERE userid =?";
         $query = self::$connect->prepare($sql);
         $query->bind_param("sssssss",$fullname,$email,$address,$state,$country,$dob,$userid);
         $query->execute();

         if($query->affected_rows > 0){
            return Helpers::Response(200, "success", "update successful", "");
         }else{
            return Helpers::Response(500, "failed", "unable to update details due to :" . $query->error, "");
         }
    }

    public static function changePassword($userid,$oldpassword, $newpassword)
    {

    }
    public static function changePin($userid,$oldpin, $newpin)
    {

    }
}
