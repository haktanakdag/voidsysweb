<?php
	$sayfaad="adminpanel.php?lx=quizcevaplar.php";
	$sayfaadEkle="adminpanel.php?lx=quizcevapform.php&islem=ekle&quizid=$quizid&soruid=$soruid";
	$sayfaadDuzenle="adminpanel.php?lx=quizcevapform.php&islem=duzenle&quizid=$quizid&soruid=$soruid";
	$quizler = new Quiz();
	$forms = new clsForms();
	$quizcevapsayi =$quizler->QuizCevapSayiBul($quizid,$soruid);
	if($sil){$quizler-> QuizCevapSil($sil);}
	$sayfala =20;
	$search = $forms->doSearch(array("id","cevap"),$txtara);
	$search =$search." and quizid=$quizid and soruid=$soruid";
	$pagerString=$forms->doPager($sayfala ,$sayfano,$quizcevapsayi->sayi,$sayfaad);
	$data = $quizler->QuizCevaplariGetir($pagerString,$search);
        $dsorular =$quizler->QuizSoruGetir($soruid);
	$forms->doform(array('basla','arama',$sayfaad));
	$forms->doInput(array('txtara',$txtara));
	$forms->doButton(array('ara','Ara'));
	$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
	$forms->doform(array('bitir'));
        echo "<h2><b>Soru</b> :" .$dsorular->soru."</h2>";
	$forms->doGrid(
	array(array("No",'10%'),array("Cevap",'50%'),array("DY",'10%'))
	,array("id","cevap",'dy')
	,$data
	,array(array("sil",$sayfaad,"Sil")
        ,array("duzenle",$sayfaadDuzenle,"Düzenle")
        )
	,"gridTable"
	);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$quizcevapsayi->sayi,$sayfaad);
?>