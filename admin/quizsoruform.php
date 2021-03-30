<style type="text/css">
#quizsoruislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
/*Quiz Soru Form Validation Başladı*/
$(document.quizsoruislem).ready(function(){
$('#quizsoruislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var quizid=$('#quizid').val();
var quizsoruid=$('#quizsoruid').val();
var soru=$('#soru').val();
if(soru=="")
{
valid += 'Soru'+isr;
}
if (valid!='') {	
			$("#quizsoruislemdis").fadeIn("slow");
			$("#quizsoruislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='soru=' + soru + '&quizid='+ quizid;
			$("#quizsoruislemdis").css("display", "block");
			$("#quizsoruislemdis").html("Kaydınız Yapılıyor .... ");
			$("#quizsoruislemdis").fadeIn("slow");
			var islem =''
			if(quizsoruid==0){
			islem  ='0';
			}else{
			islem  ='1';
			kayitformdatastr = kayitformdatastr + '&quizsoruid=' + quizsoruid;
			}
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("quizsorujqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Quiz Soru  Form Validation Bitti*/


/*Quiz Soru  JQuery Başladı*/
function quizsorujqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=quizsoruekle'}
	else{var islemurl='../islemler/islemler.php?islem=quizsoruduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#quizsoruislemdis").fadeIn("slow");
		$("#quizsoruislemdis").html(html);
		setTimeout('$("#quizsoruislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Quiz Soru  JQuery Bitti*/
</script>
<div id="wrap">
<?php 
$form = new clsForms();
$form->doForm(array('basla'));
if($islem=="duzenle"){
    $quizler = new Quiz();
    $dquizsoru =$quizler->QuizSoruGetir($duzenle);
}
?>
<?php $form->doBaglanti(array('','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Quiz Soru Form</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<?=$form->doHidden(array('quizid',$quizid));?>
<?=$form->doHidden(array('quizsoruid',$dquizsoru->id));?>
<tr>
	<td width='10%'>Soru:</td><td><?=$form->doTextAreaInput(array("soru",$dquizsoru->soru));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('quizsoruislem','Gönder'));?></td>
</tr>
<div id="quizsoruislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>