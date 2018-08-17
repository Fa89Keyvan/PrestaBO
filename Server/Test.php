<?php
/**
 * Created by PhpStorm.
 * User: Keyvan
 * Date: 8/17/2018
 * Time: 3:07 PM
 */


require_once('Tools/Tools.php');
//Our dates
$pastDate   = DateTime::createFromFormat('Y-m-d H:i:s','2018-08-17 15:00:00');
$nowDate    = new DateTime('now',new DateTimeZone('ASIA/Tehran'));

$interval = Tools::DiffInSeconds($nowDate,$pastDate);


echo $interval;



