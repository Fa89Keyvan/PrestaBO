<?php

define("DB_SERVER","localhost");
define("DB_NAME","prestashop");
define("DB_USER","root");
define("DB_PASSWORD","");
define("COOKIE_KEY","F5TQLZGKrnCR2RJoxNLXa3M6cLbpbehegAFNTTKa7QAOPdrsVLHjNVfv");
define("TB_PREFIX","ps_");
define("DATE_TIME_FORMAT","Y-m-d H:i:s");
define("TIME_ZONE","Asia/Tehran");


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
}


/**
 * @param $key string
 * @return string
 */
function GetPostedValue($key){

    if(isset($_POST[$key]))
        return $_POST[$key];

    return null;

}