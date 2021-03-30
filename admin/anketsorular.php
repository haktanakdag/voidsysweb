<?php
	$sayfaad="adminpanel.php?lx=anketsorular.php";
	$sayfaadEkle="adminpanel.php?lx=anketsoruekle.php";
	$sayfaadDuzenle="adminpanel.php?lx=anketsoruduzenle.php";
	$anketler = new Anket();
	$forms = new clsForms();
	$anketsorusayi =$anketler->AnketSoruSayiBul($anketid);
	if($sil){$anketler-> AnketSoruSil($sil);}
	$sayfala =20;
	$search = $forms->doSearch(array("id","soru"),$txtara);
	$search =$search." and anketid=$anketid";
	$pagerString=$forms->doPager($sayfala ,$sayfano,$anketsorusayi->sayi,$sayfaad);
	$data = $anketler->AnketSorulariGetir($pagerString,$search);
	$forms->doform(array('basla','arama',$sayfaad));
	$forms->doInput(array('txtara',$txtara));
	$forms->doButton(array('ara','Ara'));
	//$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
	$forms->doform(array('bitir'));
	$forms->doGrid(
	array(array("No",'10%'),array("Soru",'70%'))
	,array("id","soru")
	,$data
	,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"))
	,"gridTable"
	);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$anketsorusayi->sayi,$sayfaad);
?>