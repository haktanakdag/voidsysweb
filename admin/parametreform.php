<style type="text/css">
#parametreislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
/*Parametre Form Validation Başladı*/
$(document.parametreislem).ready(function(){
$('#parametreislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var parId=$('#parId').val();
var pdeger=$('#deger').val();
if(pdeger=="")
{
valid += 'Değer'+isr;
}
if (valid!='') {	
			$("#parametreislemdis").fadeIn("slow");
			$("#parametreislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='deger=' + pdeger + '&paciklama=' + $('#paciklama').val();
			$("#parametreislemdis").css("display", "block");
			$("#parametreislemdis").html("Kaydınız Yapılıyor .... ");
			$("#parametreislemdis").fadeIn("slow");
			var islem =''
			if(parId==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&parId=' + parId;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("parametrejqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Parametre Form Validation Bitti*/


/*parametre JQuery Başladı*/
function parametrejqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=parametreekle'}
	else{var islemurl='../islemler/islemler.php?islem=parametreduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#parametreislemdis").fadeIn("slow");
		$("#parametreislemdis").html(html);
		setTimeout('$("#parametreislemdis").fadeOut("slow")',2000);
	}
	});
}
</script>
<div id="wrap">
<?php 
if($islem=="duzenle"){
$parametreler = new Parametreler();
$dparametre =$parametreler->ParametreGetir($duzenle);
}
$form = new clsForms();
$form->doForm(array('basla'));
?>
<?php 
$form = new clsForms();

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('parametreler','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Parametre Ekle</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('parId',$dparametre->id));?>
    <td width='10%'>Parametre Ad:</td><td><?=$form->doInput(array('paciklama',$dparametre->paciklama));?></td>
</tr>
<tr>
    <td width='10%'>Değer:</td><td><?=$form->doInput(array('deger',$dparametre->deger));?></td>
</tr>
<tr>
    <td colspan='2' align='left'><?=$form->doButton(array('parametreislem','Gönder'));?></td>
</tr>
<div id="parametreislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>