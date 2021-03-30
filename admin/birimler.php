<?php
	$sayfaad="adminpanel.php?lx=birimler.php";
	$sayfaadEkle="adminpanel.php?lx=birimform.php&islem=ekle";
	$sayfaadDuzenle="adminpanel.php?lx=birimform.php&islem=duzenle";
	$birimyetki="adminpanel.php?lx=birimyetki.php";
	$birimler = new Birimler();
	if($sil){$birimler-> BirimSil($sil);}
	$forms = new clsForms();
	$birimsayi =$birimler->BirimSayiBul();
	$sayfala =10;
	$search = $forms->doSearch(array("id","birimad"),$txtara);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$birimsayi->sayi,$sayfaad);
	$kullanicilar = $birimler->BirimleriGetir($pagerString,$search);
	$forms->doform(array('basla','arama',$sayfaad));
	$forms->doInput(array('txtara',$txtara));
	$forms->doButton(array('ara','Ara'));
	$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
	$forms->doform(array('bitir'));
	$forms->doGrid(
	array(array("No",'10%'),array("Birim Ad",'40%'))
	,array("id","birimad")
	,$kullanicilar
	,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"),array("birimyetki",$birimyetki,"Birim Yetki"))
	,"gridTable"
	);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$birimsayi->sayi,$sayfaad);
?>