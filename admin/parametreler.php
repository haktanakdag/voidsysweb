<?php
    $sayfaad="adminpanel.php?lx=parametreler.php";
    $sayfaadEkle="adminpanel.php?lx=parametreform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=parametreform.php&islem=duzenle";
    $parametreler = new Parametreler();
    $forms = new clsForms();
    $parametresayi =$parametreler->ParametreSayiBul();
    $sayfala =50;
    $search = $forms->doSearch(array("id","paciklama","deger"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$parametresayi->sayi,$sayfaad);
    $data = $parametreler->ParametreleriGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Parametre Açıklama",'35%'),array("Değer",'35%'))
    ,array("id","paciklama","deger")
    ,$data
    ,array(array("duzenle",$sayfaadDuzenle,"Düzenle"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$parametresayi->sayi,$sayfaad);
?>