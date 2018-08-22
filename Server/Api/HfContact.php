<?php
/**
 * Created by PhpStorm.
 * User: Keyvan
 * Date: 8/22/2018
 * Time: 4:59 PM
 */

$q = GetPostedValue('q');

if($q != null){
    $hfContactStore = new HfContactsStore();
    switch($q)
    {
        case 'getAll': getAll($hfContactStore); break;
        default: http_response_code(400);
    }
}
else{
    http_response_code(400);
}

/**
 * @param $hfContactStore HfContactsStore
 */
function getAll($hfContactStore){

    $lstHfContacts = $hfContactStore->Select_All();
    echo Tools::ToJson($lstHfContacts);


}