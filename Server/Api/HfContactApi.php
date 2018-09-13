<?php

class HfContactApi
{
    public static function GetAll(){

        $hfContactStore = new HfContactsStore();
        $lstHfContacts = $hfContactStore->Select_All();
        echo Tools::ToJson($lstHfContacts);
    }

    public static function Get(){
        $id = GetPostedValue('id');
        if($id === null)
        {
            echo Tools::ToJson(null);
            die();
        }

        $hfContactStore = new HfContactsStore();
        $hfContact = $hfContactStore->Select((int)$id);
        echo Tools::ToJson($hfContact);
    }
}