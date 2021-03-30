<?php
	$sayfaad="adminpanel.php?lx=gorevtanimlari.php";
	$sayfaadEkle="adminpanel.php?lx=gorevtanimiform.php&islem=ekle";
	$sayfaadDuzenle="adminpanel.php?lx=gorevtanimiform.php&islem=duzenle";
	$sayfaadIsTanimi="adminpanel.php?lx=istanimlari.php";
	$sayfaadIsTanimiEkle="adminpanel.php?lx=istanimiform.php&islem=ekle";
	$gorevtanimlari = new GorevTanimlar();
	if($sil){$gorevtanimlari-> GorevTanimiSil($sil);}
	$forms = new clsForms();
	$gorevtanimsayi =$gorevtanimlari->GorevTanimSayiBul();
	$sayfala =10;
	$search = $forms->doSearch(array("id","adsoyad"),$txtara);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$gorevtanimsayi->sayi,$sayfaad);
	$dataset = $gorevtanimlari->GorevTanimlariGetir($pagerString,$search);
	$forms->doform(array('basla','arama',$sayfaad));
	$forms->doInput(array('txtara',$txtara));
	$forms->doButton(array('ara','Ara'));
	$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
	$forms->doform(array('bitir'));
	$forms->doGrid(
	array(array("No",'5%'),array("Ad Soyad",'20%'))
	,array("id","adsoyad")
	,$dataset
	,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"),array("gorev",$sayfaadIsTanimi,"İş Tanımları"),array("gorev",$sayfaadIsTanimiEkle,"İş Tanım Ekle"))
	,"gridTable"
	);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$gorevtanimsayi->sayi,$sayfaad);
?>