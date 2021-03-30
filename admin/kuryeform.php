<style type="text/css">
#kuryeislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.kuryeislem).ready(function(){
$('#kuryeislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var kuryeid=$('#kuryeid').val();
var kuryead=$('#kuryead').val();

if(kuryead=="")
{
valid += 'Kurye Ad'+isr;
}

if (valid!='') {	
    $("#kuryeislemdis").fadeIn("slow");
    $("#kuryeislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='kuryead=' + kuryead;
    $("#kuryeislemdis").css("display", "block");
    $("#kuryeislemdis").html("Kaydınız Yapılıyor .... ");
    $("#kuryeislemdis").fadeIn("slow");
    var islem =''
    if(kuryeid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&kuryeid=' + kuryeid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("kuryejqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function kuryejqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=kuryeekle'}
	else{var islemurl='../islemler/islemler.php?islem=kuryeduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#kuryeislemdis").fadeIn("slow");
		$("#kuryeislemdis").html(html);
		setTimeout('$("#kuryeislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$form = new clsForms();
if($islem=='duzenle'){
    $data = new Kurye();
    $ddata =$data->KuryeGetir($duzenleid);
}else{
    $duzenleid=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('kuryeler','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Kurye İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('kuryeid',$duzenleid));?>
	<td width='20%'>Kurye Ad:</td><td><?=$form->doInput(array('kuryead',$ddata->kuryead));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('kuryeislem','Gönder'));?></td>
</tr>
<div id="kuryeislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>