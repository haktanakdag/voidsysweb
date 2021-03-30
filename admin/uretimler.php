<?php
$sayfaad="adminpanel.php?lx=uretimler.php";
$sayfaadEkle="adminpanel.php?lx=uretimform.php&islem=ekle";
$sayfaadDuzenle="adminpanel.php?lx=uretimform.php&islem=duzenle";
$sayfaadResimler="adminpanel.php?lx=uretimler.php";
$uretimler = new Uretim();
$forms = new clsForms();
$uretimsayi =$uretimler->UretimSayiBul();
if($sil){$uretimler-> UretimSil($sil);}
$sayfala =20;
$search = $forms->doSearch(array("id","mamkod","mamad","uretmiktar","tarih"),$txtara);
$pagerString=$forms->doPager($sayfala ,$sayfano,$anahtarsayi->sayi,$sayfaad);
$data = $uretimler->UretimleriGetir($pagerString,$search);
$forms->doform(array('basla','arama',$sayfaad));
$forms->doInput(array('txtara',$txtara));
$forms->doButton(array('ara','Ara'));
$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
$forms->doform(array('bitir'));
$forms->doGrid(
array(array("No",'5%'),array("Mamul Kod",'15%'),array("Mamul Ad",'40%'),array("miktar",'20%'),array("Tarih",'20%'))
,array("id","mamkod","mamad","uretmiktar","tarih")
,$data
,array(array("sil",$sayfaad,"Sil"))
,"gridTable"
);
$pagerString=$forms->doPager($sayfala ,$sayfano,$anahtarsayi->sayi,$sayfaad);
?>