<?php include_once('../classes_include.php'); ?>
<?php
error_reporting(E_ALL ^ E_NOTICE); 
extract($_GET);
extract($_POST);

if ($islem =='istanimiekle'){
	$istanimlari = new IsTanimlari();
	$islemok = $istanimlari->IsTanimiEkle($isne,$iskimden,$isinozeti,$amac,$yontem,$surec,$ortam,$iskime,$gorevid);
	if($islemok){
			echo "Kaydınız Başarı ile alınmıştır.";
		}
		else{
			echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='istanimiduzenle'){
	$istanimlari = new IsTanimlari();
	$islemok = $istanimlari->IsTanimiDuzenle($IsTanimId,$isne,$iskimden,$isinozeti,$amac,$yontem,$surec,$ortam,$iskime,$gorevid);
	if($islemok){
			echo "Kaydınız Başarı ile alınmıştır.";
		}
		else{
			echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='gorevtanimekle'){
	$gorevtanimlari = new GorevTanimlar();
	$islemok = $gorevtanimlari->GorevTanimEkle($adsoyad,$birimid,$unvanid,$bagunvanid,$gorevinamaci,$gorevkisatanimi,$vekaletid,$issorumluluklari,$yetkileri,$anahtarlar);
	if($islemok){
			echo "Kaydınız Başarı ile alınmıştır.";
		}
		else{
			echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='gorevtanimduzenle'){
	$gorevtanimlari = new GorevTanimlar();
	$islemok = $gorevtanimlari->GorevTanimDuzenle($GorevTanimId,$adsoyad,$birimid,$unvanid,$bagunvanid,$gorevinamaci,$gorevkisatanimi,$vekaletid,$issorumluluklari,$yetkileri,$anahtarlar);
	if($islemok){
			echo "Kaydınız Başarı ile alınmıştır.";
		}
		else{
			echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='gorevatamaekle'){
	$gorevatama = new Gorev();
	$acankulid =s_get("kullanici");
	$kapatankulid="";
	$acilistarih=date("Y.m.d");
	$acilissaat=date("H:i:s");
	$listeler = new Listeler();
	$dlisteler = $listeler->ListeDetayGetir($durumid);
	if($dlisteler->ldaciklama=="Kapalı"){
		$kapanistarih=date("Y.m.d");
		$kapanissaat=date("H:i:s");
	}else{
		$kapanistarih="";
		$kapanissaat="";
	}
	$atanangorevid = $gorevatama->GorevBaslikEkle($konu,$kaynakid,$nedenid,$aciliyetid,$durumid,$acankulid,$kapatankulid,$acilistarih,$acilissaat,$kapanistarih,$kapanissaat,$dissistemno1,$dissistemno2,$dissistemno3);
	$eklendi = $gorevatama->GorevDetayEkle($atanangorevid,$islemturid,$detayaciklama,$acilistarih,$acilissaat,$acankulid,$sonkulid,$islemsure);
	if($eklendi){
	echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
	echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='gorevdetayislemekle'){
	$gorevatama = new Gorev();
	$islemkulid =s_get("kullanici");
	$kapatankulid="";
	$islemtarih=date("Y.m.d");
	$islemsaat=date("H:i:s");
	$listeler = new Listeler();
	$dlisteler = $listeler->ListeDetayGetir($durumid);
	if($dlisteler->ldaciklama=="Kapalı"){
		$kapanistarih=date("Y.m.d");
		$kapanissaat=date("H:i:s");
		$kapatankulid=s_get("kullanici");
		$duzenlendi = $gorevatama->GorevBaslikDuzenle($gdeklenengorevid,$durumid,$kapatankulid,$kapanistarih,$kapanissaat);
	}else{
		$kapanistarih="";
		$kapanissaat="";
		$duzenlendi = $gorevatama->GorevBaslikDuzenle($gdeklenengorevid,$durumid,$kapatankulid,$kapanistarih,$kapanissaat);
	}
	$eklendi = $gorevatama->GorevDetayEkle($gdeklenengorevid,$islemturid,$detayaciklama,$islemtarih,$islemsaat,$islemkulid,$sonkulid,$islemsure);
	if($eklendi){
	echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
	echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='admingorevduzenle'){
	$gorevatama = new Gorev();
	$kapatankulid="";
	$listeler = new Listeler();
	$dlisteler = $listeler->ListeDetayGetir($durumid);
	if($dlisteler->ldaciklama=="Kapalı"){
		$kapanistarih=date("Y.m.d");
		$kapanissaat=date("H:i:s");
		$kapatankulid=0;
	}else{
		$kapanistarih="";
		$kapanissaat="";
	}
	$duzenlendi = $gorevatama->GorevBaslikDuzenle($gdeklenengorevid,$durumid,$kapatankulid,$kapanistarih,$kapanissaat);
	if($duzenlendi){
	echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
	echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='birimekle'){
	$birimler = new Birimler();
	$birimeklendi = $birimler->BirimEkle($birimad,$birimbagid);
	if($birimeklendi=="birimvar"){
	echo "Birim Daha Önce Eklenmiş.";
	}elseif($birimeklendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='birimduzenle'){
	$birimler = new Birimler();
	$birimduzenlendi = $birimler->BirimDuzenle($birimid,$birimad,$birimbagid);
	if($birimduzenlendi=="birimvar"){
		echo "Birim Daha Önce Eklenmiş.";
	}elseif($birimduzenlendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='unvanekle'){
	$unvanlar = new Unvanlar();
	$unvaneklendi = $unvanlar->UnvanEkle($unvanad,$bagliunvanid);
	if($unvaneklendi=="unvanvar"){
		echo "Daha Önce Eklenmiş.";
	}elseif($unvaneklendi){
	echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
	echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='unvanduzenle'){
	$unvanlar = new Unvanlar();
	$unvanduzenlendi = $unvanlar->UnvanDuzenle($unvanid,$unvanad,$bagliunvanid);
	if($unvanduzenlendi=="unvanvar"){
		echo "Daha Önce Eklenmiş.";
	}elseif($unvanduzenlendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='anketekle'){
	$anketler = new Anket();
	$anketeklendi = $anketler->AnketEkle($anketad,$aciklama,$durumid);
	if($anketeklendi=="anketvar"){
	echo "Daha Önce Eklenmiş.";
	}elseif($anketeklendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='anketduzenle'){
	$anketler = new Anket();
	$anketduzenlendi = $anketler->AnketDuzenle($anketid,$anketad,$aciklama,$durumid);
	if($anketduzenlendi=="anketvar"){
	echo "Daha Önce Eklenmiş.";
	}elseif($anketduzenlendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='anketsoruekle'){
	$anketler = new Anket();
	$anketsorueklendi = $anketler->AnketSoruEkle($anketid,$sorutip,$soru);
	if($anketsorueklendi=="anketsoruvar"){
	echo "Daha Önce Eklenmiş.";
	}elseif($anketsorueklendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='anketsoruduzenle'){
	$anketler = new Anket();
	$anketsoruduzenlendi = $anketler->AnketSoruDuzenle($anketsoruid,$anketid,$sorutip,$soru);
	if($anketsoruduzenlendi=="anketvar"){
	echo "Daha Önce Eklenmiş.";
	}elseif($anketsoruduzenlendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='quizekle'){
	$quizler = new Quiz();
	$quizeklendi = $quizler->QuizEkle($quizad,$dersid);
	if($quizeklendi=="quizvar"){
	echo "Daha Önce Eklenmiş.";
	}elseif($quizeklendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='quizduzenle'){
	$quizler = new Quiz();
	$quizeduzenlendi = $quizler->QuizDuzenle($quizid,$quizad,$dersid);
	if($quizeduzenlendi=="quizvar"){
	echo "Daha Önce Eklenmiş.";
	}elseif($quizeduzenlendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='quizsoruekle'){
	$quizler = new Quiz();
	$quizsorueklendi = $quizler->QuizSoruEkle($quizid,$soru);
	if($quizsorueklendi=="quizsoruvar"){
	echo "Daha Önce Eklenmiş.";
	}elseif($quizsorueklendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='quizsoruduzenle'){
	$quizler = new Quiz();
	$quizsoruduzenlendi = $quizler->QuizSoruDuzenle($quizsoruid,$soru);
	if($quizsoruduzenlendi=="quizsoruvar"){
	echo "Daha Önce Eklenmiş.";
	}elseif($quizsoruduzenlendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='quizcevapekle'){
	$quizler = new Quiz();
	$quizcevapeklendi = $quizler->QuizCevapEkle($quizid,$soruid,$cevap,$dy);
	if($quizcevapeklendi=="quizcevapvar"){
	echo "Daha Önce Eklenmiş.";
	}elseif($quizcevapeklendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='quizcevapduzenle'){
	$quizler = new Quiz();
	$quizcevapduzenlendi = $quizler->QuizCevapDuzenle($cevapid,$quizid,$soruid,$cevap,$dy);
	if($quizcevapduzenlendi=="quizsoruvar"){
	echo "Daha Önce Eklenmiş.";
	}elseif($quizcevapduzenlendi){
            echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}


if ($islem =='kullaniciekle'){
	$kullanicilar = new Kullanicilar();
	$islemok = $kullanicilar->KullaniciEkle($adsoyad,$email,$sifre,$telno,$birimid,$unvanid,$gorevid);
	if($islemok){
            echo "Kaydınız Başarı ile alınmıştır.";
        }else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='kullaniciduzenle'){
	$kullanicilar = new Kullanicilar();
	$islemok = $kullanicilar->KullaniciDuzenle($kullaniciid,$adsoyad,$email,$sifre,$telno,$birimid,$unvanid,$gorevid);
	if($islemok){
			echo "Kaydınız Başarı ile alınmıştır.";
		}
		else{
			echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='musteriekle'){
	$sinif = new Musteriler();
	$islemok = $sinif->MusteriEkle($musterikod,$musteriunvan,$grupkod,$ekgrupkod,$ilgilikisi,$vd,$vn,$telno,$adres,$aciklama);
	if($islemok){
            echo "Müşteri Kaydınız Başarı ile alınmıştır.";
        }else{
            echo "Müşteri Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='musteriduzenle'){
	$sinif = new Musteriler();
	$islemok = $sinif->MusteriDuzenle($musteriid,$musterikod,$musteriunvan,$grupkod,$ekgrupkod,$ilgilikisi,$vd,$vn,$telno,$adres,$aciklama);
	if($islemok){
            echo "Müşteri Kaydınız Başarı ile alınmıştır.";
        }else{
            echo "Müşteri Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='musterigrupekle'){
	$sinif = new Musteriler();
	$islemok = $sinif->MusteriGrupEkle($grupkod,$grupad);
	if($islemok){
            echo "Kaydınız Başarı ile alınmıştır.";
        }else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='musterigrupduzenle'){
	$sinif = new Musteriler();
	$islemok = $sinif->MusteriGrupDuzenle($grupkod,$grupad);
	if($islemok){
            echo "Kaydınız Başarı ile alınmıştır.";
        }else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='musteriekgrupekle'){
	$sinif = new Musteriler();
	$islemok = $sinif->MusteriEkGrupEkle($ekgrupkod,$ekgrupad);
	if($islemok){
            echo "Kaydınız Başarı ile alınmıştır.";
        }else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='musteriekgrupduzenle'){
	$sinif = new Musteriler();
	$islemok = $sinif->MusteriEkGrupDuzenle($ekgrupkod,$ekgrupad);
	if($islemok){
            echo "Kaydınız Başarı ile alınmıştır.";
        }else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='maildegistir'){
        $admin =new Admin();
	$guncelleme = $admin->MailDegistir($mail);
        if($guncelleme){
            echo "Güncelleme Başarılı";
        }else{
            echo "Teknik Bir Sorun Oluştu";
        }
}

if ($islem =='sifredegistir'){
    $admin = new Admin();
    $guncelleme = $admin->SifreDegistir($sifre);
    if($guncelleme){
        echo "Güncelleme Başarılı";
    }else{
        echo "Teknik Bir Sorun Oluştu";
    }
}

if ($islem =='olayekle'){
	$olaylar = new Olaylar();
	$olayeklendi = $olaylar->OlayEkle($bastarih,$bittarih,$olay);
	if($olayeklendi=="olayvar"){
		echo "Daha Önce Eklenmiş.";
	}elseif($olayeklendi){
	echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
	echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='olayduzenle'){
	$olaylar = new Olaylar();
	$olayduzenlendi = $olaylar->OlayDuzenle($olayid,$bastarih,$bittarih,$olay);
	if($olayduzenlendi=="olayvar"){
		echo "Daha Önce Eklenmiş.";
	}elseif($olayduzenlendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='projeekle'){
	$sinif = new Projeler();
	$projeeklendi = $sinif->ProjeEkle($sirketid,$projead);
	if($projeeklendi=="projevar"){
	echo "Daha Önce Eklenmiş.";
	}elseif($projeeklendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='projeduzenle'){
	$sinif = new Projeler();
	$projeduzenlendi = $sinif->ProjeDuzenle($projeid,$projead,$sirketid);
	if($projeduzenlendi=="secenekvar"){
		echo "Daha Önce Eklenmiş.";
	}elseif($projeduzenlendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='secenekekle'){
	$secenekler = new Secenek();
	$secenekeklendi = $secenekler->SecenekEkle($secenekad,$secenekbagid);
	if($secenekeklendi=="secenekvar"){
	echo "Birim Daha Önce Eklenmiş.";
	}elseif($secenekeklendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='secenekduzenle'){
	$secenekler = new Secenek();
	$secenekduzenlendi = $secenekler->SecenekDuzenle($secenekid,$secenekad,$secenekbagid);
	if($secenekduzenlendi=="secenekvar"){
		echo "Birim Daha Önce Eklenmiş.";
	}elseif($secenekduzenlendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='defterekle'){
	$class = new Defter();
	$classeklendi = $class->DefterKayitEkle($islemtip,$projeid,$tutar,$islemtarih,$islemaciklama,$detayaciklama);
	if($classeklendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='defterduzenle'){
	$class = new Defter();
	$classduzenlendi = $class->DefterKayitDuzenle($defterid,$islemtip,$projeid,$tutar,$islemtarih,$islemaciklama,$islemaciklama);
	if($classduzenlendi){
            echo "Kaydınız Başarı ile alınmıştır.";
	}else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}
if ($islem =='sirketekle'){
	$sinif = new Sirket();
	$sirketeklendi = $sinif->SirketEkle($sirketad);
	if($sirketeklendi=="zatenvar"){
	echo "Daha Önce Eklenmiş.";
	}elseif($sirketeklendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='sirketduzenle'){
    $sinif = new Sirket();
    $sirketduzenlendi = $sinif->SirketDuzenle($sirketid,$sirketad);
    if($sirketduzenlendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($sirketduzenlendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='referansekle'){
    $sinif = new Referanslar();
    $eklendi = $sinif->ReferansEkle($referansad,$aciklama);
    if($eklendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($eklendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='referansduzenle'){
    $duzenle = new Referanslar();
    $duzenlendi = $duzenle->ReferansDuzenle($referansad,$aciklama,$referansid);
    if($duzenlendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($duzenlendi==1){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='masaekle'){
    $sinif = new Masa();
    $eklendi = $sinif->MasaEkle($masaad,$aciklama);
    if($eklendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($eklendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='masaduzenle'){
    $duzenle = new Masa();
    $duzenlendi = $duzenle->MasaDuzenle($masaad,$masaid);
    if($duzenlendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($duzenlendi==1){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='kuryeekle'){
    $sinif = new Kurye();
    $eklendi = $sinif->KuryeEkle($kuryead,$aciklama);
    if($eklendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($eklendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='kuryeduzenle'){
    $duzenle = new Kurye();
    $duzenlendi = $duzenle->KuryeDuzenle($kuryead,$kuryeid);
    if($duzenlendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($duzenlendi==1){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='yaziekle'){
    $sinif = new Yazi();
    $eklendi = $sinif->YaziEkle($yaziad,serialize($yazidetay),$anahtarlar);
    if($eklendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($eklendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='yaziduzenle'){
    $duzenle = new Yazi();
    $duzenlendi = $duzenle->YaziDuzenle($yaziid,$yaziad,serialize($yazidetay),$anahtarlar);
    if($duzenlendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($duzenlendi==1){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='subeekle'){
    $sinif = new Sube();
    $eklendi = $sinif->SubeEkle($subead,ckeditor_temizle($subedetay));
    if($eklendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($eklendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='subeduzenle'){
    $duzenle = new Sube();
    $duzenlendi = $duzenle->SubeDuzenle($subeid,$subead,$subedetay);
    if($duzenlendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($duzenlendi==1){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}


if ($islem =='kayitekle'){
    $sinif = new Kayit();
    $eklendi = $sinif->KayitEkle($kayitad,ckeditor_temizle($kayitdetay),$anahtarlar);
    if($eklendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($eklendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='kayitduzenle'){
    $duzenle = new Kayit();
    $duzenlendi = $duzenle->KayitDuzenle($kayitid,$kayitad,ckeditor_temizle($kayitdetay),$anahtarlar);
    if($duzenlendi==1){
            echo "Kaydınız Başarı ile alınmıştır";
    }
    elseif($duzenlendi=="zatenvar"){
        echo "Kaydınız Daha Önce Eklenmiş";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu";
    }
}

if ($islem =='sosyalkayitekle'){
    $sinif = new SosyalMedya();
    $eklendi = $sinif->KayitEkle($kayitad,ckeditor_temizle($kayitdetay),$sosyalbaglanti,$anahtarlar);
    if($eklendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($eklendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='sosyalkayitduzenle'){
    
    $duzenle = new SosyalMedya();
    $duzenlendi = $duzenle->KayitDuzenle($kayitid,$kayitad,ckeditor_temizle($kayitdetay),$sosyalbaglanti,$anahtarlar);
    if($duzenlendi==1){
            echo "Kaydınız Başarı ile alınmıştır";
    }
    elseif($duzenlendi=="zatenvar"){
        echo "Kaydınız Daha Önce Eklenmiş";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu";
    }
}

if ($islem =='parametreekle'){
	$parametreler = new Parametreler();
	$parametreeklendi = $parametreler->ParametreEkle($paciklama,$deger);
	if($parametreeklendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='parametreduzenle'){
	$parametreler = new Parametreler();
	$parametreduzenlendi = $parametreler->ParametreDuzenle($parId,$deger);
	if($parametreduzenlendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='listebaslikekle'){
	$kayit = new Listeler();
	$kayiteklendi = $kayit->ListeBaslikEkle($lbaciklama);
	if($kayiteklendi){
          echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='listebaslikduzenle'){
	$listebasliklar = new Listeler();
	$listebaslikduzenlendi = $listebasliklar->ListeBaslikDuzenle($listebaslikId,$lbaciklama);
	if($listebaslikduzenlendi =="lbvar"){
		echo "Daha Önce Eklenmiş.";
	}elseif($listebaslikduzenlendi ){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='listedetayekle'){
	$listedetaylar = new Listeler();
	$listedetayeklendi = $listedetaylar->ListeDetayEkle($ldaciklama,$listebaslikId);
	if($listedetayeklendi=="ldvar"){
		echo "Daha Önce Eklenmiş.";
	}elseif($listedetayeklendi){
	echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
	echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='listedetayduzenle'){
	$listedetaylar = new Listeler();
	$listedetayduzenlendi = $listedetaylar->ListeDetayDuzenle($listedetayId,$ldaciklama,$listebaslikId);
	if($listedetayduzenlendi =="ldvar"){
		echo "Daha Önce Eklenmiş.";
	}elseif($listedetayduzenlendi ){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='bayiekle'){
	$sinif = new Bayiler();
	$sinifeklendi = $sinif->BayiEkle($bayikodu,$bayiadi,$bylogokucuk,$bylogobuyuk,$bylogoico,$sunucuadresi);
	if($sinifeklendi=="bayivar"){
                echo "Daha Önce Eklenmiş.";
	}elseif($sinifeklendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='bayiduzenle'){
    $sinif = new Bayiler();
    $sinifduzenlendi = $sinif->BayiDuzenle($bayiid,$bayikodu,$bayiadi,$bylogokucuk,$bylogobuyuk,$bylogoico,$sunucuadresi);
    if($sinifduzenlendi=="bayivar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($sinifduzenlendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='bayidetayekle'){
	$sinif = new Bayiler();
	$sinifeklendi = $sinif->BayiIslem($bayiid,$sabittel,$ceptel,$fax,$adres,$email,$www,$calsaathici,$calsaathsonu,$bizkimiz,$facebookadr,$twitteradr,$instagramadr,$detaybilgi,$anahtarkelimeler);
	if($sinifeklendi=="bayidetayvar"){
                echo "Daha Önce Eklenmiş.";
	}elseif($sinifeklendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='bayidetayduzenle'){
    $sinif = new Bayiler();
    $sinifduzenlendi = $sinif->BayiIslem($bayiid,$sabittel,$ceptel,$fax,$adres,$email,$www,$calsaathici,$calsaathsonu,$bizkimiz,$facebookadr,$twitteradr,$instagramadr,$detaybilgi,$anahtarkelimeler);
    if ($sinifduzenlendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='anahtarekle'){
	$anahtarlar = new Anahtarlar();
        if($ozel==""){
            $ozel=0;
        }
	$anahtareklendi = $anahtarlar->AnahtarEkle($anahtarad,$ozel,$grup);
	if($anahtareklendi=="anahtarvar"){
                echo "Daha Önce Eklenmiş.";
                //echo $anahtareklendi;
	}elseif($anahtareklendi){
		echo "Kaydınız Başarı ile alınmıştır.";
	}
	else{
		echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
	}
}

if ($islem =='anahtarduzenle'){
    $anahtarlar = new Anahtarlar();
    if($ozel==""){
        $ozel=0;
    }
    $anahtarduzenlendi = $anahtarlar->AnahtarDuzenle($anahtarid,$anahtarad,$ozel,$grup);
    if($anahtarduzenlendi=="anahtarvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($anahtarduzenlendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='urunekle'){
    $sinif = new Urun();
    $eklendi = $sinif->UrunEkle($urunkod,$urunad,$anahtarlar);
    if($eklendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($eklendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='urunduzenle'){
    $duzenle = new Urun();
    $duzenlendi = $duzenle->UrunDuzenle($urunkod,$urunad,$urunid,$anahtarlar);
    if($duzenlendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($duzenlendi==1){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='musterigrupekle'){
    $sinif = new Musteriler();
    $eklendi = $sinif->MusteriGrupEkle($grupkod,$grupad);
    if($eklendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($eklendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='musterigrupduzenle'){
    $sinif = new Musteriler();
    $eklendi = $sinif->MusteriGrupDuzenle($grupkod,$grupad,$eskigrupkod);
    if($eklendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($eklendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}


if ($islem =='adisyonekle'){
    $sinif = new Adisyon();
    $eklendi = $sinif->AdisyonEkle($masaid);
}

if ($islem =='PaketAdisyonEkle'){
    $sinif = new Adisyon();
    $eklendi = $sinif->PaketAdisyonEkle($kuryeid);
}

if ($islem =='adisyonkapat'){
    $iptal = new Adisyon();
    $kapatildi = $iptal->AdisyonKapat($adisyonid);
}

if ($islem =='adisyoniptal'){
    $iptal = new Adisyon();
    $iptaledildi = $iptal->AdisyonIptal($adisyonid);
}

if ($islem =='adisyonsil'){
    $class = new Adisyon();
    $durum = $class->AdisyonIptal($adisyonid);
     if($durum){
        echo "Adisyon Silindi";
    }
}

if ($islem =='adisyonduzenle'){
    $class = new Adisyon();
    $durum = $class->AdisyonDuzenle($adisyonid,$masaid);
    if($durum){
        echo "Adisyon Aktif Hale Getirildi";
    }
}

if ($islem =='PaketAdisyonDuzenle'){
    $class = new Adisyon();
    $durum = $class->PaketAdisyonDuzenle($adisyonid,$kuryeid);
    if($durum){
        echo "Paket Adisyon Güncellendi";
    }
}

if ($islem =='dersekle'){
    $sinif = new Dersler();
    $eklendi = $sinif->DersEkle($dersad);
    if($eklendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($eklendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='dersduzenle'){
    $duzenle = new Dersler();
    $duzenlendi = $duzenle->DersDuzenle($dersid,$dersad);
    if($duzenlendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($duzenlendi==1){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}


if ($islem =='soruekle'){
    $sinif = new Soru();
    $eklendi = $sinif->SoruEkle($aciklama,$quizid);
    if($eklendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($eklendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='soruduzenle'){
    $duzenle = new Soru();
    $duzenlendi = $duzenle->SoruDuzenle($aciklama,$quizid,$soruid);
    if($duzenlendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($duzenlendi==1){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='fiyatekle'){
    $sinif = new Fiyat();
    $eklendi = $sinif->FiyatEkle($aciklama,$urunid,$alisfiyat,$satisfiyat);
    if($eklendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($eklendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='fiyatduzenle'){
    $duzenle = new Fiyat();
    $duzenlendi = $duzenle->FiyatDuzenle($aciklama,$urunid,$alisfiyat,$satisfiyat,$fiyatid);
    if($duzenlendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($duzenlendi==1){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='cevapekle'){
    $sinif = new Cevap();
    $eklendi = $sinif->CevapEkle($aciklama,$soruid,$dogru);
    if($eklendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($eklendi){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='cevapduzenle'){
    $duzenle = new Cevap();
    $duzenlendi = $duzenle->CevapDuzenle($aciklama,$soruid,$dogru,$cevapid);
    if($duzenlendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($duzenlendi==1){
            echo "Kaydınız Başarı ile alınmıştır.";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='gorevekle'){
    $sinif = new Gorev();
    $eklendi = $sinif->GorevEkle($gorevad,ckeditor_temizle($gorevdetay),$kullanici,$tamam,$anahtarlar);
    $tamam = strpos($anahtarlar,'tamam');
    $kullanicilar = new Kullanicilar();
    $dkullanici= $kullanicilar->KullaniciGetir($kullanici);
    if($eklendi=="zatenvar"){
    echo "Daha Önce Eklenmiş.";
    }elseif($eklendi){
        echo "Kaydınız Başarı ile alınmıştır.";
        $sinif->GorevMailGonder($gorevad,ckeditor_temizle($gorevdetay),$dkullanici->adsoyad,$dkullanici->email,$tamam);
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu.";
    }
}

if ($islem =='gorevduzenle'){
    $duzenle = new Gorev();
    $duzenlendi = $duzenle->GorevDuzenle($gorevid,$gorevad,ckeditor_temizle($gorevdetay),$kullanici,$tamam,$anahtarlar);
    $tamam = strpos($anahtarlar,'tamam');
    if($duzenlendi==1){
            echo "Güncelleme Başarı ile alınmıştır";
            if($tamam=="1"){
                $duzenle->GorevMailGonder($gorevad,ckeditor_temizle($gorevdetay),$dkullanici->adsoyad,$dkullanici->email,$tamam);
            }
    }
    elseif($duzenlendi=="zatenvar"){
        echo "Kaydınız Daha Önce Eklenmiş";
    }
    else{
            echo "Kaydınız oluşturulurken teknik bir sorun oluştu";
    }
}
if($jqstokcek=="var"){
    echo $stokid;
    $list = new Stok();
    $dlist =$list->StokGetir($stokid);
    ob_clean();
    echo $dlist->stokkod ." - ". $dlist->stokad;
}
if($jqstokbirimcek=="var"){
    echo $stokid;
    $list = new Stok();
    $dlist =$list->StokGetir($stokid);
    ob_clean();
    echo $dlist->birim;
}
if($jqstokfiyatcek=="var"){
    echo $stokid;
    $list = new Stok();
    $dlist =$list->StokGetir($stokid);
    ob_clean();
    echo $dlist->birim;
}
if($jqstokkdvcek=="var"){
    echo $stokid;
    $list = new Stok();
    $dlist =$list->StokGetir($stokid);
    ob_clean();
    echo $dlist->kdvoran;
}

?>
