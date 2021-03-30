<style type="text/css">
#lisansislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.lisansislem).ready(function(){
$('#lisansislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var lisansid = $('#lisansid').val();
var uygulama=$('#uygulama').val();
var musterinumarasi=$('#musterinumarasi').val();
var bilgisayar=$('#bilgisayar').val();
var bastarih=$('#bastarih').val();
var bittarih=$('#bittarih').val();



if(uygulama=="")
{
valid += 'Uygulama'+isr;
}
if(musterinumarasi=="")
{
valid += 'Müşteri Numarası'+isr;
}
if(bilgisayar=="")
{
valid += 'Bilgisayar'+isr;
}

if(bastarih=="")
{
valid += 'Başlangıç Tarihi'+isr;
}
if(bittarih=="")
{
valid += 'Bitiş Tarihi'+isr;
}

if (valid!='') {	
    $("#lisansislemdis").fadeIn("slow");
    $("#lisansislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='uygulama=' + uygulama + '&musterinumarasi='+ musterinumarasi + '&bilgisayar='+ bilgisayar + '&bastarih='+ bastarih + '&bittarih='+ bittarih + '&durum='+ $('#durum').val() + '&aciklama='+ $('#aciklama').val();
    $("#lisansislemdis").css("display", "block");
    $("#lisansislemdis").html("Kaydınız Yapılıyor .... ");
    $("#lisansislemdis").fadeIn("slow");
    var islem =''
    if(lisansid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&lisansid=' + lisansid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("lisansjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function lisansjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=lisansekle'}
	else{var islemurl='../islemler/islemler.php?islem=lisansduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#lisansislemdis").fadeIn("slow");
		$("#lisansislemdis").html(html);
		//setTimeout('$("#lisansislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$form = new clsForms();
$liste = new Listeler();
$dlistebaslik =$liste->ListeBaslikGetirAciklamayaGore("Lisans_Durum");
$dlistedetay =$liste->listeDetayGetirC($dlistebaslik->id);

if($islem=='duzenle'){
    $data = new Lisans();
    $ddata =$data->LisansKayitGetir($duzenleid);
}else{
    $duzenleid=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('lisanslar','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Lisans İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('lisansid',$duzenleid));?>
    <td width='20%' valign="top">Uygulama:</td><td><?=$form->doInput(array('uygulama',$ddata->uygulama));?></td>
</tr>
<tr>
    <td width='20%' valign="top">Müşteri Numarası:</td><td><?=$form->doInput(array('musterinumarasi',$ddata->musterinumarasi));?></td>
</tr>
<tr>
    <td width='20%' valign="top">Bilgisayar:</td><td><?=$form->doInput(array('bilgisayar',$ddata->bilgisayar));?></td>
</tr>
<tr>
    <td width='20%' valign="top">Başlangıç Tarihi:</td><td><?=$form->doDateInput(array('bastarih',$ddata->bastarih));?></td>
</tr>
<tr>
    <td width='20%' valign="top">Bitiş Tarihi:</td><td><?=$form->doDateInput(array('bittarih',$ddata->bittarih));?></td>
</tr>
<tr>
    <td width='20%' valign="top">Durum:</td><td><?=$form->doSelect(array('baslikid','ldaciklama',$ddata->durum),$dlistedetay);?></td>
</tr>
<tr>
    <td width='20%' valign="top">Açıklama:</td><td><?=$form->doInput(array('aciklama',$ddata->aciklama));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('lisansislem','Gönder'));?></td>
</tr>
<div id="lisansislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>