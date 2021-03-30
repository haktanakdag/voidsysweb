<?php
    $sayfaad="adminpanel.php?lx=anketler.php";
    $sayfaadEkle="adminpanel.php?lx=anketform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=anketform.php&islem=duzenle";
    $sayfaadAnketSorular="adminpanel.php?lx=anketsorular.php";
    $sayfaadAnketSoruEkle="adminpanel.php?lx=anketsoruform.php&islem=ekle";
    $anketsonuc="adminpanel.php?lx=anketsonuc.php";
    $anketler = new Anket();
    $forms = new clsForms();
    $anketsayi =$anketler->AnketSayiBul();
    if($sil){$anketler-> AnketSil($sil);}
    if($cevaplarisil){$anketler-> AnketCevaplariSil($cevaplarisil);}
    $sayfala =10;
    $search = $forms->doSearch(array("id","anketad"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$anketsayi->sayi,$sayfaad);
    $data = $anketler->AnketleriGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'1%'),array("Anket Ad",'10%'))
    ,array("id","anketad")
    ,$data
    ,array(array("sil",$sayfaad,"Sil")
          ,array("cevaplarisil",$sayfaad,"Cevapları Sil")
          ,array("duzenle",$sayfaadDuzenle,"Düzenle")
          ,array("anketid",$sayfaadAnketSorular,"Sorular")
          ,array("anketid",$sayfaadAnketSoruEkle,"Soru Ekle")
          ,array("anketid",$anketsonuc,"Anket Sonuç"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$anketsayi->sayi,$sayfaad);
?>