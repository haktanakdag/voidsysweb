<script>
function resPopUp(anketid) {
    window.open("anketuygula.php?anketid="+anketid, "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=800, left=600, width=800, height=600");
}
</script>
<?php
$sayfaad="index.php?lx=anketuygula.php";
$sayfaadAnketSorular="adminpanel.php?lx=anketsorular.php";
$anketuygula="#";

$anketler = new Anket();
$forms = new clsForms();
$anketsayi =$anketler->AnketSayiBul();
if($sil){$anketler-> AnketSil($sil);}
$sayfala =10;
$search = $forms->doSearch(array("id","anketad"),$txtara);
$pagerString=$forms->doPager($sayfala ,$sayfano,$anketsayi->sayi,$sayfaad);
$data = $anketler->AnketleriGetir($pagerString,$search);
$forms->doform(array('basla','arama',$sayfaad));
$forms->doInput(array('txtara',$txtara));
$forms->doButton(array('ara','Ara'));
$forms->doform(array('bitir'));
$forms->doGrid(
array(array("No",'5%'),array("Anket Ad",'50%'))
,array("id","anketad")
,$data
,array(array("anketid",$anketuygula,"Anket Uygula","resPopUp(#)"))
,"gridTable"
);
$pagerString=$forms->doPager($sayfala ,$sayfano,$anketsayi->sayi,$sayfaad);
?>
