<?php
$_SESSION['refid']=$refid;
$_SESSION['resgrup']="olaylar";
?>
<script>
function resPopUp(refid) {
    window.open("../resimler/index.php?refid="+refid, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=800, height=600");
}
</script>
<?php
	$sayfaad="adminpanel.php?lx=olaylar.php";
	$sayfaadEkle="adminpanel.php?lx=olayform.php&islem=ekle";
	$sayfaadDuzenle="adminpanel.php?lx=olayform.php&islem=duzenle";
        $sayfaadResimler="adminpanel.php?lx=olaylar.php";
	$olaylar = new Olaylar();
	if($sil){$olaylar-> OlaySil($sil);}
	$forms = new clsForms();
	$olaysayi =$olaylar->OlaySayiBul();
	$sayfala =10;
	$search = $forms->doSearch(array("id","olay","bastarih","bittarih"),$txtara);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$olaysayi->sayi,$sayfaad);
	$data = $olaylar->OlaylariGetir($pagerString,$search);
	$forms->doform(array('basla','arama',$sayfaad));
	$forms->doInput(array('txtara',$txtara));
	$forms->doButton(array('ara','Ara'));
	$forms->doBaglanti(array('yeniekle','Yeni Ekle',$sayfaadEkle));
	$forms->doform(array('bitir'));
	$forms->doGrid(
	array(array("No",'10%'),array("Olay",'30%'),array("bastarih",'10%'),array("bittarih",'10%'))
	,array("id","olay","bastarih","bittarih")
	,$data
	,array(array("sil",$sayfaad,"Sil"),array("duzenle",$sayfaadDuzenle,"Düzenle"),array("refid",$sayfaadResimler,"Resimler","resPopUp(#)"))
	,"gridTable"
	);
	$pagerString=$forms->doPager($sayfala ,$sayfano,$olaysayi->sayi,$sayfaad);
?>