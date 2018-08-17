<?php

class BaseStore
{

    /**
     * @return \mysqli|null
     */
    public static function GetDB()
    {
        try{
            $db = new \mysqli(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME);
            $db->query("SET CHARACTER SET utf8;");
            $db->query("SET SESSION collation_connection = 'utf8_general_ci'");
            return $db;
        }
        catch(\Exception $ex){
            //log $ex;
            die($ex->getMessage());
        }
    }

}