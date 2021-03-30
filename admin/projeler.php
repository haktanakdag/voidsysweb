<?php   
    $sayfaad="adminpanel.php?lx=projeler.php";
    $sayfaadEkle="adminpanel.php?lx=projelerform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=projelerform.php&islem=duzenle";
    $projeler = new Projeler();
    if($sil){$projeler->ProjeSil($sil);}
    $forms = new clsForms();
    $projesayi =$projeler->ProjeSayiBul();
    $sayfala =10;
    $search = $forms->doSearch(array("id","projead"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$projesayi->sayi,$sayfaad);
    $kullanicilar = $projeler->ProjeleriGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Proje Ad",'40%'))
    ,array("id","projead")
    ,$kullanicilar
    ,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$projesayi->sayi,$sayfaad);
?>