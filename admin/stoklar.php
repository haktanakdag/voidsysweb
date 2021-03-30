<?php
$_SESSION['refid']=$refid;
$_SESSION['resgrup']="stoklar";
?>
<script>
function resPopUp(refid) {
    window.open("../resimler/stoklar/index.php?refid="+refid, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=800, height=600");
}
</script>
<script>
function topluAktar() {
window.open('../excelimport/stokimport.php', '_blank', 'toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=800, height=600');
}
</script>
    <?php
    $sayfaad="adminpanel.php?lx=stoklar.php";
    $sayfaadEkle="adminpanel.php?lx=stokform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=stokform.php&islem=duzenle";
    $sayfaadResimler="adminpanel.php?lx=stoklar.php";
    $sayfaadicerial="adminpanel.php?lx=stoklar.php";
    $sayfaadyenile="adminpanel.php?lx=stoklar.php";
    $stoklar = new Stok();
    $forms = new clsForms();
    $stoksayi =$stoklar->StokSayiBul();
    if($sil){$stoklar-> StokSil($sil);}
    $sayfala =20;
    $search = $forms->doSearch(array("id","stokad"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$stoksayi->sayi,$sayfaad);
    $data = $stoklar->stoklariGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    //$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doBaglanti(array('iceriaktar','İçeri Aktar',$sayfaadicerial,"","","topluAktar()"));
    $forms->doBaglanti(array('yenile','Yenile',$sayfaadyenile,"",""));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("stok Ad",'40%'))
    ,array("id","stokad")
    ,$data
    ,array(array("sil",$sayfaad,"Sil")
    //,array("duzenleid",$sayfaadDuzenle,"Düzenle")
    //,array("refid",$sayfaadResimler,"Resimler","resPopUp(#)")
          )
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$stoksayi->sayi,$sayfaad);
?>