<?php
$_SESSION['refid']=$refid;
$_SESSION['resgrup']="subeler";
?>
<script>
function resPopUp(refid) {
    window.open("../resimler/index.php?refid="+refid, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=800, height=600");
}
</script>
    <?php
    $sayfaad="adminpanel.php?lx=subeler.php";
    $sayfaadEkle="adminpanel.php?lx=subeform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=subeform.php&islem=duzenle";
    $sayfaadResimler="adminpanel.php?lx=subeler.php";
    $subeler = new Sube();
    $forms = new clsForms();
    $subesayi =$subeler->SubeSayiBul();
    if($sil){$subeler-> SubeSil($sil);}
    $sayfala =20;
    $search = $forms->doSearch(array("id","subead"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$subesayi->sayi,$sayfaad);
    $data = $subeler->SubeleriGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Sube Ad",'40%'))
    ,array("id","subead")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenleid",$sayfaadDuzenle,"Düzenle"),array("refid",$sayfaadResimler,"Resimler","resPopUp(#)"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$subesayi->sayi,$sayfaad);
?>