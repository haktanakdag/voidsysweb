<style type="text/css">
#sirketislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.sirketislem).ready(function(){
$('#sirketislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var sirketid=$('#sirketid').val();
var sirketad=$('#sirketad').val();

if(sirketad=="")
{
valid += 'Şirket Ad'+isr;
}

if (valid!='') {	
    $("#sirketislemdis").fadeIn("slow");
    $("#sirketislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='sirketad=' + sirketad;
    $("#sirketislemdis").css("display", "block");
    $("#sirketislemdis").html("Kaydınız Yapılıyor .... ");
    $("#sirketislemdis").fadeIn("slow");
    var islem =''
    if(sirketid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&sirketid=' + sirketid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("sirketjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function sirketjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=sirketekle'}
	else{var islemurl='../islemler/islemler.php?islem=sirketduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#sirketislemdis").fadeIn("slow");
		$("#sirketislemdis").html(html);
		setTimeout('$("#sirketislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$form = new clsForms();
if($islem=='duzenle'){
    $data = new sirket();
    $ddata =$data->SirketGetir($duzenle);
}else{
    $duzenle=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('sirketler.php','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Şirket İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2' class="formtable" >
<tr><?=$form->doHidden(array('sirketid',$duzenle));?>
	<td width='10%'>Şirket Ad:</td><td><?=$form->doInput(array('sirketad',$ddata->sirketad));?></td>
</tr>
<tr>
	<td colspan='2'><?=$form->doButton(array('sirketislem','Gönder'));?></td>
</tr>
<div id="sirketislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>