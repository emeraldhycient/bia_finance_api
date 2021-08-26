<?php

class Connection {

    protected static $connect = null;

   function __construct()
   {
       self::connector();
   }

    public static function connector()
    {
        // live db details 9!D5o?$CJ2#0,jetstrea_biafinance
        try {
             self::$connect = new mysqli("localhost","root","","biafinance");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


}

