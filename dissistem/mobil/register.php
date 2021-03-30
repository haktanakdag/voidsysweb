<?php
header('Content-Type: text/html; charset=utf-8');
include '../../s_cls/dbclass.php';
include '../../s_cls/sessions.php';
include '../../s_cls/cls_kullanicilar.php';

$kullanicilar = new Kullanicilar();
$kullanicilar->KullaniciEkle($adsoyad, $email, $sifre, $telefon, $birimid, $unvanid, $gorevid)