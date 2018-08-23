<?php

define("_DB_SERVER_","localhost");
define("_DB_NAME_","prestashop");
define("_DB_USER_","root");
define("_DB_PASSWD_","");
define("_COOKIE_KEY_","F5TQLZGKrnCR2RJoxNLXa3M6cLbpbehegAFNTTKa7QAOPdrsVLHjNVfv");
define("_DB_PREFIX_","ps_");
define("_DATE_TIME_FORMAT_","Y-m-d H:i:s");
define("_TIME_ZONE_","Asia/Tehran");


function __autoload($classname) {

    $filename = $classname .".php";
    if(strpos($filename,'Store')>1){
        require_once('../DAL/'.$filename);
    }
    else if(strpos($filename,'Model')>1){
        require_once('../Models/'.$filename);
    }
    else if($classname == 'Tools'){
        require_once('../Tools/Tools.php');
    }
    else if(strpos($filename,'DTO')>1){
        if(file_exists('../DTO/'.$filename))
            require_once('../DTO/'.$filename);
        else
            require_once($filename);
    }
    else if(strpos($filename,'Api')>1){
        if(file_exists('../Api/'.$filename))
            require_once('../Api/'.$filename);
        else
            require_once($filename);
    }
}


/**
 * @param $key string
 * @return null|string
 */
function GetPostedValue($key){

    if(isset($_POST[$key]))
        return $_POST[$key];

    return null;

}

/**
 * @param $key string
 * @return null|string
 */
function GetQueryValue($key){
    if(isset($_GET[$key]))
        return $_GET[$key];

    return null;
}