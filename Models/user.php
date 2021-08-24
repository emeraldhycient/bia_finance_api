<?php

require "../Helpers/Helpers.php";

class User extends Connection
{

    public static function Transactions($userid)
    {
        $userid = Helpers::filter($userid);
        $data = [];
        $sql = "SELECT * FROM transactions WHERE userid = ? ORDER BY id ASC";
        $query = self::$connect->prepare($sql);
        $query->bind_param("s", $userid);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[$row->id] = $row;
            }
            return Helpers::Response(200, "success", " transactions found", $data);
        } else {
            return Helpers::Response(404, "failed", "no transactions found", "");
        }
    }

    public static function transfer($userid, $accountnumber, $routing, $accountname, $amount, $pin, $otp, $email)
    {
        if (Helpers::verifyPin($userid, $pin)) {
            if (Helpers::verifyOtp($userid, $otp)) {
                if (self::debit($userid, $amount)) {
                    $tx_ref = "bia-" . uniqid();
                    $purpose = "debit";
                    $sql = "INSERT INTO transactions (userid,tx_ref,purpose,amount,accountnumber,routing,accountname) VALUES (?,?,?,?,?,?,?)";
                    $query = self::$connect->prepare($sql);
                    $query->bind_param("sssiiis", $userid, $tx_ref, $purpose, $amount, $accountnumber, $routing, $accountname);
                    $query->execute();

                    if ($query->affected_rows > 0) {

                        $sql = "DELETE FROM otp WHERE userid = ?";
                        $query = self::$connect->prepare($sql);
                        $query->bind_param("s", $userid);
                        $query->execute();
                        $body = "
                          <center>
                                <h6> transfer successful, $amount has been debited from your account</h6>
                          </center>
                          ";
                        Helpers::sendmail($email, "debit", "debit of $amount", $body);
                        return Helpers::Response(200, "success", "transfer successful", '');
                    } else {
                        return Helpers::Response(500, "failed", "unable to write receipt", '');
                    }
                } else {
                    return Helpers::Response(403, "failed", "balance low or server error", '');
                }
            } else {
                return Helpers::Response(403, "failed", "incorrect otp", '');
            }
        } else {
            return Helpers::Response(403, "failed", "incorrect pin", '');
        }
    }

    public static function cashMailing($userid, $address, $zipcode, $amount, $pin, $otp, $email)
    {
        $tracking = "bia-" . uniqid();

        if (Helpers::verifyPin($userid, $pin)) {
            if (Helpers::verifyOtp($userid, $otp)) {
                if (self::debit($userid, $amount)) {
                    $tx_ref = "bia-" . uniqid();
                    $purpose = "cashmailing";
                    $sql = "INSERT INTO transactions (userid,tx_ref,purpose,amount) VALUES (?,?,?,?)";
                    $query = self::$connect->prepare($sql);
                    $query->bind_param("sssi", $userid, $tx_ref, $purpose, $amount);
                    $query->execute();

                    if ($query->affected_rows > 0) {

                        $sql = "INSERT INTO cashmailing (userid,addresses,zipcode,amount,tracking) VALUES (?,?,?,?,?)";
                        $query = self::$connect->prepare($sql);
                        $query->bind_param("ssiis", $userid, $address, $zipcode, $amount, $tracking);
                        $query->execute();
                        if ($query->affected_rows > 0) {
                            $sql = "DELETE FROM otp WHERE userid = ?";
                            $query = self::$connect->prepare($sql);
                            $query->bind_param("s", $userid);
                            $query->execute();
                            $body = "
                              <center>
                                    <h6> cash delivery scheduled, tracking :$tracking </h6>
                              </center>
                              ";
                            Helpers::sendmail($email, "debit", "debit of $amount", $body);
                            return Helpers::Response(200, "success", "cash delivery scheduled, tracking :$tracking ", '');
                        } else {
                            return Helpers::Response(500, "failed", "unable to schedule cash delivery", '');
                        }
                    } else {
                        return  Helpers::Response(500, "failed", "unable to write receipt", '');
                    }
                } else {
                    return Helpers::Response(403, "failed", "balance low or server error", '');
                }
            } else {
                return Helpers::Response(403, "failed", "incorrect otp", '');
            }
        } else {
            return  Helpers::Response(403, "failed", "incorrect pin", '');
        }
    }

    public static function assignedCards($userid)
    {
    }

    public static function debit($userid, $amount)
    {
        $userid = Helpers::filter($userid);
        $sql = "SELECT accountbalance FROM users WHERE userid = ?";
        $query = self::$connect->prepare($sql);
        $query->bind_param("s", $userid);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_object();
            $balance = $row->accountbalance;
            if ($balance > $amount) {
                $debit = $balance - $amount;

                $sql = "UPDATE users SET accountbalance = ?  WHERE userid =?";
                $query = self::$connect->prepare($sql);
                $query->bind_param("is", $debit, $userid);
                $query->execute();

                if ($query->affected_rows > 0) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function cashMail($tracking)
    {
        $tracking = Helpers::filter($tracking);
        $sql = "SELECT * FROM cashmailing WHERE tracking =?";
        $query = self::$connect->prepare($sql);
        $query->bind_param("s", $tracking);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_object();
            return Helpers::Response(200, "success", " transactions found", $data);
        } else {
            return Helpers::Response(404, "failed", "no transactions found", "");
        }
    }

    public static function userdetails($userid)
    {
        $userid = Helpers::filter($userid);

        $sql = "SELECT * FROM users WHERE userid = ?";

        $query = self::$connect->prepare($sql);
        $query->bind_param("s", $userid);
        $query->execute();

        $result = $query->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data = [
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

                return  Helpers::Response(200, "success", "welcome $row->fullname", $data);
            }
        } else {
            return Helpers::Response(404, "failed", "no user found with the provided id", '');
        }
    }

    public static function totalexpenses($userid)
    {
        $sql = "SELECT SUM(amount) as amount FROM  transactions WHERE userid = ? ";
        $query = self::$connect->prepare($sql);
        $query->bind_param("s", $userid);
        $query->execute();
        $result = $query->get_result();
        $data = $result->fetch_array();
        if ($data) {
            return  Helpers::Response(200, "success", "expenses found", $data);
        } else {
            return Helpers::Response(404, "failed", "no expenses found", '');
        }
    }
}
