<?php
    $sayfaad="adminpanel.php?lx=defter.php";
    $sayfaadEkle="adminpanel.php?lx=defterform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=defterform.php&islem=duzenle";
    $kayitlar = new Defter();
    $forms = new clsForms();
    $kayitsayi =$kayitlar->DefterSayiBul();
    if($sil){$kayitlar-> DefterKayitSil($sil);}
    $sayfala =20;
    $search = $forms->doSearch(array("id","islemaciklama","islemtarih","tutar"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$kayitsayi->sayi,$sayfaad);
    $data = $kayitlar->DefterKayitlariniGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Açıklama",'30%'),array("Tarih",'%20'),array("Tutar",'%10'))
    ,array("id","islemaciklama","islemtarih","tutar")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenleid",$sayfaadDuzenle,"Düzenle"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$kayitsayi->sayi,$sayfaad);
?>