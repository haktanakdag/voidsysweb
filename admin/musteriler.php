<script>
function topluAktar() {
window.open('../excelimport/musteriimport.php', '_blank', 'toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=800, height=600');
}
</script>
<?php
    $sayfaad="adminpanel.php?lx=musteriler.php";
    $sayfaadEkle="adminpanel.php?lx=musteriform.php&islem=ekle";
    $sayfaadDuzenle="adminpanel.php?lx=musteriform.php&islem=duzenle";
    $sayfaadicerial="adminpanel.php?lx=musteriler.php";
    $sayfaadyenile="adminpanel.php?lx=musteriler.php";
    $musteriler = new Musteriler();
    $forms = new clsForms();
    $musterisayi =$musteriler->MusteriSayiBul();
    if($sil){$musteriler-> MusteriSil($sil);}
    $sayfala =20;
    $search = $forms->doSearch(array("id","musterikod","musteriunvan"),$txtara);
    $pagerString=$forms->doPager($sayfala ,$sayfano,$musterisayi->sayi,$sayfaad);
    $data = $musteriler->MusterileriGetir($pagerString,$search);
    $forms->doform(array('basla','arama',$sayfaad));
    $forms->doInput(array('txtara',$txtara));
    $forms->doButton(array('ara','Ara'));
    //$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
    $forms->doBaglanti(array('iceriaktar','İçeri Aktar',$sayfaadicerial,"","","topluAktar()"));
    $forms->doBaglanti(array('yenile','Yenile',$sayfaadyenile,"",""));
    $forms->doform(array('bitir'));
    $forms->doGrid(
    array(array("No",'10%'),array("Musteri Kod",'20%'),array("Musteri Unvan",'40%'))
    ,array("id","musterikod","musteriunvan")
    ,$data
    ,array(array("sil",$sayfaad,"Sil")
    //,array("duzenleid",$sayfaadDuzenle,"Düzenle")
    )
    ,"gridTable"
    );
    $pagerString=$forms->doPager($sayfala ,$sayfano,$kayitsayi->sayi,$sayfaad);
?>