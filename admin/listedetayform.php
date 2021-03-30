<style type="text/css">
#listedetayislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
// JavaScript Document
/*Secenek Ekle Form Validation Başladı*/
$(document.listedetayislem).ready(function(){
$('#listedetayislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var listebaslikId=$('#listebaslikId').val();
var listedetayId=$('#listedetayId').val();
var ldaciklama=$('#ldaciklama').val();
if(ldaciklama=="")
{
valid += 'Liste detay açıklama'+isr;
}
if (valid!='') {	
			$("#listedetayislemdis").fadeIn("slow");
			$("#listedetayislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='ldaciklama=' + ldaciklama + '&listebaslikId=' +$('#listebaslikId').val() + '&listedetayId=' +$('#listedetayId').val();
			$("#listedetayislemdis").css("display", "block");
			$("#listedetayislemdis").html("Kaydınız Yapılıyor .... ");
			$("#listedetayislemdis").fadeIn("slow");
			var islem =''
			if(listedetayId==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&listedetayId=' + listedetayId;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("listedetayjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Secenek Ekle Form Validation Bitti*/


/*Secenek Ekle JQuery Başladı*/
function listedetayjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=listedetayekle'}
	else{var islemurl='../islemler/islemler.php?islem=listedetayduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#listedetayislemdis").fadeIn("slow");
		$("#listedetayislemdis").html(html);
		//setTimeout('$("#projeislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Secenek Ekle JQuery Bitti*/
</script>
<div id="wrap">
<?php 
$listedetaylar = new Listeler();
$data = $listedetaylar->ListeBasliklariGetir();
if($listebaslikId){
	$dlistebaslik =$listedetaylar->ListeBaslikGetir($listebaslikId);
}

if($duzenle){
$dlistedetay =$listedetaylar->ListeDetayGetir($duzenle);
$data = $listedetaylar->ListeBasliklariGetir();
}

$form = new clsForms();
$form->doForm(array('basla'));
?>

<?php $form->doBaglanti(array('birimler','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Liste Detay Ekle</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('listedetayId',$dlistedetay->id));?>
	<td width='10%'>Liste Detay Açıklama:</td><td><?=$form->doInput(array('ldaciklama',$dlistedetay->ldaciklama));?></td>
</tr>
<tr>
	<td width='20%'>Bağlı olduğu Liste Başlık:</td><td><?php $form->doSelect(array('listebaslikId','lbaciklama',$dlistedetay->baslikid),$data); ?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('listedetayislem','Gönder'));?></td>
</tr>
<div id="listedetayislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>