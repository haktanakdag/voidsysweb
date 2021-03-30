<style type="text/css">
#projeislemdis {
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
$(document.projeislem).ready(function(){
$('#projeislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var projeid=$('#projeid').val();
var projead=$('#projead').val();
if(projead=="")
{
valid += 'Secenek Ad'+isr;
}
if (valid!='') {	
			$("#projeislemdis").fadeIn("slow");
			$("#projeislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='projead=' + projead + '&sirketid=' +$('#sirketid').val();
			$("#projeislemdis").css("display", "block");
			$("#projeislemdis").html("Kaydınız Yapılıyor .... ");
			$("#projeislemdis").fadeIn("slow");
			var islem =''
			if(projeid==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&projeid=' + projeid;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("projejqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Secenek Ekle Form Validation Bitti*/


/*Secenek Ekle JQuery Başladı*/
function projejqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=projeekle'}
	else{var islemurl='../islemler/islemler.php?islem=projeduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#projeislemdis").fadeIn("slow");
		$("#projeislemdis").html(html);
		//setTimeout('$("#projeislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Secenek Ekle JQuery Bitti*/
</script>
<div id="wrap">
<?php 
$projeler= new Projeler();
$dproje =$projeler->ProjeGetir($duzenle);
$sirketler = new Sirket();
$data = $sirketler->SirketleriGetir();
$form = new clsForms();
$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('projeler','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Proje Form</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('projeid',$dproje->id));?>
	<td width='10%'>Proje Ad:</td><td><?=$form->doInput(array('projead',$dproje->projead));?></td>
</tr>
<tr>
	<td width='10%'>Şirket:</td><td><?php $form->doSelect(array('sirketid','sirketad',$dproje->sirketid),$data); ?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('projeislem','Gönder'));?></td>
</tr>
<div id="projeislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>