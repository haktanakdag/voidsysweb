<?php
	$sayfaad="adminpanel.php?lx=listebasliklar.php";
	$sayfaadEkle="adminpanel.php?lx=listebaslikform.php&islem=ekle";
	$sayfaadDuzenle="adminpanel.php?lx=listebaslikform.php&islem=duzenle";
	$sayfaadListeDetaylar="adminpanel.php?lx=listedetaylar.php";
	$sayfaadListeDetayEkle="adminpanel.php?lx=listedetayform&islem=ekle.php";
	$listebasliklar = new Listeler();
	if($sil){$listebasliklar-> ListeBaslikSil($sil);}
	$forms = new clsForms();
	$listebasliksayi =$listebasliklar->ListeBaslikSayiBul();
	$sayfala =10;
	$search = $forms->doSearch(array("id","lbaciklama"),$txtara);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$listebasliksayi->sayi,$sayfaad);
	$data = $listebasliklar->ListeBasliklariGetir($pagerString,$search);
	$forms->doform(array('basla','arama',$sayfaad));
	$forms->doInput(array('txtara',$txtara));
	$forms->doButton(array('ara','Ara'));
	$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
	$forms->doform(array('bitir'));
	$forms->doGrid(
	array(array("No",'5%'),array("Liste Başlık Açıklama",'10%'))
	,array("id","lbaciklama")
	,$data
	,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"),array("listebaslikId",$sayfaadListeDetaylar,"Liste Detaylar"),array("listebaslikId",$sayfaadListeDetayEkle,"Liste Detay Ekle"))
	,"gridTable"
	);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$listebasliksayi->sayi,$sayfaad);
?>