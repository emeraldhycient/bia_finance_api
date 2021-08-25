<?php
require "../Helpers/Helpers.php";

class Admin extends Connection
{

    public static function totalUsers()
    {
        $sql = "SELECT * FROM users";
        $query = self::$connect->prepare($sql);
        $query->execute();
        $result = $query->get_result();
        $data = $result->num_rows;
        if ($result->num_rows > 0) {
            return Helpers::Response(200, "success", "", $data);
        } else {
            return Helpers::Response(404, "failed", "no userr found", "");
        }
    }

    public static function users()
    {
        $data = [];
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $query = self::$connect->prepare($sql);
        $query->execute();

        $result = $query->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data["users"][$row->id] = [
                    "userid" => $row->userid,
                    "fullname" => $row->fullname,
                    "email" => $row->email,
                    "password" => $row->pass,
                    "pin" => $row->pin,
                    "accoutnumber" => $row->accountNumber,
                    "accountbalance" => $row->accountbalance,
                    "password" => $row->pass,
                    "address" => $row->addresses,
                    "state" => $row->residentialstate,
                    "country" => $row->country,
                    "dob" => $row->dob,
                    "isadmin" => $row->isadmin,
                    "createdAt" => $row->createdAt
                ];
            }
            return Helpers::Response(200, "success", "users found", $data);
        } else {
            return Helpers::Response(404, "failed", "no user  found", '');
        }
    }

    public static function getUser($userid)
    {
        $sql = "SELECT * FROM users WHERE userid = ?";

        $query = self::$connect->prepare($sql);
        $query->bind_param("s", $userid);
        $query->execute();

        $result = $query->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data = [
                    "fullname" => $row->fullname,
                    "email" => $row->email,
                    "password" => $row->pass,
                    "pin" => $row->pin,
                    "accoutnumber" => $row->accountNumber,
                    "accountbalance" => $row->accountbalance,
                    "password" => $row->pass,
                    "address" => $row->addresses,
                    "state" => $row->residentialstate,
                    "country" => $row->country,
                    "dob" => $row->dob,
                    "isadmin" => $row->isadmin,
                ];
                return  Helpers::Response(200, "success", "", $data);
            }
        } else {
            return Helpers::Response(404, "failed", "no user found with provided id , user might have been deleted", '');
        }
    }

    public static function updateDetails($userid, $fullname, $email, $address, $state, $country, $dob, $accountbalance, $password, $isadmin, $pin)
    {
        $sql = "UPDATE users SET fullname =? , email = ? , addresses = ? , residentialstate =?,country =?,dob=?,accountbalance=?,pass =?,pin = ?,isAdmin=? WHERE userid =?";
        $query = self::$connect->prepare($sql);
        $query->bind_param("sssssssisis", $fullname, $email, $address, $state, $country, $dob, $accountbalance, $password, $pin, $isadmin, $userid);
        $query->execute();

        if ($query->affected_rows > 0) {
            return Helpers::Response(200, "success", "user updated successful", "");
        } else {
            return Helpers::Response(500, "failed", "unable to update details due to :" . self::$connect->error, "");
        }
    }

    public static function deleteUser($userid)
    {
        $userid = Helpers::filter($userid);

        $sql = "DELETE  FROM  users WHERE userid = ?";
        $query = self::$connect->prepare($sql);
        $query->bind_param("s", $userid);
        $query->execute();
        if ($query->affected_rows > 0) {
            return Helpers::Response(200, "success", "user deleted", '');
        } else {
            return Helpers::Response(500, "failed", "unable to delete user", '');
        }
    }


    public static function totalTransfer()
    {
        $sql = "SELECT COUNT(*) as transfers FROM  transactions";
        $query = self::$connect->query($sql);
        $data = $query->fetch_array();
        if ($data) {
            return Helpers::Response(200, "success", "woolah", $data["transfers"]);
        } else {
            return Helpers::Response(404, "failed", "nothing found", $data);
        }
    }

    public static function Transactions()
    {
        $data = [];
        $sql = "SELECT * FROM transactions ORDER BY id DESC";
        $query = self::$connect->prepare($sql);
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

    public static function cashMails()
    {
        $data = [];
        $sql = "SELECT * FROM cashmailing ORDER BY id DESC";
        $query = self::$connect->prepare($sql);
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
            return Helpers::Response(200, "success", " mail found", $data);
        } else {
            return Helpers::Response(404, "failed", "no mails found", "");
        }
    }

    public static function editCashMail($tracking, $address, $zipcode, $amount, $location, $status)
    {
        $sql = "UPDATE cashmailing SET addresses=?,zipcode=?,amount=?,locations=?,statuz =? WHERE tracking =?";
        $query = self::$connect->prepare($sql);
        $query->bind_param("siisss", $address, $zipcode, $amount, $location, $status, $tracking);
        $query->execute();
        if ($query->affected_rows > 0) {
            return Helpers::Response(200, "success", " update successful u may go back now", "");
        } else {
            return Helpers::Response(500, "failed", "update failed".self::$connect->error, "");
        }
    }
}
