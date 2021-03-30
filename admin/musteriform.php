<style type="text/css">
#musteritanimislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
           /*Kullanıcı Form Validation Başladı*/
$(document.musteritanimislem).ready(function(){
$('#musteritanimislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var musteriid=$('#musteriid').val();
var musterikod=$('#musterikod').val();
var musteriunvan=$('#musteriunvan').val();
var vd=$('#vd').val();
var vn=$('#vn').val();
if(musterikod=="")
{
valid += 'Müşteri Kodu '+isr;
}
if(musteriunvan=="")
{
valid += 'Müşteri Ünvan '+isr;
}
if(vd=="")
{
valid += 'VD '+isr;
}
if(vn=="")
{
valid += 'VN '+isr;
}

if (valid!='') {	
    $("#musteritanimislemdis").fadeIn("slow");
    $("#musteritanimislemdis").html("Hata : "+valid);
    }else {
    var kayitformdatastr ='musterikod=' + musterikod + '&musteriunvan=' + musteriunvan + '&grupkod=' + $('#grupkod').val()  + '&ekgrupkod=' + $('#ekgrupkod').val()  + '&ilgilikisi=' + $('#ilgilikisi').val() + '&vd=' + $('#vd').val()+ '&vn=' + $('#vn').val() + '&telno=' + $('#telno').val() + '&adres=' + $('#adres').val()+ '&aciklama=' + $('#aciklama').val();
    $("#musteritanimislemdis").css("display", "block");
    $("#musteritanimislemdis").html("Kaydınız Yapılıyor .... ");
    $("#musteritanimislemdis").fadeIn("slow");
    var islem =''
    if(musteriid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&musteriid=' + musteriid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("MusteriTanimjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Kullanıcı tanım Form Validation Bitti*/

/*Kullanıcı tanım JQuery Başladı*/
function MusteriTanimjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=musteriekle'}
	else{var islemurl='../islemler/islemler.php?islem=musteriduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#musteritanimislemdis").fadeIn("slow");
		$("#musteritanimislemdis").html(html);
		setTimeout('$("#musteritanimislemdis").fadeOut("slow")',2000);
	}
	});
}
</script>
            <div id="wrap">
<?php 

$musteriler = new Musteriler();

if($islem=="duzenle"){
    $dmusteri= $musteriler->MusteriGetir($duzenleid);
}
$form = new clsForms();
$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('musteriler','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Kullanıcı Tanımı Ekle</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('musteriid',$dmusteri->id));?>
	<td width='20%'>MusteriKod:</td><td><?=$form->doInput(array('musterikod',$dmusteri->musterikod));?></td>
</tr>
<tr>
	<td width='20%'>Müşteri Ünvan:</td><td><?=$form->doInput(array('musteriunvan',$dmusteri->musteriunvan));?></td>
</tr>
<tr>
	<td width='20%'>Grup Kod:</td><td><?=$form->doInput(array('grupkod',$dmusteri->grupkod));?></td>
</tr>
<tr>
	<td width='20%'>Ek Grup Kod:</td><td><?=$form->doInput(array('ekgrupkod',$dmusteri->ekgrupkod));?></td>
</tr>
<tr>
	<td width='20%'>İlgili Kişi:</td><td><?=$form->doInput(array('ilgilikisi',$dmusteri->ilgilikisi));?></td>
</tr>
<tr>
	<td width='20%'>Vergi Dairesi:</td><td><?=$form->doInput(array('vd',$dmusteri->vd));?></td>
</tr>
<tr>
	<td width='20%'>Vergi Numarası:</td><td><?=$form->doInput(array('vn',$dmusteri->vn));?></td>
</tr>
<tr>
	<td width='20%'>Telefon:</td><td><?=$form->doInput(array('telno',$dmusteri->telno));?></td>
</tr>
<tr>
	<td width='20%'>Adres:</td><td><?=$form->doInput(array('adres',$dmusteri->adres));?></td>
</tr>
<tr>
	<td width='20%'>Aciklama:</td><td><?=$form->doInput(array('aciklama',$dmusteri->aciklama));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('musteritanimislem','Gönder'));?></td>
</tr>
</tr>
<div id="musteritanimislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>


