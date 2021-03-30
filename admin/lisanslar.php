<?php
    $sayfaad="adminpanel.php?lx=lisanslar.php";
    $sayfaadEkle="adminpanel.php?lx=lisansform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=lisansform.php&islem=duzenle";
    $sayfaadResimler="adminpanel.php?lx=lisanslar.php";
    $lisanslar = new Lisans();
    $forms = new clsForms();
    $lisanssayi =$lisanslar->LisansSayiBul();
    if($sil){$lisanslar-> LisansSil($sil);}
    $sayfala =20;
    $search = $forms->doSearch(array("id","lisansad"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$lisanssayi->sayi,$sayfaad);
    $data = $lisanslar->LisanslariGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Uygulama",'40%'),array("Müşteri Numarası",'40%'),array("Bilgisayar",'40%'))
    ,array("id","uygulama","musterinumarasi","bilgisayar")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenleid",$sayfaadDuzenle,"Düzenle"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$lisanssayi->sayi,$sayfaad);
?>