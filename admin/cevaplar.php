<?php
    $sayfaad="adminpanel.php?lx=cevaplar.php";
    $sayfaadEkle="adminpanel.php?lx=cevapform.php&islem=ekle&soruid=$soruid";
    $sayfaadDuzenle="adminpanel.php?lx=cevapform.php&islem=duzenle";
    $cevaplar = new Cevap();
    $forms = new clsForms();
    $cevapsayi =$cevaplar->CevapSayiBul();
    if($sil){$cevaplar-> CevapSil($sil);}
    $sayfala =10;
    $search = $forms->doSearch(array("id","cevap"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$cevapsayi->sayi,$sayfaad);
    $search =$search." and soruid=$soruid";
    $data = $cevaplar->CevaplariGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Cevap",'70%'),array("DY",'%5'))
    ,array("id","cevap","DY")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenleid",$sayfaadDuzenle,"Düzenle"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$cevapsayi->sayi,$sayfaad);
?>