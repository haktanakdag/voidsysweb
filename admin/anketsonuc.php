
<?php
$form = new clsForms ( );
$raporlar = new Raporlar ( );
$raporad = "rpt_anketsonuc";
$wherestr = "";
if ($anketid) {
	$wherestr = "id=$anketid";
}
//$form->doBaglanti ( array ("export", "Excel Export", "../dissistem/excelexport.php?export=1&raporad=$raporad&wherestr=$wherestr" ) );
?>
<div id="scroll" style="overflow:scroll; height:100%;  width:85%;">
<?php
echo $raporlar->RaporOlustur ( $raporad, $wherestr );
?>
 </div>