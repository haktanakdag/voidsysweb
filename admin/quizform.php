<style type="text/css">
#quizislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
/*Quiz Ekle Form Validation Başladı*/
$(document.quizislem).ready(function(){
$('#quizislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var quizid=$('#quizid').val();
var quizad=$('#quizad').val();
if(quizad=="")
{
valid += 'Quiz Ad'+isr;
}
if (valid!='') {	
    $("#quizislemdis").fadeIn("slow");
    $("#quizislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='quizad=' + quizad+ '&dersid='+ $('#dersid').val();
    $("#quizislemdis").css("display", "block");
    $("#quizislemdis").html("Kaydınız Yapılıyor .... ");
    $("#quizislemdis").fadeIn("slow");
    var islem =''
    if(quizid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&quizid=' + quizid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("quizjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Quiz Ekle Form Validation Bitti*/


/*Quiz Ekle JQuery Başladı*/
function quizjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=quizekle'}
	else{var islemurl='../islemler/islemler.php?islem=quizduzenle'}
	$.ajax({	
        type: "POST",
        url: islemurl,
        data: kayitformdatastr,
        cache: false,
        success: function(html){
        $("#quizislemdis").fadeIn("slow");
        $("#quizislemdis").html(html);
        setTimeout('$("#quizislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Quiz Ekle JQuery Bitti*/


</script>
<div id="wrap">
<?php 
$form = new clsForms();
$parametreler = new Parametreler();
$listeler = new Listeler();
$dersler = new Dersler();
$ddersler=$dersler->DersleriGetir();
$quizler = new Quiz();
$dquiz =$quizler->QuizGetir($duzenle);

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('quizler','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Quiz Düzenle</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr><?=$form->doHidden(array('quizid',$dquiz->id));?>
	<td width='10%'>Quiz Ad:</td><td><?=$form->doInput(array('quizad',$dquiz->quizad));?></td>
</tr>
<tr>
	<td width='10%'>Ders:</td><td><?=$form->doSelect(array("dersid","dersad",$dquiz->dersid),$ddersler)?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('quizislem','Gönder'));?></td>
</tr>
<div id="quizislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>