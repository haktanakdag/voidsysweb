<style type="text/css">
#olayislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
/*Temsilcilik Form Validation Başladı*/
$(document.olayislem).ready(function(){
$('#olayislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var olayid=$('#olayid').val();
var olay=$('#olay').val();
if(olay=="")
{
valid += 'Olay'+isr;
}

if (valid!='') {	
    $("#olayislemdis").fadeIn("slow");
    $("#olayislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='olay=' + olay +'&bastarih=' + $('#bastarih').val()  + '&bittarih=' + $('#bittarih').val();
    $("#olayislemdis").css("display", "block");
    $("#olayislemdis").html("Kaydınız Yapılıyor .... ");
    $("#olayislemdis").fadeIn("slow");
    var islem =''
    if(olayid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&olayid=' + olayid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("olayjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Temsilcilik Form Validation Bitti*/

/*Temsilcilik JQuery Başladı*/
function olayjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=olayekle'}
	else{var islemurl='../islemler/islemler.php?islem=olayduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#olayislemdis").fadeIn("slow");
		$("#olayislemdis").html(html);
		setTimeout('$("#olayislemdis").fadeOut("slow")',2000);
	}
	});
}
</script>
<?php 
if($islem=="duzenle"){
$olaylar = new Olaylar();
$dolay= $olaylar->OlayGetir($duzenle);
}
?>

<div id="wrap">
<?php 
$form = new clsForms();
$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('olaylar','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Haber Form</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<?=$form->doHidden(array('olayid',$dolay->id));?>
<br>
<tr>
    <td width='10%'>Başlangıç Tarihi:</td><td><?=$form->doDateInput(array('bastarih',$dolay->bastarih));?></td>
</tr>
<tr>
	<td width='10%'>Bitiş Tarihi:</td><td><?=$form->doDateInput(array('bittarih',$dolay->bittarih));?></td>
</tr>
<br>
<tr>
	<td width='20%'>Olay:</td><td><?=$form->doTextAreaInput(array('olay',$dolay->olay));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('olayislem','Gönder'));?></td>
</tr>
<div id="olayislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>
<script>
$(function() {
	$( "#bastarih" ).datepicker();
});
</script>
<script>
$(function() {
	$( "#bittarih" ).datepicker();
});
</script>
