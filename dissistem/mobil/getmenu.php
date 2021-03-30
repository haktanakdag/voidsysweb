<?php
header('Content-Type: text/html; charset=utf-8');
include '../../s_cls/dbclass.php';
include '../../s_cls/cls_menu.php';

$menu = new clsMenu();
$dmenu  = $menu->mobilmenuleriGetir();
//print_r($dmenu);
echo json_encode($dmenu);
?>