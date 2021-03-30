<style type="text/css">
#bayiislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.bayiislem).ready(function(){
$('#bayiislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var bayiid=$('#bayiid').val();
var bayikod=$('#bayikodu').val();
var bayiad=$('#bayiadi').val();
var bylogokucuk=$('#bylogokucuk').val();
var bylogobuyuk=$('#bylogobuyuk').val();
var bylogoico=$('#bylogoico').val();
var sunucuadresi=$('#sunucuadresi').val();

if(bayikod=="")
{
valid += 'Bayi Kod'+isr;
}

if(bayiad=="")
{
valid += 'Bayi Ad'+isr;
}

if (valid!='') {	
    $("#bayiislemdis").fadeIn("slow");
    $("#bayiislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='bayiadi=' + bayiad +'&bayikodu=' + bayikod +'&bylogokucuk=' + bylogokucuk +'&bylogobuyuk=' + bylogobuyuk +'&bylogoico=' + bylogoico +'&sunucuadresi=' + sunucuadresi;
    $("#bayiislemdis").css("display", "block");
    $("#bayiislemdis").html("Kaydınız Yapılıyor .... ");
    $("#bayiislemdis").fadeIn("slow");
    var islem =''
    if(bayiid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&bayiid=' + bayiid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("bayijqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}

return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function bayijqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=bayiekle'}
	else{var islemurl='../islemler/islemler.php?islem=bayiduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#bayiislemdis").fadeIn("slow");
		$("#bayiislemdis").html(html);
		setTimeout('$("#bayiislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$form = new clsForms();
if($islem=='duzenle'){
    $data = new Bayiler();
    $ddata =$data->BayiGetir($duzenle);
}else{
    $duzenle=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('bayiler','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Bayi İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('bayiid',$duzenle));?>
    <td width='20%'>Bayi Kodu :</td><td><?=$form->doInput(array('bayikodu',$ddata->bayikodu));?></td>
</tr>
<tr>
    <td width='20%'>Bayi Adı :</td><td><?=$form->doInput(array('bayiadi',$ddata->bayiadi));?></td>
</tr>
<tr>
    <td width='20%'>Logo Küçük:</td><td><?=$form->doInput(array('bylogokucuk',$ddata->logokucuk));?></td>
</tr>
<tr>
    <td width='20%'>Logo Büyük :</td><td><?=$form->doInput(array('bylogobuyuk',$ddata->logobuyuk));?></td>
</tr>
<tr>
    <td width='20%'>Logo Ico :</td><td><?=$form->doInput(array('bylogoico',$ddata->logoico));?></td>
</tr>
<tr>
    <td width='20%'>Sunucu Adresi :</td><td><?=$form->doInput(array('sunucuadresi',$ddata->sunucuadresi));?></td>
</tr>
<tr>
    <td colspan='2' align='left'><?=$form->doButton(array('bayiislem','Gönder'));?></td>
</tr>
<div id="bayiislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>