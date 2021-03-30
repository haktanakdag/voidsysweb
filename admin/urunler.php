<?php
$_SESSION['refid']=$refid;
$_SESSION['resgrup']="urunler";
?>
<script>
function resPopUp(refid) {
    window.open("../resimler/index.php?refid="+refid, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=800, height=600");
}
</script>
<?php
    $sayfaad="adminpanel.php?lx=urunler.php";
    $sayfaadEkle="adminpanel.php?lx=urunform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=urunform.php&islem=duzenle";
    $sayfaadResimler="adminpanel.php?lx=urunler.php";
    $urunler = new Urun();
    $forms = new clsForms();
    $urunsayi =$urunler->UrunSayiBul();
    if($sil){$urunler-> UrunSil($sil);}
    $sayfala =20;
    $search = $forms->doSearch(array("id","urunad"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$urunsayi->sayi,$sayfaad);
    $data = $urunler->UrunleriGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Urun Kod",'20%'),array("Urun Ad",'40%'))
    ,array("id","urunkod","urunad")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenleid",$sayfaadDuzenle,"Düzenle"),array("refid",$sayfaadResimler,"Resimler","resPopUp(#)"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$urunsayi->sayi,$sayfaad);
?>