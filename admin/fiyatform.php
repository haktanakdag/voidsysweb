<style type="text/css">
#fiyatislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.fiyatislem).ready(function(){
$('#fiyatislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var fiyatid=$('#fiyatid').val();
var aciklama=$('#aciklama').val();
var alisfiyat=$('#alisfiyat').val();
var satisfiyat=$('#satisfiyat').val();

if(aciklama=="")
{
valid += 'Açıklama '+isr;
}

if (valid!='') {	
    $("#fiyatislemdis").fadeIn("slow");
    $("#fiyatislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='aciklama=' + aciklama + '&alisfiyat=' + alisfiyat + '&satisfiyat=' + satisfiyat + '&urunid='+ $('#urunid').val();
    $("#fiyatislemdis").css("display", "block");
    $("#fiyatislemdis").html("Kaydınız Yapılıyor .... ");
    $("#fiyatislemdis").fadeIn("slow");
    var islem =''
    if(fiyatid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&fiyatid=' + fiyatid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("fiyatjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function fiyatjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=fiyatekle'}
	else{var islemurl='../islemler/islemler.php?islem=fiyatduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#fiyatislemdis").fadeIn("slow");
		$("#fiyatislemdis").html(html);
		setTimeout('$("#fiyatislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$form = new clsForms();
$urunler = new Urun();
$durunler = $urunler->UrunleriGetir();
if($islem='duzenle'){
    $data = new Fiyat();
    $ddata =$data->FiyatGetir($duzenleid);
}else{
    $duzenleid=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('fiyatlar','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Fiyat İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('fiyatid',$duzenleid));?>
    <td width='20%'>Açıklama:</td><td><?=$form->doInput(array('aciklama',$ddata->aciklama));?></td>
</tr>
<tr>
    <td width='20%'>Urun Ad:</td><td><?=$form->doSelect(array('urunid','urunad',$ddata->urunid),$durunler);?></td>
</tr>
<tr>
    <td width='20%'>Alış Fiyat:</td><td><?=$form->doInput(array('alisfiyat',$ddata->alisfiyat));?></td>
</tr>
<tr>
    <td width='20%'>Satış Fiyat:</td><td><?=$form->doInput(array('satisfiyat',$ddata->satisfiyat));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('fiyatislem','Gönder'));?></td>
</tr>
<div id="fiyatislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>