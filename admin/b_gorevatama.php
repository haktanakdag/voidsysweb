<a name="bastaraf">
<style type="text/css">
#gorevatamaislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
/*Görev Atama Form Validation Başladı*/
$(document.gorevatamaislem).ready(function(){
$('#gorevatamaislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var atanangorevid=$('#atanangorevid').val();

var konu=$('#konu').val();
if(konu=="")
{
valid += 'Konu'+isr;
}
var detayaciklama=$('#detayaciklama').val();
if(detayaciklama=="")
{
valid += 'Detay Açıklama'+isr;
}
var islemsure=$('#islemsure').val();
if(islemsure=="")
{
valid += 'İşlem Süre'+isr;
}
if (valid!='') {	
			$("#gorevatamaislemdis").fadeIn("slow");
			$("#gorevatamaislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='konu=' + konu + '&detayaciklama=' + detayaciklama + '&islemsure=' + islemsure+ '&sonkulid=' + $('#sonkulid').val()+ '&kaynakid=' + $('#kaynakid').val()+ '&nedenid=' + $('#nedenid').val()+ '&aciliyetid=' + $('#aciliyetid').val()+ '&durumid=' + $('#durumid').val()+ '&islemturid=' + $('#islemturid').val()+ '&dissistemno1=' + $('#dissistemno1').val()+ '&dissistemno2=' + $('#dissistemno2').val()+ '&dissistemno3=' + $('#dissistemno3').val();
			$("#gorevatamaislemdis").css("display", "block");
			$("#gorevatamaislemdis").html("Kaydınız Yapılıyor .... ");
			$("#gorevatamaislemdis").fadeIn("slow");
			var islem =''
			if(atanangorevid==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&atanangorevid=' + atanangorevid;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("gorevatamajqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Görev atama Form Validation Bitti*/


/*Görev atama JQuery Başladı*/
function gorevatamajqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=gorevatamaekle'}
	else{var islemurl='../islemler/islemler.php?islem=gorevatamaduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#gorevatamaislemdis").fadeIn("slow");
		$("#gorevatamaislemdis").html(html);
		setTimeout('$("#gorevatamaislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Görev atama JQuery Bitti*/
</script>
<div id="wrap">

<?php
$form = new clsForms();
$listeler = new Listeler();
$parametreler = new Parametreler();
$dkaynaklar = $parametreler->ParametreGetirA("kaynak");
$dlistekaynak = $listeler->listeDetayGetirC($dkaynaklar->deger);

$liste =$listeler->ListeBaslikGetirAciklamayaGore("Bilgi_Islem_Gorev_Tipleri");
$dlisteneden = $listeler->listeDetayGetirC($liste->id);

$daciliyet = $parametreler->ParametreGetirA("aciliyet");
$dlisteaciliyet = $listeler->listeDetayGetirC($daciliyet->deger,"aciliyet");

$ddurum = $parametreler->ParametreGetirA("durum");
$dlistedurum = $listeler->listeDetayGetirC($ddurum->deger);

$dislemtur = $parametreler->ParametreGetirA("islemtur");
$dlisteislemtur = $listeler->listeDetayGetirC($dislemtur->deger);

$kullanicilar = new Kullanicilar();
$kulid =s_get('kullanici');
$dkullanicilar  = $kullanicilar->YetkiliKullanicilariGetir($kulid);

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('gorevatama','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Gorev Atama</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('atanangorevid',0));?>
	<td width='20%'>Konu:</td><td><?=$form->doInput(array('konu'));?></td>
</tr>
<tr>
	<td width='20%'>Kaynak:</td><td><?php $form->doSelect(array('kaynakid','ldaciklama'),$dlistekaynak); ?></td>
</tr>
<tr>
	<td width='20%'>Kime:</td><td><?php $form->doSelect(array('id','adsoyad'),$dkullanicilar); ?></td>
</tr>
<tr>
	<td width='20%'>Neden:</td><td><?php $form->doSelect(array('nedenid','ldaciklama'),$dlisteneden); ?></td>
</tr>
<tr>
	<td width='20%'>Aciliyet:</td><td><?php $form->doSelect(array('aciliyetid','ldaciklama'),$dlisteaciliyet); ?></td>
</tr>
<tr>
	<td width='20%'>Durum:</td><td><?php $form->doSelect(array('durumid','ldaciklama'),$dlistedurum); ?></td>
</tr>
<tr>
	<td width='20%'>Dış Sistem No 1:</td><td><?=$form->doInput(array('dissistemno1'));?></td>
</tr>
<tr>
	<td width='20%'>Dış Sistem No 2:</td><td><?=$form->doInput(array('dissistemno2'));?></td>
</tr>
<tr>
	<td width='20%'>Dış Sistem No 3:</td><td><?=$form->doInput(array('dissistemno3'));?></td>
</tr>
<tr>
	<td width='20%'>İşlem Tür:</td><td><?php $form->doSelect(array('islemturid','ldaciklama'),$dlisteislemtur); ?></td>
</tr>
<tr>
	<td width='20%'>İşlem Süre (Saat):</td><td><?=$form->doInput(array('islemsure'));?></td>
</tr>
<tr>
	<td width='20%'>Detay Açıklama:</td><td><?=$form->doTextAreaInput(array('detayaciklama'));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('gorevatamaislem','Gönder'));?></td>
</tr>
<div id="gorevatamaislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
<a href="#bastaraf">sayfanın üstüne çık</a>