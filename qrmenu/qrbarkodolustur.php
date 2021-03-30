<?php

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);
ob_start();
session_start();

extract($_GET);
extract($_POST);
ob_flush();
ini_set("display_errors", FALSE);

include_once("../s_cls/dbclass.php");
include_once("../s_cls/sessions.php");
s_start();
require "../d_cls/barkod.class.php";

//s_set('kullanici','admin');


$QRkod = new BarcodeQR();

/*
$time =date("Y-m-d h:i:s");
$timestr = str_replace("pm","",$time);
$timestr = str_replace(" ","",$timestr);
$timestr = str_replace("-","",$timestr);
$timestr = str_replace(":","",$timestr);
 */
$str = "http://192.168.1.36:8090/voidsysweb/mobilsite?masaid=$masaid";
//echo $str;
$QRkod->url($str);
//echo "www.dokuzsistem.com/index.php?time=$timestr";
$QRkod->draw();
$QRkod->draw(250, "barcode_masa_".$masaid);
//echo $masaid;
echo "<br><img src='./barcode_masa_".$masaid.".png'>";

?>