<style type="text/css">
#yaziislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.yaziislem).ready(function(){
$('#yaziislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var yaziid=$('#yaziid').val();
var yaziad=$('#yaziad').val();
var yazidetay=$('#yazidetay').serialize();

if(yaziad=="")
{
valid += 'Yazi Ad'+isr;
}

var anaht='';
$("input:checkbox:checked").map(function()
{
anaht =  anaht+'|'+ this.id;
}).get();
anaht = anaht+'|';

if (valid!='') {	
    $("#yaziislemdis").fadeIn("slow");
    $("#yaziislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='yaziad=' + yaziad + '&yazidetay='+ yazidetay +'&anahtarlar=' + anaht;
    $("#yaziislemdis").css("display", "block");
    $("#yaziislemdis").html("Kaydınız Yapılıyor .... ");
    $("#yaziislemdis").fadeIn("slow");
    var islem =''
    if(yaziid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&yaziid=' + yaziid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("yazijqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function yazijqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=yaziekle'}
	else{var islemurl='../islemler/islemler.php?islem=yaziduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#yaziislemdis").fadeIn("slow");
		$("#yaziislemdis").html(html);
		//setTimeout('$("#yaziislemdis").fadeOut("slow")',2000);
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
$danahtargrup = $anahtargruplar->ListeDetayGetirAciklamayaGore($anahtargrup->id,"Yazılar");
$danahtarlar = $anahtarlar->AnahtarlariGetirGrubaGore($danahtargrup->id);
if($islem=='duzenle'){
    $data = new Yazi();
    $ddata =$data->YaziGetir($duzenleid);
}else{
    $duzenleid=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('yazilar','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Yazı İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('yaziid',$duzenleid));?>
	<td width='20%'>Yazı Ad:</td><td><?=$form->doInput(array('yaziad',$ddata->yaziad));?></td>
</tr>
<tr>
    <td width='20%' valign="top">Yazı Açıklama:</td><td><?=$form->doTextAreaCKEditor(array('yazidetay',str_replace("yazidetay=","",unserialize($ddata->yazidetay))));?></td>
</tr>
<tr>
    <?php
    $anasayfachecked ="";
    if($ddata->anasayfadagoster=="1"){
        $anasayfachecked="checked";
    }
    ?>
    <td colspan='2' align='left'><?=$form->doCheckGroup(array("anasayfadagoster","",$anasayfachecked,'Anasayfada Göster'))?></td>
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
	<td colspan='2' align='left'><?=$form->doButton(array('yaziislem','Gönder'));?></td>
</tr>
<div id="yaziislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>