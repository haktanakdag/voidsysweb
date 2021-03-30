<?php
	$sayfaad="adminpanel.php?lx=listedetaylar.php";
	$sayfaadEkle="adminpanel.php?lx=listedetayform.php";
	$sayfaadDuzenle="adminpanel.php?lx=listedetayform.php";
	$listedetaylar = new Listeler();
	if($sil){$listedetaylar-> ListeDetaySil($sil);}
	$forms = new clsForms();
	$listedetaysayi =$listedetaylar->ListeDetaySayiBul();
	$sayfala =10;
	$search = $forms->doSearch(array("ld.id","lb.lbaciklama","ld.ldaciklama"),$txtara);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$listedetaysayi->sayi,$sayfaad);
	if($listebaslikId){
		$search ="where baslikid=".$listebaslikId;
	}
	$data = $listedetaylar->ListeDetaylariGetir($pagerString,$search);
	$forms->doform(array('basla','arama',$sayfaad));
	$forms->doInput(array('txtara',$txtara));
	$forms->doButton(array('ara','Ara'));
	$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
	$forms->doform(array('bitir'));
	$forms->doGrid(
	array(array("No",'10%'),array("Liste Başlık Açıklama",'35%'),array("Liste Detay Açıklama",'35%'))
	,array("id","lbaciklama","ldaciklama")
	,$data
	,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"))
	,"gridTable"
	);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$listedetaysayi->sayi,$sayfaad);
?>