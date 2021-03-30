<?php
	$sayfaad="adminpanel.php?lx=quizsorular.php";
	$sayfaadEkle="adminpanel.php?lx=quizsoruform.php&islem=ekle&quizid=$quizid";
	$sayfaadDuzenle="adminpanel.php?lx=quizsoruform.php&islem=duzenle";
        $sayfaadQuizSoruCevaplar="adminpanel.php?lx=quizcevaplar.php&quizid=$quizid";
        $sayfaadQuizSoruCevapEkle="adminpanel.php?lx=quizcevapform.php&islem=ekle&quizid=$quizid";
	$quizler = new Quiz();
	$forms = new clsForms();
	$quizsorusayi =$quizler->QuizSoruSayiBul($quizid);
	if($sil){$quizler-> QuizSoruSil($sil);}
	$sayfala =20;
	$search = $forms->doSearch(array("id","soru"),$txtara);
	$search =$search." and quizid=$quizid";
	$pagerString=$forms->doPager($sayfala ,$sayfano,$quizsorusayi->sayi,$sayfaad);
	$data = $quizler->QuizSorulariGetir($pagerString,$search);
	$forms->doform(array('basla','arama',$sayfaad));
	$forms->doInput(array('txtara',$txtara));
	$forms->doButton(array('ara','Ara'));
	$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
	$forms->doform(array('bitir'));
	$forms->doGrid(
	array(array("No",'5%'),array("Soru",'20%'))
	,array("id","soru")
	,$data
	,array(array("sil",$sayfaad,"Sil")
        ,array("duzenle",$sayfaadDuzenle,"Düzenle")
        ,array("soruid",$sayfaadQuizSoruCevaplar,"Cevaplar")  
        ,array("soruid",$sayfaadQuizSoruCevapEkle,"Cevap Ekle") 
        )
	,"gridTable"
	);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$quizsorusayi->sayi,$sayfaad);
?>