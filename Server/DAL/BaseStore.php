<?php

class BaseStore
{

    /**
     * @return \mysqli|null
     */
    public static function GetDB()
    {
        try{
            $db = new \mysqli(_DB_SERVER_,_DB_USER_,_DB_PASSWD_,_DB_NAME_);
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