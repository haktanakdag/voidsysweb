<style type="text/css">
#kayitislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.kayitislem).ready(function(){
$('#kayitislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var kayitid=$('#kayitid').val();
var kayitad=$('#kayitad').val();
var kayitdetay=$('#kayitdetay').val();

if(kayitad=="")
{
valid += 'Kayit Ad'+isr;
}

var anaht='';
$("input:checkbox:checked").map(function()
{
anaht =  anaht+'|'+ this.id;
}).get();
anaht = anaht+'|';

if (valid!='') {	
    $("#kayitislemdis").fadeIn("slow");
    $("#kayitislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='kayitad=' + kayitad + '&kayitdetay='+ kayitdetay +'&anahtarlar=' + anaht;
    $("#kayitislemdis").css("display", "block");
    $("#kayitislemdis").html("Kaydınız Yapılıyor .... ");
    $("#kayitislemdis").fadeIn("slow");
    var islem =''
    if(kayitid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&kayitid=' + kayitid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("kayitjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function kayitjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=kayitekle'}
	else{var islemurl='../islemler/islemler.php?islem=kayitduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#kayitislemdis").fadeIn("slow");
		$("#kayitislemdis").html(html);
		setTimeout('$("#kayitislemdis").fadeOut("slow")',2000);
	}
	});
}

editor.on('pluginsLoaded' , function( evt ){ //it must be done before "instanceReady" to make the tag blocking in effect
  var previousNext = false;
  evt.editor.dataProcessor.htmlFilter.addRules({
    elements :{
      $ : function( element ) {
        if (element.previous || element.next) {
          if (previousNext && previousNext.value == '&nbsp;' && element.previous && element.previous.name =='br') {
            var helper = new CKEDITOR.htmlParser.text('<br>');                  
            helper.insertBefore(element);
            previousNext.remove();
          }
          previousNext = element.next;
        }
      }
    }
  });
  
  var counter = 0;
  evt.editor.dataProcessor.dataFilter.addRules({
    elements :{
      br : function( element ) {
        if(element.next && (element.next.value == '&nbsp;' || element.next.name == 'br')){                    
          counter++;
          return;                    
        }
            
        if(counter <= 1){
          var helper = new CKEDITOR.htmlParser.text('&nbsp;');                  
          helper.insertAfter(element);
        }
        
        counter = 0;      
      }
    }
  });
});
/* jquery bitti */
</script>
<div id="wrap">
<?php 
$form = new clsForms();
$anahtarlar = new Anahtarlar();
$anahtargruplar = new Listeler();
$anahtargrup = $anahtargruplar->ListeBaslikGetirAciklamayaGore("Anahtar_Gruplari");
$danahtargrup = $anahtargruplar->ListeDetayGetirAciklamayaGore($anahtargrup->id,"Kayıtlar");
$danahtarlar = $anahtarlar->AnahtarlariGetirGrubaGore($danahtargrup->id);
if($islem=='duzenle'){
    $data = new Kayit();
    $ddata =$data->KayitGetir($duzenleid);
}else{
    $duzenleid=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('kayitlar','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Kayıt İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('kayitid',$duzenleid));?>
	<td width='20%'>Kayıt Ad:</td><td><?=$form->doInput(array('kayitad',$ddata->kayitad));?></td>
</tr>
<tr>
    <td width='20%' valign="top">Kayıt Açıklama:</td><td><?=$form->doTextAreaInput(array('kayitdetay',$ddata->kayitdetay));?></td>
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
    if ($danahtarlar)
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
	<td colspan='2' align='left'><?=$form->doButton(array('kayitislem','Gönder'));?></td>
</tr>
<div id="kayitislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>