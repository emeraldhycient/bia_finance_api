<?php
require "../Helpers/Helpers.php";

class Admin extends Connection{

    public static function totalUsers()
    {
        $sql = "SELECT COUNT(*) as users FROM  users";
        $query = self::$connect->query($sql);
        $data = $query->fetch_array();
        if($data){
           return Helpers::Response(200,"success","woolah",$data);
        }else{
           return Helpers::Response(404,"failed","nothing found",$data);
        }

    }

    public static function allUsers()
    {
        $data = [];
        $sql = "SELECT * FROM users";

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
                        "password" => $row->$row->pass,
                        "address" => $row->addresses,
                        "state" => $row->residentialstate,
                        "country" => $row->country,
                        "dob" => $row->dob,
                        "isadmin" => (bool)$row->isadmin,
                        "createdAt" => $row->createdAt
                    ];
                }
                Helpers::Response(200, "success", "users found", $data);
        } else {
            Helpers::Response(404, "failed", "no user  found", '');
        }
    }

    public static function deleteUser($userid)
    {
        $userid = Helpers::filter($userid);

        $sql = "DELETE  FROM  users WHERE userid = ?";
        $query = self::$connect->query($sql);
        $query->bind_param("?",$userid);
        $query->execute();
        if($query->affected_rows > 0){
           return Helpers::Response(200,"success","woolah",'');
        }else{
           return Helpers::Response(500,"failed","unable to delete user",'');
        }

    }


    public static function totalTransfer()
    {
        $sql = "SELECT COUNT(*) as transfers FROM  transactions";
        $query = self::$connect->query($sql);
        $data = $query->fetch_array();
        if($data){
           return Helpers::Response(200,"success","woolah",$data);
        }else{
           return Helpers::Response(404,"failed","nothing found",$data);
        }

    }

    public static function Transactions()
    {
        $data = [];
       $sql = "SELECT * FROM transactions";
       $query = self::$connect->prepare($sql);
       $query->execute();
       $result = $query->get_result();

       if ($result->num_rows > 0) {
           while ($row = $result->fetch_object()) {
               $data[$row->id] = $row;
           }
           return Helpers::Response(200, "success", " transactions found",$data);
       } else {
           return Helpers::Response(404, "failed", "no transactions found", "");
       }
    }

    public static function cashMails()
    {
        $data = [];
        $sql = "SELECT * FROM cashmailing";
        $query = self::$connect->prepare($sql);
        $query->execute();
        $result = $query->get_result();
 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $data[$row->id] = $row;
            }
            return Helpers::Response(200, "success", " transactions found",$data);
        } else {
            return Helpers::Response(404, "failed", "no transactions found", "");
        }
    }

    public static function cashMail($tracking)
    {
       $tracking = Helpers::filter($tracking);
       $sql = "SELECT * FROM cashmailing WHERE tracking =?";
        $query = self::$connect->prepare($sql);
        $query->bind_param("s",$tracking);
        $query->execute();
        $result = $query->get_result();
 
        if ($result->num_rows > 0) {
            $data = $result->fetch_object();
            return Helpers::Response(200, "success", " transactions found",$data);
        } else {
            return Helpers::Response(404, "failed", "no transactions found", "");
        }
    }

    public static function editCashMail($tracking)
    {

    }





}