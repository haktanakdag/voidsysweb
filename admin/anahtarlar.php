<?php
$_SESSION['refid']=$refid;
?>
<script>
function resPopUp(refid) {
    window.open("../resimler_anahtar/index.php?refid="+refid, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=800, height=600");
}
</script>
<?php
$sayfaad="adminpanel.php?lx=anahtarlar.php";
$sayfaadEkle="adminpanel.php?lx=anahtarform.php&islem=ekle";
$sayfaadDuzenle="adminpanel.php?lx=anahtarform.php&islem=duzenle";
$sayfaadResimler="adminpanel.php?lx=anahtarlar.php";
$anahtarlar = new Anahtarlar();
$forms = new clsForms();
$anahtarsayi =$anahtarlar->AnahtarSayiBul();
if($sil){$anahtarlar-> AnahtarSil($sil);}
$sayfala =20;
$search = $forms->doSearch(array("id","anahtarad","grup"),$txtara);
$pagerString=$forms->doPager($sayfala ,$sayfano,$anahtarsayi->sayi,$sayfaad);
$data = $anahtarlar->AnahtarlariGetir($pagerString,$search);
$forms->doform(array('basla','arama',$sayfaad));
$forms->doInput(array('txtara',$txtara));
$forms->doButton(array('ara','Ara'));
$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
$forms->doform(array('bitir'));
$forms->doGrid(
array(array("No",'10%'),array("Anahtar Ad",'55%'),array("Grup",'10%'))
,array("id","anahtarad","grup")
,$data
,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"),array("refid",$sayfaadResimler,"Resimler","resPopUp(#)"))
,"gridTable"
);
$pagerString=$forms->doPager($sayfala ,$sayfano,$anahtarsayi->sayi,$sayfaad);
/*  */
?>