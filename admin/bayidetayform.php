<style type="text/css">
#bayiislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.bayidetayislem).ready(function(){
$('#bayidetayislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var bayiid=$('#bayiid').val();
var sabittel=$('#sabittel').val();
var ceptel=$('#ceptel').val();
var fax=$('#fax').val();
var adres=$('#adres').val();
var email=$('#email').val();
var www=$('#www').val();
var calsaathici=$('#calsaathici').val();
var calsaathsonu=$('#calsaathsonu').val();
var bizkimiz=$('#bizkimiz').val();
var facebookadr=$('#facebookadr').val();
var twitteradr=$('#twitteradr').val();
var instagramadr=$('#instagramadr').val();
var detaybilgi=$('#detaybilgi').val();

var anahtarkelimeler=$('#anahtarkelimeler').val();

if(sabittel=="")
{
valid += 'Sabit Tel'+isr;
}

if(email=="")
{
valid += 'E-Mail'+isr;
}

if (valid!='') {	
    $("#bayiislemdis").fadeIn("slow");
    $("#bayiislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='sabittel=' + sabittel+'&ceptel=' + ceptel+'&fax=' + fax+'&adres=' + adres+'&email=' + email+'&www=' + www+'&calsaathici=' + calsaathici+'&calsaathsonu=' + calsaathsonu+'&bizkimiz=' + bizkimiz+'&facebookadr=' + facebookadr+'&twitteradr=' + twitteradr+'&instagramadr=' + instagramadr+'&detaybilgi=' + detaybilgi+'&anahtarkelimeler=' + anahtarkelimeler;
    $("#bayiislemdis").css("display", "block");
    $("#bayiislemdis").html("Kaydınız Yapılıyor .... ");
    $("#bayiislemdis").fadeIn("slow");
    var islem =''
    if(bayiid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&bayiid=' + bayiid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("bayijqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}

return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function bayijqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=bayidetayekle'}
	else{var islemurl='../islemler/islemler.php?islem=bayidetayduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#bayiislemdis").fadeIn("slow");
		$("#bayiislemdis").html(html);
		setTimeout('$("#bayiislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$form = new clsForms();
if($bayidetaylar<>''){
    $data = new Bayiler();
    $ddata =$data->BayiGetir($bayidetaylar);
    $ddatadetay =$data->BayiDetayGetir($bayidetaylar);
    //echo $ddata->bayikodu;
}else{
    $duzenle=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('bayiler','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Bayi İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('bayiid',$bayidetaylar));?>
    <td width='20%'>Bayi Kodu :</td><td><?=$ddata->bayikodu?></td>
</tr>
<tr>
    <td width='20%'>Bayi Adı :</td><td><?=$ddata->bayiadi?></td>
</tr>
<tr>
    <td width='20%'>Sabit Tel :</td><td><?=$form->doInput(array('sabittel',$ddatadetay->sabittel));?></td>
</tr>
<tr>
    <td width='20%'>Cep Tel :</td><td><?=$form->doInput(array('ceptel',$ddatadetay->ceptel));?></td>
</tr>
<tr>
    <td width='20%'>Fax :</td><td><?=$form->doInput(array('fax',$ddatadetay->fax));?></td>
</tr>
<tr>
    <td width='20%'>Adres :</td><td><?=$form->doInput(array('adres',$ddatadetay->adres));?></td>
</tr>
<tr>
    <td width='20%'>Email :</td><td><?=$form->doInput(array('email',$ddatadetay->email));?></td>
</tr>
<tr>
    <td width='20%'>WWW :</td><td><?=$form->doInput(array('www',$ddatadetay->www));?></td>
</tr>
<tr>
    <td width='20%'>H. İçi Çalışma Saati :</td><td><?=$form->doInput(array('calsaathici',$ddatadetay->calsaathici));?></td>
</tr>
<tr>
    <td width='20%'>H. Sonu Çalışma Saati :</td><td><?=$form->doInput(array('calsaathsonu',$ddatadetay->calsaathsonu));?></td>
</tr>
<tr>
    <td width='20%'>Biz Kimiz :</td><td><?=$form->doInput(array('bizkimiz',$ddatadetay->bizkimiz));?></td>
</tr>
<tr>
    <td width='20%'>Facebook Adres :</td><td><?=$form->doInput(array('facebookadr',$ddatadetay->facebookadr));?></td>
</tr>
<tr>
    <td width='20%'>Twitter Adres :</td><td><?=$form->doInput(array('twitteradr',$ddatadetay->twitteradr));?></td>
</tr>
<tr>
    <td width='20%'>Instagram Adres :</td><td><?=$form->doInput(array('instagramadr',$ddatadetay->instagramadr));?></td>
</tr>
<tr>
    <td width='20%'>Detay Bilgi :</td><td><?=$form->doTextAreaInput(array('detaybilgi',$ddatadetay->detaybilgi));?></td>
</tr>
<tr>
    <td width='20%'>Anahtar Kelimeler :</td><td><?=$form->doTextAreaInput(array('anahtarkelimeler',$ddatadetay->anahtarkelimeler));?></td>
</tr>
<tr>
    <td colspan='2' align='left'><?=$form->doButton(array('bayidetayislem','Gönder'));?></td>
</tr>
<div id="bayiislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>