<style type="text/css">
#gorevtanimislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
/*Görev tanım Form Validation Başladı*/
$(document.gorevtanimislem).ready(function(){
$('#gorevtanimislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var GorevTanimId=$('#GorevTanimId').val();
var adsoyad=$('#adsoyad').val();
if(adsoyad=="")
{
valid += 'Ad Soyad'+isr;
}

var anah='';
$("input:checkbox:checked").map(function()
{
anah= anah+ '|'+ this.id;
}).get();
anah=anah+'|';

if (valid!='') {
			$("#gorevtanimislemdis").fadeIn("slow");
			$("#gorevtanimislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='adsoyad=' + adsoyad + '&birimid=' + $('#birimid').val() + '&unvanid=' + $('#unvanid').val() + '&bagunvanid=' + $('#bagunvanid').val() + '&gorevinamaci=' + $('#gorevinamaci').val() + '&gorevkisatanimi=' + $('#gorevkisatanimi').val() + '&vekaletid=' + $('#vekaletid').val() + '&issorumluluklari=' + $('#issorumluluklari').val() + '&yetkileri=' + $('#yetkileri').val() +'&anahtarlar=' + anah;
			$("#gorevtanimislemdis").css("display", "block");
			$("#gorevtanimislemdis").html("Kaydınız Yapılıyor .... ");
			$("#gorevtanimislemdis").fadeIn("slow");
			var islem =''
			if(GorevTanimId==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&GorevTanimId=' + GorevTanimId;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("GorevTanimjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Görev tanım Form Validation Bitti*/

/*Görev tanım JQuery Başladı*/
function GorevTanimjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=gorevtanimekle'}
	else{var islemurl='../islemler/islemler.php?islem=gorevtanimduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#gorevtanimislemdis").fadeIn("slow");
		$("#gorevtanimislemdis").html(html);
		setTimeout('$("#gorevtanimislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Görev tanım JQuery Bitti*/
</script>
<div id="wrap">
<?php 
$form = new clsForms();
$unvanlar = new Unvanlar();
$birimler = new Birimler();
$istanimlari = new IsTanimlari();
$dunvanlar = $unvanlar->UnvanlariGetir();
$dbirimler = $birimler->BirimleriGetir();
$distanimlar = $istanimlari->IsTanimiGetir($duzenle);
$anahtarlar = new Anahtarlar();
$anahtargruplar = new Listeler();
$anahtargrup = $anahtargruplar->ListeBaslikGetirAciklamayaGore("Anahtar_Gruplari");
$danahtargrup = $anahtargruplar->ListeDetayGetirAciklamayaGore($anahtargrup->id,"Görev Tanım");
$danahtarlar = $anahtarlar->AnahtarlariGetirGrubaGore($danahtargrup->id);
$gorevtanimlar= new GorevTanimlar();
$dgorevtanimlar = $gorevtanimlar->GorevTanimGetir($duzenle);
$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('gorevtanimi','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Gorev Tanımı Düzenle</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('GorevTanimId',$duzenle));?>
	<td width='20%'>Ad Soyad:</td><td><?=$form->doInput(array('adsoyad',$dgorevtanimlar->adsoyad));?></td>
</tr>
<tr>
	<td width='20%'>Birim:</td><td><?php $form->doSelect(array('birimid','birimad',$dgorevtanimlar->birimid),$dbirimler); ?></td>
</tr>
<tr>
	<td width='20%'>Ünvan:</td><td><?php $form->doSelect(array('unvanid','unvanad',$dgorevtanimlar->unvanid),$dunvanlar); ?></td>
</tr>
<tr>
	<td width='20%'>Bağlı Olduğu Ünvan:</td><td><?php $form->doSelect(array('bagunvanid','unvanad',$dgorevtanimlar->bagliunvanid),$dunvanlar); ?></td>
</tr>
<tr>
	<td width='20%'>Görevin Amacı:</td><td><?=$form->doTextAreaInput(array('gorevinamaci',$dgorevtanimlar->gorevinamaci));?></td>
</tr>
<tr>
	<td width='20%'>Görev Kısa tanımı:</td><td><?=$form->doTextAreaInput(array('gorevkisatanimi',$dgorevtanimlar->gorevkisatanimi));?></td>
</tr>
<tr>
	<td width='20%'>İş/Görev ( Vekalet Edebileceği)</td><td><?php $form->doSelect(array('vekaletid','unvanad',$dgorevtanimlar->vekaletid),$dunvanlar); ?></td>
</tr>
<tr>
	<td width='20%'>Temel İş ve Sorumlulukları:</td><td><?=$form->doTextAreaInput(array('issorumluluklari',$dgorevtanimlar->issorumluluklari));?></td>
</tr>
<tr>
	<td width='20%'>Yetkileri:</td><td><?=$form->doTextAreaInput(array('yetkileri',$dgorevtanimlar->yetkileri));?></td>
</tr>
<tr>
	<td colspan='2' align='left'>
	<label>Anahtarlar :</label>

	<?php
	
	$chanahtarlar= explode('|',$dgorevtanimlar->anahtarlar);
	$i =0;
	$checked='';
	echo "<br>";
	foreach($danahtarlar as $anahtar)
	{	
		$checked='';
		for($j=1;$j<=count($chanahtarlar);$j++)
		{	
			if($chanahtarlar[$j]==$anahtar->id){
			$checked='checked';
			}
		}
		echo $form->doCheckGroup(array($anahtar->id,"anahtarlar[]",$checked,$anahtar->anahtarad));
		$i++;
		echo "<br>";
	}
	?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('gorevtanimislem','Gönder'));?></td>
</tr>
<div id="gorevtanimislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>


