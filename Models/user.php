<?php

require "../Helpers/Helpers.php";

class User extends Connection
{
    static function createBooking(
        $senderid,
        $receivername,
        $receiveremail,
        $receiveraddress,
        $receiverpostalcode,
        $quantity,
        $weight,
        $bookingdate,
        $expected,
        $instruction
    ) {
        $tracking = uniqid("bia");
        $sql = "INSERT INTO booking (tracking,receivername,	receiveremail,receiveraddress,receiverpostal,senderid,
        quantity,weigh,bookingdate,expecteddate,instructions) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $query = self::$connect->prepare($sql);
        $query->bind_param(
            "ssssssiisss",
            $tracking,
            $receivername,
            $receiveremail,
            $receiveraddress,
            $receiverpostalcode,
            $senderid,
            $quantity,
            $weight,
            $bookingdate,
            $expected,
            $instruction
        );
        $query->execute();
        if ($query->affected_rows > 0) {
            $load = [
                "tracking" => $tracking
            ];
            return Helpers::Response(200, "success", "booking is scheduled,proceed to make payment now ", $load);
        } else {
            return Helpers::Response(500, "failed", "internal server error :" . $query->error, "");
        }
    }

    static function allBooking($userid)
    {
        $load = [];
        $sql = "SELECT * FROM booking WHERE senderid='$userid'";
        $query = self::$connect->query($sql);
        if ($query->num_rows > 0) {
            while ($row = $query->fetch_object()) {
                $load[$row->id] = $row;
            }
            return Helpers::Response(200, "success", "booking is scheduled,proceed to make payment now ", $load);
        } else {
            return Helpers::Response(404, "failed", "no booking found:" . $query->error, "");
        }
    }
}