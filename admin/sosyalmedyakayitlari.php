<?php
$sayfaad="adminpanel.php?lx=sosyalmedyakayitlari.php";
$sayfaadEkle="adminpanel.php?lx=sosyalmedyakayitform.php&islem=ekle";
$sayfaadDuzenle="adminpanel.php?lx=sosyalmedyakayitform.php&islem=duzenle";
$kayitlar = new SosyalMedya();
$forms = new clsForms();
$kayitsayi =$kayitlar->KayitSayiBul();
if($sil){$kayitlar-> KayitSil($sil);}
$sayfala =20;
$search = $forms->doSearch(array("id","kayitad"),$txtara);
$pagerString=$forms->doPager($sayfala ,$sayfano,$kayitsayi->sayi,$sayfaad);
$data = $kayitlar->KayitlariGetir($pagerString,$search);
$forms->doform(array('basla','arama',$sayfaad));
$forms->doInput(array('txtara',$txtara));
$forms->doButton(array('ara','Ara'));
$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
$forms->doform(array('bitir'));
$forms->doGrid(
array(array("No",'10%'),array("Kayit Ad",'40%'))
,array("id","kayitad")
,$data
,array(array("sil",$sayfaad,"Sil"),array("duzenleid",$sayfaadDuzenle,"Düzenle"))
,"gridTable"
);
$pagerString=$forms->doPager($sayfala ,$sayfano,$kayitsayi->sayi,$sayfaad);
?>