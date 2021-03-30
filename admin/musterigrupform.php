<style type="text/css">
#musterigrupislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.musterigrupislem).ready(function(){
$('#musterigrupislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var eskigrupkod =$('eskigrupkod').val();
var grupkod=$('#musterigrupkod').val();
var grupad=$('#musterigrupad').val();

if(grupkod=="")
{
valid += 'MusteriGrupKod '+isr;
}

if (valid!='') {	
    $("#musterigrupislemdis").fadeIn("slow");
    $("#musterigrupislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='grupkod=' + grupkod+'&grupad=' + grupad;
    $("#musterigrupislemdis").css("display", "block");
    $("#musterigrupislemdis").html("Kaydınız Yapılıyor .... ");
    $("#musterigrupislemdis").fadeIn("slow");
    var islem =''
    if(eskigrupkod==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&eskigrupkod=' + eskigrupkod;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("musterigrupjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function musterigrupjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=musterigrupekle'}
	else{var islemurl='../islemler/islemler.php?islem=musterigrupduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#musterigrupislemdis").fadeIn("slow");
		$("#musterigrupislemdis").html(html);
		//setTimeout('$("#musterigrupislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$form = new clsForms();

if($islem=='duzenle'){
    $data = new Musteriler();
    $ddata =$data->MusteriGrupGetir($duzenleid);
}else{
    $duzenleid=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('musterigruplar','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Urun İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('eskigrupkod',$duzenleid));?>
	<td width='20%'>Müşteri Grup Kod:</td><td><?=$form->doInput(array('grupkod',$ddata->grupkod));?></td>
</tr>
<tr>
	<td width='20%'>Müşteri Grup Ad:</td><td><?=$form->doInput(array('grupad',$ddata->grupad));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('musterigrupislem','Gönder'));?></td>
</tr>
<div id="musterigrupislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>