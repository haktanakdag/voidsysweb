<style type="text/css">
#unvanislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
/*unvan Form Validation Başladı*/
$(document.unvanislem).ready(function(){
$('#unvanislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var unvanid=$('#unvanid').val();
var unvanad=$('#unvanad').val();
if(unvanad=="")
{
valid += 'Unvan Ad'+isr;
}
if (valid!='') {	
			$("#unvanislemdis").fadeIn("slow");
			$("#unvanislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='unvanad=' + unvanad+ '&bagliunvanid=' +$('#bagliunvanid').val();
			$("#unvanislemdis").css("display", "block");
			$("#unvanislemdis").html("Kaydınız Yapılıyor .... ");
			$("#unvanislemdis").fadeIn("slow");
			var islem =''
			if(unvanid==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&unvanid=' + unvanid;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("unvanjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*unvan Form Validation Bitti*/


/*unvan JQuery Başladı*/
function unvanjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=unvanekle'}
	else{var islemurl='../islemler/islemler.php?islem=unvanduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#unvanislemdis").fadeIn("slow");
		$("#unvanislemdis").html(html);
		setTimeout('$("#unvanislemdis").fadeOut("slow")',2000);
	}
	});
}
/*unvan JQuery Bitti*/
</script>
<div id="wrap">
<?php 
$unvanlar = new Unvanlar();
$dunvan =$unvanlar->UnvanGetir($duzenle);

$unvanlar = new Unvanlar();
$dunvanlar = $unvanlar->UnvanlariGetir();

$form = new clsForms();
$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('unvanlar','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Ünvan Düzenle</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('unvanid',$dunvan->id));?>
	<td width='10%'>Ünvan Ad:</td><td><?=$form->doInput(array('unvanad',$dunvan->unvanad));?></td>
</tr>
<tr>
	<td width='20%'>Bağlı Olduğu Ünvan:</td><td><?php $form->doSelect(array('bagliunvanid','unvanad',$dunvan->bagliunvanid),$dunvanlar); ?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('unvanislem','Gönder'));?></td>
</tr>
<div id="unvanislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>