<style type="text/css">
#anketsoruislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
/*Anket Soru Form Validation Başladı*/
$(document.anketsoruislem).ready(function(){
$('#anketsoruislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var anketid=$('#anketid').val();
var anketsoruid=$('#anketsoruid').val();
var soru=$('#soru').val();
if(soru=="")
{
valid += 'Soru'+isr;
}
if (valid!='') {	
			$("#anketsoruislemdis").fadeIn("slow");
			$("#anketsoruislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='soru=' + soru + '&sorutip='+ $('#sorutip').val() + '&anketid='+ anketid;
			$("#anketsoruislemdis").css("display", "block");
			$("#anketsoruislemdis").html("Kaydınız Yapılıyor .... ");
			$("#anketsoruislemdis").fadeIn("slow");
			var islem =''
			if(anketsoruid==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&anketsoruid=' + anketsoruid;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("anketsorujqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Anket Soru  Form Validation Bitti*/


/*Anket Soru  JQuery Başladı*/
function anketsorujqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=anketsoruekle'}
	else{var islemurl='../islemler/islemler.php?islem=anketsoruduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#anketsoruislemdis").fadeIn("slow");
		$("#anketsoruislemdis").html(html);
		setTimeout('$("#anketsoruislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Anket Soru  JQuery Bitti*/
</script>
<div id="wrap">
<?php 
$form = new clsForms();

$parametreler = new Parametreler();
$listeler = new Listeler();
$danketsorutip = $parametreler->ParametreGetirA ( "anketsorutip" );
$danketlistesorutip = $listeler->listeDetayGetirC ( $danketsorutip->deger );
$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Anket Soru Ekle</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<?=$form->doHidden(array('anketid',$anketid));?>
<?=$form->doHidden(array('anketsoruid',0));?>
<tr>
	<td width='10%'>Durum:</td><td><?=$form->doSelect(array("sorutip","ldaciklama"),$danketlistesorutip)?></td>
</tr>
<tr>
	<td width='10%'>Soru:</td><td><?=$form->doTextAreaInput(array("soru"));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('anketsoruislem','Gönder'));?></td>
</tr>
<div id="anketsoruislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>