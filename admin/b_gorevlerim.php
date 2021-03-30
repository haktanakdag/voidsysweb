<?php
	$sayfaad="index.php?lx=b_gorevler.php";
	$sayfaadDetayGoster="index.php?lx=gorevislemdetay.php";
	$gorevler = new Gorev();
	$forms = new clsForms();
	$gorevsayi =$gorevler->GorevBaslikSayiBul();
	$sayfala =20;
	$search = $forms->doSearch(array("id","konu","durum"),$txtara);
	$search =$search." and sonkulid=".s_get('kullanici');

	$pagerString=$forms->doPager($sayfala ,$sayfano,$gorevsayi->sayi,$sayfaad);
	$dataset = $gorevler->GorevBasliklariGetir($pagerString,$search);
	$forms->doform(array('basla','arama',$sayfaad));
	$forms->doInput(array('txtara',$txtara));
	$forms->doButton(array('ara','Ara'));
	$forms->doform(array('bitir'));
	$forms->doGrid(
	array(array("No",'5%'),array("Konu",'20%'),array("Durum",'20%'))
	,array("id","konu","durum")
	,$dataset
	,array(array("detaygoster",$sayfaadDetayGoster,"Detay Göster"))
	,"gridTable"
	);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$gorevsayi->sayi,$sayfaad);
?>