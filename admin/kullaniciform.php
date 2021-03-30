<style type="text/css">
#kullanicitanimislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
           /*Kullanıcı Form Validation Başladı*/
$(document.kullanicitanimislem).ready(function(){
$('#kullanicitanimislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var kullaniciid=$('#kullaniciid').val();
var adsoyad=$('#adsoyad').val();
if(adsoyad=="")
{
valid += 'Ad Soyad'+isr;
}

if (valid!='') {	
			$("#kullanicitanimislemdis").fadeIn("slow");
			$("#kullanicitanimislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='adsoyad=' + adsoyad + '&birimid=' + $('#birimid').val() + '&unvanid=' + $('#unvanid').val() + '&email=' + $('#email').val()+ '&sifre=' + $('#sifre').val() + '&telefon=' + $('#telefon').val() + '&gorevid=' + $('#gorevid').val();
			$("#kullanicitanimislemdis").css("display", "block");
			$("#kullanicitanimislemdis").html("Kaydınız Yapılıyor .... ");
			$("#kullanicitanimislemdis").fadeIn("slow");
			var islem =''
			if(kullaniciid==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&kullaniciid=' + kullaniciid;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("KullaniciTanimjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Kullanıcı tanım Form Validation Bitti*/

/*Kullanıcı tanım JQuery Başladı*/
function KullaniciTanimjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=kullaniciekle'}
	else{var islemurl='../islemler/islemler.php?islem=kullaniciduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#kullanicitanimislemdis").fadeIn("slow");
		$("#kullanicitanimislemdis").html(html);
		setTimeout('$("#kullanicitanimislemdis").fadeOut("slow")',2000);
	}
	});
}
</script>
            <div id="wrap">
<?php 
$unvanlar = new Unvanlar();
$birimler = new Birimler();
$istanimlari = new IsTanimlari();
$dunvanlar = $unvanlar->UnvanlariGetir();
$dbirimler = $birimler->BirimleriGetir();
$gorevtanimlar = new GorevTanimlar();
$dgorevtanim =$gorevtanimlar->GorevTanimlariGetir();
$kullanicilar = new Kullanicilar();

if($islem=="duzenle"){
    $dkullanici= $kullanicilar->KullaniciGetir($duzenle);
}
$form = new clsForms();
$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('kullanicilar','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Kullanıcı Tanımı Ekle</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('kullaniciid',$dkullanici->id));?>
	<td width='20%'>Ad Soyad:</td><td><?=$form->doInput(array('adsoyad',$dkullanici->adsoyad));?></td>
</tr>
<tr>
	<td width='20%'>Birim:</td><td><?php $form->doSelect(array('birimid','birimad',$dkullanici->birimid),$dbirimler); ?></td>
</tr>
<tr>
	<td width='20%'>Ünvan:</td><td><?php $form->doSelect(array('unvanid','unvanad',$dkullanici->unvanid),$dunvanlar); ?></td>
</tr>
<tr>
	<td width='20%'>Görev Tanım:</td><td><?php $form->doSelect(array('gorevid','adsoyad',$dkullanici->gorevid),$dgorevtanim); ?></td>
</tr>
<tr>
	<td width='20%'>Email:</td><td><?=$form->doInput(array('email',$dkullanici->email));?></td>
</tr>
<tr>
	<td width='20%'>Şifre:</td><td><?=$form->doInputP(array('sifre',$dkullanici->sifre));?></td>
</tr>
<tr>
	<td width='20%'>Telefon:</td><td><?=$form->doInput(array('telefon',$dkullanici->telefon));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('kullanicitanimislem','Gönder'));?></td>
</tr>
</tr>
<div id="kullanicitanimislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>


