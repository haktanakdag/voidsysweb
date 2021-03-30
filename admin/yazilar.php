<?php
$_SESSION['refid']=$refid;
$_SESSION['resgrup']="yazilar";
?>
<script>
function resPopUp(refid) {
    window.open("../resimler/index.php?refid="+refid, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=800, height=600");
}
</script>
    <?php
    $sayfaad="adminpanel.php?lx=yazilar.php";
    $sayfaadEkle="adminpanel.php?lx=yaziform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=yaziform.php&islem=duzenle";
    $sayfaadResimler="adminpanel.php?lx=yazilar.php";
    $yazilar = new Yazi();
    $forms = new clsForms();
    $yazisayi =$yazilar->YaziSayiBul();
    if($sil){$yazilar-> YaziSil($sil);}
    $sayfala =20;
    $search = $forms->doSearch(array("id","yaziad"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$yazisayi->sayi,$sayfaad);
    $data = $yazilar->YazilariGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Yazi Ad",'40%'))
    ,array("id","yaziad")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenleid",$sayfaadDuzenle,"Düzenle"),array("refid",$sayfaadResimler,"Resimler","resPopUp(#)"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$yazisayi->sayi,$sayfaad);
?>