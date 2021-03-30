<style type="text/css">
#cevapislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.cevapislem).ready(function(){
$('#cevapislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var cevapid=$('#cevapid').val();
var aciklama=$('#aciklama').val();

if(aciklama=="")
{
valid += 'Açıklama '+isr;
}

var dogru='';
$("input:checkbox:checked").map(function()
{
dogru= this.id;
}).get();

if (valid!='') {	
    $("#cevapislemdis").fadeIn("slow");
    $("#cevapislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='aciklama=' + aciklama + '&soruid='+ $('#soruid').val() + '&dogru='+dogru;
    $("#cevapislemdis").css("display", "block");
    $("#cevapislemdis").html("Kaydınız Yapılıyor .... ");
    $("#cevapislemdis").fadeIn("slow");
    var islem =''
    if(cevapid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&cevapid=' + cevapid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("cevapjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function cevapjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=cevapekle'}
	else{var islemurl='../islemler/islemler.php?islem=cevapduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#cevapislemdis").fadeIn("slow");
		$("#cevapislemdis").html(html);
		setTimeout('$("#cevapislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$form = new clsForms();
if($islem=='duzenle'){
    $data = new Cevap();
    $ddata =$data->CevapGetir($duzenleid);
    echo "ddddd";
    //$soruid =$ddata->soruid;
}else{
    $duzenleid=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('cevaplar','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Cevap İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('cevapid',$duzenleid));?><?=$form->doHidden(array('soruid',$soruid));?>
	<td width='20%'>Soru Açıklama:</td><td><?=$form->doTextAreaInput(array('aciklama',$ddata->cevap));?></td>
</tr>
<tr>
    <td colspan="2"><?=$form->doCheckGroup(array('dogru','dogru',"",'Doğru'));?></td>
</tr>

<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('cevapislem','Gönder'));?></td>
</tr>
<div id="cevapislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>