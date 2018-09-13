<?php

/**
 * HesabfaApi short summary.
 *
 * HesabfaApi description.
 *
 * @version 1.0
 * @author Keyvan
 */
class HesabfaApi
{

    public static function GetByMobile(){


        $mobile = GetPostedValue('Mobile');
        if($mobile == null){
            echo Tools::ToJson(null);
            die();
        }
        $hesabfaContactsStore = new HesabfaContactStore();
        $result = $hesabfaContactsStore->GetContactsByMobile($mobile);
        echo Tools::ToJson($result);
    }
}