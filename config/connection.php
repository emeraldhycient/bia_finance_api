<?php

class Connection
{

    protected static $connect = null;

    function __construct()
    {
        self::connector();
    }

    public static function connector()
    {
        // live db details c6n1OdETl9dc,biafzbwm_biafinance
        try {
            self::$connect = new mysqli("localhost", "root", "", "biacourier");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

$db = new Connection();