<style type="text/css">
#anketislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
/*Anket Ekle Form Validation Başladı*/
$(document.anketislem).ready(function(){
$('#anketislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var anketid=$('#anketid').val();
var anketad=$('#anketad').val();
if(anketad=="")
{
valid += 'Anket Ad'+isr;
}
if (valid!='') {	
    $("#anketislemdis").fadeIn("slow");
    $("#anketislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='anketad=' + anketad+ '&durumid='+ $('#durumid').val() +'&aciklama='+ $('#aciklama').val();
    $("#anketislemdis").css("display", "block");
    $("#anketislemdis").html("Kaydınız Yapılıyor .... ");
    $("#anketislemdis").fadeIn("slow");
    var islem =''
    if(anketid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&anketid=' + anketid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("anketjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Anket Ekle Form Validation Bitti*/


/*Anket Ekle JQuery Başladı*/
function anketjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=anketekle'}
	else{var islemurl='../islemler/islemler.php?islem=anketduzenle'}
	$.ajax({	
        type: "POST",
        url: islemurl,
        data: kayitformdatastr,
        cache: false,
        success: function(html){
        $("#anketislemdis").fadeIn("slow");
        $("#anketislemdis").html(html);
        setTimeout('$("#anketislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Anket Ekle JQuery Bitti*/


</script>
<div id="wrap">
<?php 
$form = new clsForms();
$parametreler = new Parametreler();
$listeler = new Listeler();
$ddurum = $parametreler->ParametreGetirA ( "anketdurum" );
$danketlistedurum = $listeler->listeDetayGetirC ( $ddurum->deger );

$anketler = new Anket();
$danket =$anketler->AnketGetir($duzenle);

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('anketler','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Anket Düzenle</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('anketid',$danket->id));?>
	<td width='10%'>Anket Ad:</td><td><?=$form->doInput(array('anketad',$danket->anketad));?></td>
</tr>
<tr>
	<td width='10%'>Durum:</td><td><?=$form->doSelect(array("durumid","ldaciklama",$danket->durumid),$danketlistedurum)?></td>
</tr>
<tr>
	<td width='10%'>Aciklama:</td><td><?=$form->doTextAreaInput(array("aciklama",$danket->aciklama));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('anketislem','Gönder'));?></td>
</tr>
<div id="anketislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>