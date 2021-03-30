<style type="text/css">
#birimislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
/*Birim Ekle Form Validation Başladı*/
$(document.birimislem).ready(function(){
$('#birimislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var birimid=$('#birimid').val();
var birimad=$('#birimad').val();
if(birimad=="")
{
valid += 'Birim Ad'+isr;
}
if (valid!='') {	
			$("#birimislemdis").fadeIn("slow");
			$("#birimislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='birimad=' + birimad + '&birimbagid=' +$('#birimbagid').val();
			$("#birimislemdis").css("display", "block");
			$("#birimislemdis").html("Kaydınız Yapılıyor .... ");
			$("#birimislemdis").fadeIn("slow");
			var islem =''
			if(birimid==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&birimid=' + birimid;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("birimjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Birim Ekle Form Validation Bitti*/


/*Birim Ekle JQuery Başladı*/
function birimjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=birimekle'}
	else{var islemurl='../islemler/islemler.php?islem=birimduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#birimislemdis").fadeIn("slow");
		$("#birimislemdis").html(html);
		setTimeout('$("#birimislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Birim Ekle JQuery Bitti*/
</script>
<div id="wrap">
<?php 
$birimler= new Birimler();
$dbirim =$birimler->BirimGetir($duzenle);
$data = $birimler->BirimleriGetir();
$form = new clsForms();
$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('birimler','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
<legend>Birim Düzenle</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('birimid',$dbirim->id));?>
    <td width='10%'>Birim Ad:</td><td><?=$form->doInput(array('birimad',$dbirim->birimad));?></td>
</tr>
<tr>
    <td width='20%'>Bağlı olduğu birim:</td><td><?php $form->doSelect(array('birimbagid','birimad',$dbirim->birimbagid),$data); ?></td>
</tr>
<tr>
    <td colspan='2' align='left'><?=$form->doButton(array('birimislem','Gönder'));?></td>
</tr>
<div id="birimislemdis"></div>
</table>
</fieldset>
    <?php
$form->doForm(array('bitir'));
?>
</div>
