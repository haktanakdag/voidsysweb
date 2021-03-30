<style type="text/css">
#masaislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.masaislem).ready(function(){
$('#masaislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var masaid=$('#masaid').val();
var masaad=$('#masaad').val();

if(masaad=="")
{
valid += 'Masa Ad'+isr;
}

if (valid!='') {	
    $("#masaislemdis").fadeIn("slow");
    $("#masaislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='masaad=' + masaad;
    $("#masaislemdis").css("display", "block");
    $("#masaislemdis").html("Kaydınız Yapılıyor .... ");
    $("#masaislemdis").fadeIn("slow");
    var islem =''
    if(masaid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&masaid=' + masaid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("masajqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function masajqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=masaekle'}
	else{var islemurl='../islemler/islemler.php?islem=masaduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#masaislemdis").fadeIn("slow");
		$("#masaislemdis").html(html);
		setTimeout('$("#masaislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$form = new clsForms();
if($islem=='duzenle'){
    $data = new Masa();
    $ddata =$data->MasaGetir($duzenleid);
}else{
    $duzenleid=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('masalar','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Masa İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('masaid',$duzenleid));?>
	<td width='20%'>Masa Ad:</td><td><?=$form->doInput(array('masaad',$ddata->masaad));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('masaislem','Gönder'));?></td>
</tr>
<div id="masaislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>