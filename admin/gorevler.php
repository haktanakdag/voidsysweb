<?php
$_SESSION['refid']=$refid;
?>
<script>
function resPopUp(refid) {
    window.open("../resimler/index.php?refid="+refid, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=800, height=600");
}
</script>
    <?php
    $sayfaad="adminpanel.php?lx=gorevler.php";
    $sayfaadEkle="adminpanel.php?lx=gorevform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=gorevform.php&islem=duzenle";
    $sayfaadResimler="adminpanel.php?lx=gorevler.php";
    $gorevler = new Gorev();
    $forms = new clsForms();
    $gorevsayi =$gorevler->GorevSayiBul();
    if($sil){$gorevler-> GorevSil($sil);}
    $sayfala =20;
    $search = $forms->doSearch(array("id","gorevad","kullanici"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$gorevsayi->sayi,$sayfaad);
    $data = $gorevler->GorevleriGetir($pagerString,$search);
    //print_r($data); 
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Kayit",'25%'),array("Durum",'5%'),array("Kullanıcı",'20%'))
    ,array("id","gorevad","durum","kullanici")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenleid",$sayfaadDuzenle,"Düzenle"),array("refid",$sayfaadResimler,"Resimler","resPopUp(#)"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$gorevsayi->sayi,$sayfaad);
    
?>