<?php

/**
 * Created by PhpStorm.
 * User: Keyvan
 * Date: 8/17/2018
 * Time: 3:50 PM
 */
class Tools
{

    /**
     * @param $biggerDate  DateTime
     * @param $smallerDate DateTime
     * @return int
     */
    public static function DiffInSeconds($biggerDate,$smallerDate){

        $biggerDateInString  = $biggerDate->format(_DATE_TIME_FORMAT_);
        $smallerDateInString = $smallerDate->format(_DATE_TIME_FORMAT_);

        //echo sprintf('<BR> bigger: %s <BR> smaller: %s <BR>',$biggerDateInString,$smallerDateInString);

        $biggerTimestamp  = strtotime($biggerDateInString);
        $smallerTimestamp = strtotime($smallerDateInString);

        return $biggerTimestamp - $smallerTimestamp;

    }

    /**
     * @return DateTime
     */
    public static function GetLocalDateTime(){

        return new DateTime('now',new DateTimeZone(_TIME_ZONE_));

    }

    /**
     * @param $dateTime DateTime
     * @return string
     */
    public static function DateToString ($dateTime){
        return $dateTime->format(_DATE_TIME_FORMAT_);
    }

    /**
     * @param $dateTimeInString string
     * @return DateTime
     */
    public static function StringToDateTime($dateTimeInString){
        return DateTime::createFromFormat(_DATE_TIME_FORMAT_,$dateTimeInString);
    }

    /**
     * @param $obj object|object[]
     * @return string
     */
    public static function ToJson($obj){
        return json_encode($obj,JSON_UNESCAPED_UNICODE);
    }

    public static function FromJson($jsonString){
        return json_decode($jsonString,false,512,JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $str string
     * @return bool
     */
    public static function IsNullOrEmpty($str){
        return ($str === null || $str === '');
    }

    /**
     * Summary of PostAsJson
     * @param string $url 
     * @param mixed $obj 
     * @return string jsonString
     */
    public static function PostAsJson($url,$obj){

        $json_string = self::ToJson($obj);

        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json_string))
        );

        $result = curl_exec($ch);
        return $result;
    }
}