<?php
$_SESSION['masaid']=$masaid;
?>
<script>
function QRPopUp(masaid) {
    window.open("../qrmenu/qrbarkodolustur.php?masaid="+masaid, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=800, height=600");
}
</script>
<?php
    $sayfaad="adminpanel.php?lx=masalar.php";
    $sayfaadEkle="adminpanel.php?lx=masaform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=masaform.php&islem=duzenle";
    $sayfaadQrCode="adminpanel.php?lx=../qrmenu/qrbarkodolustur.php";
    $masalar = new Masa();
    $forms = new clsForms();
    $masasayi =$masalar->MasaSayiBul();
    if($sil){$masalar-> MasaSil($sil);}
    $sayfala =20;
    $search = $forms->doSearch(array("id","masaad"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$masasayi->sayi,$sayfaad);
    $data = $masalar->MasalariGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    $forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Ders Ad",'30%'))
    ,array("id","masaad")
    ,$data
    ,array(array("sil",$sayfaad,"Sil"),array("duzenleid",$sayfaadDuzenle,"Düzenle"),array("masaid",$sayfaad,"QR Oluştur","QRPopUp(#)"))
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$masasayi->sayi,$sayfaad);
?>