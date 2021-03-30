<?php
	$sayfaad="adminpanel.php?lx=istanimlari.php";
	$sayfaadEkle="adminpanel.php?lx=istanimiform.php&islem=ekle";
	$sayfaadDuzenle="adminpanel.php?lx=istanimiform.php&islem=duzenle";
	$istanimlari = new IsTanimlari();
	if($sil){$istanimlari-> IsTanimiSil($sil);}
	$forms = new clsForms();
	$istanimsayi =$istanimlari->IsTanimSayiBul();
	$sayfala =20;
	$search = $forms->doSearch(array("id","adsoyad","isne"),$txtara);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$istanimsayi->sayi,$sayfaad);
	if($gorev){
		$search ="where gorevid=".$gorev;
	}
	$dataset = $istanimlari->IsTanimlariGetir($pagerString,$search);
	$forms->doform(array('basla','arama',$sayfaad));
	$forms->doInput(array('txtara',$txtara));
	$forms->doButton(array('ara','Ara'));
	$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
	$forms->doform(array('bitir'));
	$forms->doGrid(
	array(array("No",'10%'),array("Gorev Tanım",'35%'),array("İş Ne",'35%'))
	,array("id","adsoyad","isne")
	,$dataset
	,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"))
	,"gridTable"
	);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$istanimsayi->sayi,$sayfaad);
?>