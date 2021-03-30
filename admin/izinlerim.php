<?php
    $sayfaad="adminpanel.php?lx=izinlerim.php";
    $sayfaadEkle="adminpanel.php?lx=izinform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=izinform.php&islem=duzenle";
    $anahtarlar = new Anahtarlar();
    $forms = new clsForms();
    $anahtarsayi =$anahtarlar->AnahtarSayiBul();
    if($sil){$anahtarlar-> AnahtarSil($sil);}
    $sayfala =10;
    $search = $forms->doSearch(array("id","anahtarad"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$anahtarsayi->sayi,$sayfaad);
    $data = $anahtarlar->AnahtarlariGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Anahtar Ad",'70%'))
    ,array("id","anahtarad")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$anahtarsayi->sayi,$sayfaad);
    /*  */
?>