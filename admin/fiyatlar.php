<?php
    $sayfaad="adminpanel.php?lx=fiyatlar.php";
    $sayfaadEkle="adminpanel.php?lx=fiyatform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=fiyatform.php&islem=duzenle";
    $fiyatlar = new Fiyat();
    $forms = new clsForms();
    $fiyatsayi =$fiyatlar->FiyatSayiBul();
    if($sil){$fiyatlar-> FiyatSil($sil);}
    $sayfala =10;
    $search = $forms->doSearch(array("id","aciklama"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$fiyatsayi->sayi,$sayfaad);
    $data = $fiyatlar->FiyatlariGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Fiyat",'40%'))
    ,array("id","aciklama")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenleid",$sayfaadDuzenle,"Düzenle"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$fiyatsayi->sayi,$sayfaad);
?>