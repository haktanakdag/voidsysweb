<style type="text/css">
#referansislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.referansislem).ready(function(){
$('#referansislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var referansid=$('#referansid').val();
var referansad=$('#referansad').val();
var aciklama=$('#aciklama').val();

if(referansad=="")
{
valid += 'Referans Ad'+isr;
}

if (valid!='') {	
    $("#referansislemdis").fadeIn("slow");
    $("#referansislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='referansad=' + referansad + '&aciklama=' +aciklama;
    $("#referansislemdis").css("display", "block");
    $("#referansislemdis").html("Kaydınız Yapılıyor .... ");
    $("#referansislemdis").fadeIn("slow");
    var islem =''
    if(referansid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&referansid=' + referansid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("referansjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function referansjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=referansekle'}
	else{var islemurl='../islemler/islemler.php?islem=referansduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#referansislemdis").fadeIn("slow");
		$("#referansislemdis").html(html);
		//setTimeout('$("#referansislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$data = new Referanslar();
$ddata = $data->ReferansGetir($duzenle);
$form = new clsForms();
$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('referanslar','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Referans Ekle</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('referansid',$duzenle));?>
	<td width='20%'>Referans Ad:</td><td><?=$form->doInput(array('referansad',$ddata->referansad));?></td>
</tr>
<tr>
	<td width='20%'>Açıklama:</td><td><?=$form->doTextAreaInput(array('aciklama',$ddata->aciklama));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('referansislem','Gönder'));?></td>
</tr>
<div id="referansislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>