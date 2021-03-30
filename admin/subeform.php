<style type="text/css">
#subeislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.subeislem).ready(function(){
$('#subeislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var subeid=$('#subeid').val();
var subead=$('#subead').val();
var subedetay=$('#subedetay').val();

if(subead=="")
{
valid += 'Şube Ad'+isr;
}

if (valid!='') {	
    $("#subeislemdis").fadeIn("slow");
    $("#subeislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='subead=' + subead + '&subedetay='+ subedetay;
    $("#subeislemdis").css("display", "block");
    $("#subeislemdis").html("Kaydınız Yapılıyor .... ");
    $("#subeislemdis").fadeIn("slow");
    var islem =''
    if(subeid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&subeid=' + subeid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("subejqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function subejqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=subeekle'}
	else{var islemurl='../islemler/islemler.php?islem=subeduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#subeislemdis").fadeIn("slow");
		$("#subeislemdis").html(html);
		//setTimeout('$("#subeislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$form = new clsForms();
if($islem=='duzenle'){
    $data = new Sube();
    $ddata =$data->SubeGetir($duzenleid);
}else{
    $duzenleid=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('subeler','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Şube İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('subeid',$duzenleid));?>
	<td width='20%'>Şube Ad:</td><td><?=$form->doInput(array('subead',$ddata->subead));?></td>
</tr>
<tr>
    <td width='20%' valign="top">Şube Açıklama:</td><td><?=$form->doTextAreaCKEditor(array('subedetay',$ddata->subedetay));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('subeislem','Gönder'));?></td
</tr>
<div id="subeislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>