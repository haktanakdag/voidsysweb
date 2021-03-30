<?php
$_SESSION['kuryeid']=$kuryeid;
?>
<?php
    $sayfaad="adminpanel.php?lx=kuryeler.php";
    $sayfaadEkle="adminpanel.php?lx=kuryeform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=kuryeform.php&islem=duzenle";
    $kuryeler = new Kurye();
    $forms = new clsForms();
    $kuryesayi =$kuryeler->KuryeSayiBul();
    if($sil){$kuryeler-> KuryeSil($sil);}
    $sayfala =20;
    $search = $forms->doSearch(array("id","kuryead"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$kuryesayi->sayi,$sayfaad);
    $data = $kuryeler->KuryeleriGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Ders Ad",'30%'))
    ,array("id","kuryead")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenleid",$sayfaadDuzenle,"Düzenle"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$kuryesayi->sayi,$sayfaad);
?>