<?php

class Connection {

    protected static $connect = null;

   function __construct()
   {
       self::connector();
   }

    public static function connector()
    {
        try {
             self::$connect = new mysqli("localhost","root","","biafinance");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


}

