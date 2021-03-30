<?php
    $sayfaad="adminpanel.php?lx=musterigruplar.php";
    $sayfaadEkle="adminpanel.php?lx=musterigrupform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=musterigrupform.php&islem=duzenle";
    $sayfaadResimler="adminpanel.php?lx=musterigruplar.php";
    $musteriler = new Musteriler();
    $forms = new clsForms();
    $musterigrupsayi =$musteriler->MusteriGrupSayiBul();
    if($sil){$musteriler-> MusteriGrupSil($sil);}
    $sayfala =20;
    $search = $forms->doSearch(array("grupkod","grupad"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$musterigrupsayi->sayi,$sayfaad);
    $data = $musteriler->MusteriGrupGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("GrupKod",'10%'),array("GrupAd",'40%'))
    ,array("grupkod","grupad")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenleid",$sayfaadDuzenle,"Düzenle"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$urunsayi->sayi,$sayfaad);
?>