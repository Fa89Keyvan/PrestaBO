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

        $biggerDateInString  = $biggerDate->format(DATE_TIME_FORMAT);
        $smallerDateInString = $smallerDate->format(DATE_TIME_FORMAT);

        echo sprintf('bigger: %s <BR> smaller: %s <BR>',$biggerDateInString,$smallerDateInString);

        $biggerTimestamp  = strtotime($biggerDateInString);
        $smallerTimestamp = strtotime($smallerDateInString);

        return $biggerTimestamp - $smallerTimestamp;

    }
}