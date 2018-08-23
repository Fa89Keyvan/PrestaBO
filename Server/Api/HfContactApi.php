<?php

class HfContactApi
{
    /**
     * @param $hfContactStore HfContactsStore
     */
    public static function GetAll(){

        $hfContactStore = new HfContactsStore();
        $lstHfContacts = $hfContactStore->Select_All();
        echo Tools::ToJson($lstHfContacts);
    }
}