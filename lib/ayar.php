<?php
error_reporting(E_ALL ^ E_NOTICE); 
ob_start();
session_start();
extract($_GET);
extract($_POST);
ob_flush();
?>