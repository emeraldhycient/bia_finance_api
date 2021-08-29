<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../config/connection.php";

include 'PHPMailer/src/Exception.php';
include 'PHPMailer/src/PHPMailer.php';
include 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Helpers extends Connection
{

    public static function filter($data)
    {
        $data = trim($data);
        $data = htmlentities($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = self::$connect->real_escape_string($data);
        return $data;
    }

    public static  function Response($statuscode, $status, $message, $data)
    {
        http_response_code($statuscode);
        $res = [
            "status" => $status,
            'message' => $message,
            'data' => $data
        ];

        return json_encode($res);
    }

    public static function generateNumber($length)
    {
        $number = substr(str_shuffle('01234567890123456789012345678909876543212345678909876543211234321235678899008764332221230384756563541325374'),0,$length);
        return (int)$number;
    }

    
public static  function verifyOtp($userid,$otp)
{
    $sql = "SELECT *  FROM otp WHERE userid = ?";
    $query=self::$connect->prepare($sql);
    $query->bind_param("s",$userid);
    $query->execute();
    $result = $query->get_result();
    if($result->num_rows > 0){
        while ($row = $result->fetch_object()) {
            if((int)$otp === (int)$row->otp){
                return true;
            }else{
                return false;
            }
        }
    }else{
        return false;
    }
}


    public static function verifyPin($userid,$pin)
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

                   
                    $emailbody = "
                    <h1> hello $row->fullname , your bia finance bank account was accessed on ". date("y-m-d h:i:s")."</p>
                    <h4>a transaction was just initiated </h6>
                    <h2> if you dont recognise this action please login to your account and change your password </p>
                    ";
                    Helpers::sendmail($row->email,$row->fullname,"transaction initiated",$emailbody);

                    return true;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public static function createCards($userid, $fullname)
    {
        $init = [5110, 4110, 6510, 3710];

        foreach ($init as $card) {
            $cardnumber = $card . Helpers::generateNumber(12);
            $cvv = Helpers::generateNumber(3);
            $exp = Helpers::generateExpdat();
            $sql = "INSERT INTO cards (userid,fullname,cardnumber,cvv,expirationdate) VALUES (?,?,?,?,?)";
            $query = self::$connect->prepare($sql);
            $query->bind_param("ssiis", $userid, $fullname, $cardnumber, $cvv, $exp);
            $query->execute();
        }
        return true;
    }

    public static function generateExpdat()
    {
        $end = date('Y-m-d', strtotime('+4 years'));
        $time = strtotime($end);
        $month = date("m", $time);
        $year = date("Y", $time);
        $exp = $month . "/" . $year;
        return $exp;
    }

    public static function sendmail($receiveremail, $receivername, $subject, $body)
    {

        $mail = new PHPMailer(true);

        $data = [];

        try {
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'biafinance.org';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'contact@biafinance.org';                     // SMTP username
            $mail->Password   = 'ny$ICnb7FNo1';                               // SMTP password
            $mail->SMTPSecure = "ssl";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom("contact@biafinance.org", "bia finance");
            $mail->addAddress($receiveremail, $receivername);     // Add a recipient

            // Attachments

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->send();

            $data = array(
                'status' => "success",
                'message' => "mail sent"
            );
        } catch (Exception $e) {
            $data = array(
                'status' => "failed",
                'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"
            );
        }

        return json_encode($data);
    }
}
