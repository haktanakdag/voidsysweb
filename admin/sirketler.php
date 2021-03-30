<?php
    $sayfaad="adminpanel.php?lx=sirketler.php";
    $sayfaadEkle="adminpanel.php?lx=sirketform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=sirketform.php&islem=duzenle";
    $sirketler = new Sirket();
    $forms = new clsForms();
    $sirketsayi =$sirketler->SirketSayiBul();
    if($sil){$sirketler-> SirketSil($sil);}
    $sayfala =10;
    $search = $forms->doSearch(array("id","sirketad"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$sirketsayi->sayi,$sayfaad);
    $data = $sirketler->SirketleriGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Şirket Ad",'70%'))
    ,array("id","sirketad")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$sirketsayi->sayi,$sayfaad);
?>