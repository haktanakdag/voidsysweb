<?php
	$sayfaad="adminpanel.php?lx=unvanlar.php";
	$sayfaadEkle="adminpanel.php?lx=unvanform.php&islem=ekle";
	$sayfaadDuzenle="adminpanel.php?lx=unvanform.php&islem=duzenle";
	$unvanlar = new Unvanlar();
	if($sil){$unvanlar-> UnvanSil($sil);}
	$forms = new clsForms();
	$unvansayi =$unvanlar->UnvanSayiBul();
	$sayfala =10;
	$search = $forms->doSearch(array("id","unvanad"),$txtara);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$unvansayi->sayi,$sayfaad);
	$kullanicilar = $unvanlar->UnvanlariGetir($pagerString,$search);
	$forms->doform(array('basla','arama',$sayfaad));
	$forms->doInput(array('txtara',$txtara));
	$forms->doButton(array('ara','Ara'));
	$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
	$forms->doform(array('bitir'));
	$forms->doGrid(
	array(array("No",'10%'),array("Ünvan Ad",'70%'))
	,array("id","unvanad")
	,$kullanicilar
	,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"))
	,"gridTable"
	);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$unvansayi->sayi,$sayfaad);
?>