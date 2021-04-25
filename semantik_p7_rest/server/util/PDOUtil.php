<?php

class PDOUtil
{
    public static function createConnection()
    {
        $link = new PDO("mysql:host=localhost; dbname=latihansemantik", "root", "");
        $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
        $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $link;
    }

    public static function closeConnection($link)
    {
        if ($link != null) {
            $link = null;
        }
    }
}
