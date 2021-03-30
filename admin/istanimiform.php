<style type="text/css">
#istanimislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">    
/*İş tanım Form Validation Başladı*/
$(document.istanimislem).ready(function(){
$('#istanimislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var IsTanimId=$('#IsTanimId').val();
var isne=$('#isne').val();
if(isne=="")
{
valid += 'İş Ne'+isr;
}
if (valid!='') {	
			$("#istanimislemdis").fadeIn("slow");
			$("#istanimislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='isne=' + isne + '&gorevid=' + $('#gorevid').val() + '&iskimden=' + $('#iskimden').val() + '&isinozeti=' + $('#isinozeti').val() + '&amac=' + $('#amac').val() + '&yontem=' + $('#yontem').val() + '&surec=' + $('#surec').val() + '&ortam=' + $('#ortam').val() + '&iskime=' + $('#iskime').val();
			$("#istanimislemdis").css("display", "block");
			$("#istanimislemdis").html("Kaydınız Yapılıyor .... ");
			$("#istanimislemdis").fadeIn("slow");
			var islem =''
			if(IsTanimId==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&IsTanimId=' + IsTanimId;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("IsTanimjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*İş tanım Form Validation Bitti*/

/*İş tanım JQuery Başladı*/
function IsTanimjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=istanimiekle'}
	else{var islemurl='../islemler/islemler.php?islem=istanimiduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#istanimislemdis").fadeIn("slow");
		$("#istanimislemdis").html(html);
		setTimeout('$("#istanimislemdis").fadeOut("slow")',2000);
	}
	});
}
/*İş tanım JQuery Bitti*/
</script>
<div id="wrap">
<?php 
$form = new clsForms();
$gorevtanimlar = new GorevTanimlar();
$data = $gorevtanimlar->GorevTanimlariGetir();
$istanimlari = new IsTanimlari();
$distanimlar = $istanimlari->IsTanimiGetir($duzenle);
$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('istanimi','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>İş Tanımı Düzenle</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('IsTanimId',$distanimlar->id));?>
	<td width='20%'>İş Ne:</td><td><?=$form->doInput(array('isne',$distanimlar->isne));?></td>
</tr>
<tr>
	<td width='20%'>Görev Tanım:</td><td><?php $form->doSelect(array('gorevid','adsoyad',$distanimlar->gorevid),$data); ?></td>
</tr>
<tr>
	<td width='20%'>İş Kimden Alınacak:</td><td><?=$form->doInput(array('iskimden',$distanimlar->iskimden));?></td>
</tr>
<tr>
	<td width='20%'>İşin Özeti:</td><td><?=$form->doTextAreaInput(array('isinozeti',$distanimlar->isinozeti));?></td>
</tr>
<tr>
	<td width='20%'>Amaç:</td><td><?=$form->doTextAreaInput(array('amac',$distanimlar->amac));?></td>
</tr>
<tr>
	<td width='20%'>Yöntem:</td><td><?=$form->doTextAreaInput(array('yontem',$distanimlar->yontem));?></td>
</tr>
<tr>
	<td width='20%'>Süreç:</td><td><?=$form->doTextAreaInput(array('surec',$distanimlar->surec));?></td>
</tr>
<tr>
	<td width='20%'>Ortam:</td><td><?=$form->doTextAreaInput(array('ortam',$distanimlar->ortam));?></td>
</tr>
<tr>
	<td width='20%'>İş Sonucu Kime Verilecek:</td><td><?=$form->doTextAreaInput(array('iskime',$distanimlar->iskime));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('istanimislem','Gönder'));?></td>
</tr>
<div id="istanimislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>
