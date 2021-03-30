<style type="text/css">
#secenekislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
// JavaScript Document
/*Secenek Ekle Form Validation Başladı*/
$(document.secenekislem).ready(function(){
$('#secenekislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var secenekid=$('#secenekid').val();
var secenekad=$('#secenekad').val();
if(secenekad=="")
{
valid += 'Secenek Ad'+isr;
}
if (valid!='') {	
			$("#secenekislemdis").fadeIn("slow");
			$("#secenekislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='secenekad=' + secenekad + '&secenekbagid=' +$('#secenekbagid').val();
			$("#secenekislemdis").css("display", "block");
			$("#secenekislemdis").html("Kaydınız Yapılıyor .... ");
			$("#secenekislemdis").fadeIn("slow");
			var islem =''
			if(secenekid==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&secenekid=' + secenekid;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("secenekjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Secenek Ekle Form Validation Bitti*/


/*Secenek Ekle JQuery Başladı*/
function secenekjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=secenekekle'}
	else{var islemurl='../islemler/islemler.php?islem=secenekduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#secenekislemdis").fadeIn("slow");
		$("#secenekislemdis").html(html);
		//setTimeout('$("#secenekislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Secenek Ekle JQuery Bitti*/
</script>
<div id="wrap">
<?php 
$secenekler= new Secenek();
$dsecenek =$secenekler->SecenekGetir($duzenle);
$data = $secenekler->SecenekleriGetir();
$form = new clsForms();
$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('secenekler','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Secenek Form</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('secenekid',$dsecenek->id));?>
	<td width='10%'>Secenek Ad:</td><td><?=$form->doInput(array('secenekad',$dsecenek->secenekad));?></td>
</tr>
<tr>
	<td width='10%'>Bağlı olduğu secenek:</td><td><?php $form->doSelect(array('secenekbagid','secenekad',$dsecenek->secenekbagid),$data); ?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('secenekislem','Gönder'));?></td>
</tr>
<div id="secenekislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>