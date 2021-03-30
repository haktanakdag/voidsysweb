<style type="text/css">
#anahtarislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.anahtarislem).ready(function(){
$('#anahtarislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var anahtarid=$('#anahtarid').val();
var anahtarad=$('#anahtarad').val();

if(anahtarad=="")
{
valid += 'Anahtar Ad'+isr;
}

if (valid!='') {	
    $("#anahtarislemdis").fadeIn("slow");
    $("#anahtarislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='anahtarad=' + anahtarad;
    $("#anahtarislemdis").css("display", "block");
    $("#anahtarislemdis").html("Kaydınız Yapılıyor .... ");
    $("#anahtarislemdis").fadeIn("slow");
    var islem =''
    if(anahtarid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&anahtarid=' + anahtarid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("anahtarjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function anahtarjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=anahtarekle'}
	else{var islemurl='../islemler/islemler.php?islem=anahtarduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#anahtarislemdis").fadeIn("slow");
		$("#anahtarislemdis").html(html);
		setTimeout('$("#anahtarislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$form = new clsForms();
if($islem=='duzenle'){
    $data = new Anahtarlar();
    $ddata =$data->AnahtarGetir($duzenle);
}else{
    $duzenle=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('anahtarlar','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Anahtar İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('anahtarid',$duzenle));?>
	<td width='20%'>Anahtar Ad:</td><td><?=$form->doInput(array('anahtarad',$ddata->anahtarad));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('anahtarislem','Gönder'));?></td>
</tr>
<div id="anahtarislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>