<style type="text/css">
#urunislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.urunislem).ready(function(){
$('#urunislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var urunid=$('#urunid').val();
var urunkod=$('#urunkod').val();
var urunad=$('#urunad').val();

if(urunad=="")
{
valid += 'Urun Ad'+isr;
}

var anaht='';
$("input:checkbox:checked").map(function()
{
anaht =  anaht+'|'+ this.id;
}).get();
anaht = anaht+'|';

if (valid!='') {	
    $("#urunislemdis").fadeIn("slow");
    $("#urunislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='urunkod=' + urunkod+'&urunad=' + urunad+'&anahtarlar=' + anaht;
    $("#urunislemdis").css("display", "block");
    $("#urunislemdis").html("Kaydınız Yapılıyor .... ");
    $("#urunislemdis").fadeIn("slow");
    var islem =''
    if(urunid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&urunid=' + urunid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("urunjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function urunjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=urunekle'}
	else{var islemurl='../islemler/islemler.php?islem=urunduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#urunislemdis").fadeIn("slow");
		$("#urunislemdis").html(html);
		setTimeout('$("#urunislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$form = new clsForms();
$anahtarlar = new Anahtarlar();
$anahtargruplar = new Listeler();
$anahtargrup = $anahtargruplar->ListeBaslikGetirAciklamayaGore("Anahtar_Gruplari");
$danahtargrup = $anahtargruplar->ListeDetayGetirAciklamayaGore($anahtargrup->id,"Ürünler");
$danahtarlar = $anahtarlar->AnahtarlariGetirGrubaGore($danahtargrup->id);

if($islem=='duzenle'){
    $data = new Urun();
    $ddata =$data->UrunGetir($duzenleid);
}else{
    $duzenleid=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('urunler','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Urun İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('urunid',$duzenleid));?>
    <td width='20%'>Urun Kod:</td><td><?=$form->doInput(array('urunkod',$ddata->urunkod));?></td>
</tr>
<tr>
    <td width='20%'>Urun Ad:</td><td><?=$form->doInput(array('urunad',$ddata->urunad));?></td>
</tr>
<tr>
    <td colspan='2' align='left'>
    <label>Anahtarlar :</label>

    <?php

    $chanahtarlar= explode('|',$ddata->anahtarlar);
    $i =0;
    $checked='';
    echo "<br>";
    foreach($danahtarlar as $anahtar)
    {	
            $checked='';
            for($j=1;$j<=count($chanahtarlar);$j++)
            {	
                    if($chanahtarlar[$j]==$anahtar->id){
                    $checked='checked';
                    }
            }
            echo $form->doCheckGroup(array($anahtar->id,"anahtarlar[]",$checked,$anahtar->anahtarad));
            $i++;
            echo "<br>";
    }
    ?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('urunislem','Gönder'));?></td>
</tr>
<div id="urunislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>