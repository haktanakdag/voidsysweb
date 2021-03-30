<?php
include_once('../classes_include.php');
$lisans = new Lisans();
$lisansd =$lisans->LisansKontrol($uygulama,$bilgisayar,$tarih);
if($lisansd->id){
    echo "lisansvar";
}
?>