<?php
$_SESSION['refid']=$refid;
?>
<script>
function resPopUp(refid) {
    window.open("../referanslar/index.php?refid="+refid, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=800, height=600");
}
</script>
<?php
    $sayfaad="adminpanel.php?lx=referanslar.php";
    $sayfaadEkle="adminpanel.php?lx=referansekle.php";
    $sayfaadDuzenle="adminpanel.php?lx=referansduzenle.php";
    $sayfaadResimler="adminpanel.php?lx=referanslar.php";
    $referanslar = new Referanslar();
    $forms = new clsForms();
    $referanssayi =$referanslar->ReferansSayiBul();
    if($sil){$referanslar->ReferansSil($sil);}
    $sayfala =10;
    $search = $forms->doSearch(array("id","referansad"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$referanssayi->sayi,$sayfaad);
    $data = $referanslar->ReferanslariGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Referans Ad",'40%'))
    ,array("id","referansad")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"),array("refid",$sayfaadResimler,"Resimler","resPopUp(#)"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$referanssayi->sayi,$sayfaad);
?>

