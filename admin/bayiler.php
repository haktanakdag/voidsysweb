<?php
$_SESSION['refid']=$refid;
$_SESSION['resgrup']="bayiler";
?>
<script>
function resPopUp(refid) {
    window.open("../resimler/index.php?refid="+refid, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=800, height=600");
}
</script>
<?php
$sayfaad="adminpanel.php?lx=bayiler.php";
$sayfaadOlaylar = "adminpanel.php?lx=bayiolaylar.php";
$sayfaadKayitlar = "adminpanel.php?lx=bayikayitlar.php";
$sayfaadYazilar = "adminpanel.php?lx=bayiyazilar.php";
$sayfaadDetaylar = "adminpanel.php?lx=bayidetayform.php";
$sayfaadEkle="adminpanel.php?lx=bayiform.php&islem=ekle";
$sayfaadDuzenle="adminpanel.php?lx=bayiform.php&islem=duzenle";
$sayfaadResimler="adminpanel.php?lx=bayiler.php";
$bayiler = new Bayiler();
$forms = new clsForms();
$bayisayi =$bayiler->BayiSayiBul();
if($sil){$bayiler-> BayiSil($sil);}
$sayfala =20;
$search = $forms->doSearch(array("id","bayikodu","bayiadi"),$txtara);
$pagerString=$forms->doPager($sayfala ,$sayfano,$bayisayi->sayi,$sayfaad);
$data = $bayiler->BayileriGetir($pagerString,$search);
$forms->doform(array('basla','arama',$sayfaad));
$forms->doInput(array('txtara',$txtara));
$forms->doButton(array('ara','Ara'));
$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
$forms->doform(array('bitir'));
$forms->doGrid(
array(array("No",'1%'),array("Bayi Kodu",'2%'),array("Bayi Adı",'10%'))
,array("id","bayikodu","bayiadi")
,$data
,array(array("bayidetaylar",$sayfaadDetaylar,"Bayi Detaylar"),array("bayiolaylar",$sayfaadOlaylar,"Haberler/Duyurular"),array("bayiurunler",$sayfaadKayitlar,"Ürünler"),array("bayikampanyalar",$sayfaadYazilar,"Bayi Kampanyalar"),array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"),array("refid",$sayfaadResimler,"Resimler","resPopUp(#)"))
,"gridTable"
);
$pagerString=$forms->doPager($sayfala ,$sayfano,$bayisayi->sayi,$sayfaad);
/*  */
?>