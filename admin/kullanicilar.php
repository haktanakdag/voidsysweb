<?php
	$sayfaad="adminpanel.php?lx=kullanicilar.php";
	$sayfaadEkle="adminpanel.php?lx=kullaniciform.php&islem=ekle";
	$sayfaadDuzenle="adminpanel.php?lx=kullaniciform.php&islem=duzenle";
	$kulyetki="adminpanel.php?lx=kullaniciyetki.php";
	$kullanicilar = new Kullanicilar();
	if($sil){$kullanicilar-> KullaniciSil($sil);}
	$forms = new clsForms();
	$kullanicisayi =$kullanicilar->KullaniciSayiBul();
	$sayfala =10;
	$search = $forms->doSearch(array("id","adsoyad"),$txtara);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$kullanicisayi->sayi,$sayfaad);
	$dataset = $kullanicilar->KullanicilariGetir($pagerString,$search);
	$forms->doform(array('basla','arama',$sayfaad));
	$forms->doInput(array('txtara',$txtara));
	$forms->doButton(array('ara','Ara'));
	$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
	$forms->doform(array('bitir'));
	$forms->doGrid(
	array(array("No",'5%'),array("Ad Soyad",'20%'))
	,array("id","adsoyad")
	,$dataset
	,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"),array("kulyetki",$kulyetki,"Kullanıcı Yetki"))
	,"gridTable"
	);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$kullanicisayi->sayi,$sayfaad);
?>