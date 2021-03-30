<style type="text/css">
#listebaslikislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.listebaslikislem).ready(function(){
$('#listebaslikislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var listebaslikId=$('#listebaslikId').val();
var lbaciklama=$('#lbaciklama').val();

if(lbaciklama=="")
{
valid += 'Liste Başlık açıklama'+isr;
}

if (valid!='') {	
    $("#listebaslikislemdis").fadeIn("slow");
    $("#listebaslikislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='lbaciklama=' + lbaciklama;
    $("#listebaslikislemdis").css("display", "block");
    $("#listebaslikislemdis").html("Kaydınız Yapılıyor .... ");
    $("#listebaslikislemdis").fadeIn("slow");
    var islem =''
    if(listebaslikId==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&listebaslikId=' + listebaslikId;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("listebaslikjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function listebaslikjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=listebaslikekle'}
	else{var islemurl='../islemler/islemler.php?islem=listebaslikduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#listebaslikislemdis").fadeIn("slow");
		$("#listebaslikislemdis").html(html);
		setTimeout('$("#listebaslikislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>

<div id="wrap">
<?php 
$form = new clsForms();
if($islem=='duzenle'){
    $data = new Listeler();
    $ddata =$data->ListeBaslikGetir($duzenle);
}else{
    $duzenle=0;
}


$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('listebasliklar','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Liste Başlık Ekle</legend>
    <table  cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('listebaslikId',$ddata->id));?>
	<td width='25%'>Liste Başlık Açıklama :</td><td><?=$form->doInput(array('lbaciklama',$ddata->lbaciklama));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('listebaslikislem','Gönder'));?></td>
</tr>
<div id="listebaslikislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>