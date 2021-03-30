<style type="text/css">
#dersislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.dersislem).ready(function(){
$('#dersislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var dersid=$('#dersid').val();
var dersad=$('#dersad').val();

if(dersad=="")
{
valid += 'Şirket Ad'+isr;
}

if (valid!='') {	
    $("#dersislemdis").fadeIn("slow");
    $("#dersislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='dersad=' + dersad;
    $("#dersislemdis").css("display", "block");
    $("#dersislemdis").html("Kaydınız Yapılıyor .... ");
    $("#dersislemdis").fadeIn("slow");
    var islem =''
    if(dersid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&dersid=' + dersid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("dersjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function dersjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=dersekle'}
	else{var islemurl='../islemler/islemler.php?islem=dersduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#dersislemdis").fadeIn("slow");
		$("#dersislemdis").html(html);
		setTimeout('$("#dersislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$form = new clsForms();
if($islem=='duzenle'){
    $data = new Dersler();
    $ddata =$data->DersGetir($duzenle);
}else{
    $duzenle=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('dersler.php','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Ders İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2' class="formtable" >
<tr><?=$form->doHidden(array('dersid',$duzenle));?>
	<td width='10%'>Ders Ad:</td><td><?=$form->doInput(array('dersad',$ddata->dersad));?></td>
</tr>
<tr>
	<td colspan='2'><?=$form->doButton(array('dersislem','Gönder'));?></td>
</tr>
<div id="dersislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>