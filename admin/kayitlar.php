<?php
$_SESSION['refid']=$refid;
$_SESSION['resgrup']="kayitlar";
?>
<script>
function resPopUp(refid) {
    window.open("../resimler/index.php?refid="+refid, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=800, height=600");
}
</script>
    <?php
    $sayfaad="adminpanel.php?lx=kayitlar.php";
    $sayfaadEkle="adminpanel.php?lx=kayitform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=kayitform.php&islem=duzenle";
    $sayfaadResimler="adminpanel.php?lx=kayitlar.php";
    $kayitlar = new Kayit();
    $forms = new clsForms();
    $kayitsayi =$kayitlar->KayitSayiBul();
    if($sil){$kayitlar-> KayitSil($sil);}
    $sayfala =20;
    $search = $forms->doSearch(array("id","kayitad"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$kayitsayi->sayi,$sayfaad);
    $data = $kayitlar->KayitlariGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Kayit Ad",'40%'))
    ,array("id","kayitad")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenleid",$sayfaadDuzenle,"Düzenle"),array("refid",$sayfaadResimler,"Resimler","resPopUp(#)"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$kayitsayi->sayi,$sayfaad);
?>