<style type="text/css">
#gorevislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.gorevislem).ready(function(){
$('#gorevislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var gorevid=$('#gorevid').val();
var gorevad=$('#gorevad').val();
var kullanici=$('#kullanici').val();
var tamam=$('#tamam').val();
var gorevdetay=$('#gorevdetay').val();

if(gorevad=="")
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
    $("#gorevislemdis").fadeIn("slow");
    $("#gorevislemdis").html("Hata : "+valid);
}else {
    var gorevformdatastr ='gorevad=' + gorevad + '&gorevdetay='+ gorevdetay  + '&kullanici='+ kullanici + '&tamam='+ tamam  +'&anahtarlar=' + anaht;
    $("#gorevislemdis").css("display", "block");
    $("#gorevislemdis").html("Kaydınız Yapılıyor .... ");
    $("#gorevislemdis").fadeIn("slow");
    var islem =''
    if(gorevid==0){
    islem  ='0';
    }else{
    islem  ='1';
    gorevformdatastr = gorevformdatastr + '&gorevid=' + gorevid;
    }
    gorevformdatastr = gorevformdatastr.replace(/\n/g, "<br />")
    setTimeout("gorevjqislem('"+gorevformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function gorevjqislem(gorevformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=gorevekle'}
	else{var islemurl='../islemler/islemler.php?islem=gorevduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: gorevformdatastr,
		cache: false,
		success: function(html){
		$("#gorevislemdis").fadeIn("slow");
		$("#gorevislemdis").html(html);
		//setTimeout('$("#gorevislemdis").fadeOut("slow")',2000);
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
//$anahtarlar = new Anahtarlar();
//$danahtarlar = $anahtarlar->AnahtarlariGetir();
$anahtarlar = new Listeler();
$liste =$anahtarlar->ListeBaslikGetirAciklamayaGore("Bilgi_Islem_Gorev_Tipleri");
$danahtarlar = $anahtarlar->listeDetayGetirC($liste->id);

$kullanicilar = new Kullanicilar();
$dkullanicilar = $kullanicilar->KullanicilariGetir();
if($islem=='duzenle'){
    $data = new Gorev();
    $ddata =$data->GorevGetir($duzenleid);
}else{
    $duzenleid=0;
}

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('gorevler','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Kayıt İşlem</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('gorevid',$duzenleid));?>
	<td width='20%'>Kayıt Ad:</td><td><?=$form->doInput(array('gorevad',$ddata->gorevad));?></td>
</tr>
<tr>
    <td width='20%' valign="top">Kayıt Açıklama:</td><td><?=$form->doTextAreaInput(array('gorevdetay',$ddata->gorevdetay));?></td>
</tr>
<tr>
    <?php
    
    $tamamchecked ="";
    if($ddata->tamam=="1"){
        $tamamchecked="checked";
    }
    ?>
    <td colspan='2' align='left'><?=$form->doCheckGroup(array("tamam","",$tamamchecked,'Tamam'))?></td>
</tr>
<tr>
    <td colspan='2'>
       <?=$form->doSelect(array("kullanici",'adsoyad',$ddata->kullanici),$dkullanicilar) ?>
    </td>
</tr>
<tr>
    <td colspan='2' align='left'>
    <label>Anahtarlar :</label>
<br>
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
            echo $form->doCheckGroup(array($anahtar->id,"anahtarlar[]",$checked,$anahtar->ldaciklama));
            $i++;
            echo "<br>";
    }
    ?>
    </td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('gorevislem','Gönder'));?></td>
</tr>
<div id="gorevislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>