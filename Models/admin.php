<?php
require "../Helpers/Helpers.php";

class Admin extends Connection
{

    public static function track($tracking)
    {
        $sql = "SELECT * FROM booking WHERE tracking =?";
        $query = self::$connect->prepare($sql);
        $query->bind_param("s", $tracking);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_object();
            return Helpers::Response(200, "success", "dispatch found", $data);
        } else {
            return Helpers::Response(404, "failed", "no dispatch found=>" . self::$connect->erro, "");
        }
    }

    static public function updatelocation(
        $tracking,
        $lat,
        $lng,
        $currentlocation,
        $detail1,
        $detail2,
        $detail3,
        $detail4,
        $detail5,
        $detail6
    ) {
        $sql = "UPDATE booking SET lat='$lat',lng='$lng',currentlocation='$currentlocation' ,detail1='$detail1',detail2='$detail2',detail3='$detail3',detail4='$detail4',detail5='$detail5',detail6='$detail6' WHERE tracking='$tracking' ";
        $query = self::$connect->query($sql);
        if ($query) {
            return Helpers::Response(200, "success", "booking updated successfully", "");
        } else {
            return Helpers::Response(500, "failed", "unable to update booking", "");
        }
    }

    public static  function updatebooking($tracking)
    {
        $sql = "UPDATE booking SET paymentstatus='paid' WHERE tracking='$tracking' ";
        $query = self::$connect->query($sql);
        if ($query) {
            return Helpers::Response(200, "success", "booking updated successfully", "");
        } else {
            return Helpers::Response(500, "failed", "unable to update booking", "");
        }
    }

    public static function allbookings()
    {
        $load = [];
        $sql = "SELECT * FROM booking";
        $query = self::$connect->prepare($sql);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $load[$row->id] = $row;
            }
            return Helpers::Response(200, "success", "", $load);
        } else {
            return Helpers::Response(404, "failed", "no userr found", "");
        }
    }


    public static function getchat($receiver, $sender)
    {
        $load = [];
        $sql = "SELECT * FROM chats WHERE sender=? AND receiver =? OR sender=? AND receiver =?";
        $query = self::$connect->prepare($sql);
        $query->bind_param("ssss", $sender, $receiver, $receiver, $sender);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                $load[$row->id] = $row;
            }
            return Helpers::Response(200, "success", "", $load);
        } else {
            return Helpers::Response(404, "failed", "no userr found", "");
        }
    }



    public static function sendMessage($sender, $receiver, $message)
    {
        $sql = "INSERT INTO chats (sender,receiver,messages) VALUES (?,?,?)";
        $query = self::$connect->prepare($sql);
        $query->bind_param("sss", $sender, $receiver, $message);
        $query->execute();
        if ($query->affected_rows > 0) {
            return Helpers::Response(200, "success", "sent", '');
        } else {
            return Helpers::Response(500, "failed", "unable to send message" . self::$connect->error, '');
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
                $data["users"][$row->id] = $row;
            }
            return Helpers::Response(200, "success", "users found", $data);
        } else {
            return Helpers::Response(404, "failed", "no user  found", '');
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
}