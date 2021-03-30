<style type="text/css">
#quizcevapislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
/*Quiz Cevap Form Validation Başladı*/
$(document.quizcevapislem).ready(function(){
$('#quizcevapislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var quizid=$('#quizid').val();
var soruid=$('#soruid').val();
var cevapid=$('#cevapid').val();
var cevap=$('#cevap').val();
if(cevap=="")
{
valid += 'Cevap'+isr;
}

var dogru='';
$("input:checkbox:checked").map(function()
{
dogru =  this.id;
}).get();
dogru = dogru;

if (valid!='') {	
    $("#quizcevapislemdis").fadeIn("slow");
    $("#quizcevapislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='cevap=' + cevap + '&quizid='+ quizid + '&soruid='+ soruid +'&dy='+dogru;
    $("#quizcevapislemdis").css("display", "block");
    $("#quizcevapislemdis").html("Kaydınız Yapılıyor .... ");
    $("#quizcevapislemdis").fadeIn("slow");
    var islem =''
    if(cevapid==0){
    islem  ='0';
    }else{
    islem  ='1';
    kayitformdatastr = kayitformdatastr + '&cevapid=' + cevapid;
    }
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
    setTimeout("quizcevapjqislem('"+kayitformdatastr+"','"+islem+"')",2000);
}
return false;
});
});
/*Quiz Cevap  Form Validation Bitti*/


/*Quiz Cevap  JQuery Başladı*/
function quizcevapjqislem(kayitformdatastr,islem){
	if (islem=='0'){var islemurl='../islemler/islemler.php?islem=quizcevapekle'}
	else{var islemurl='../islemler/islemler.php?islem=quizcevapduzenle'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#quizcevapislemdis").fadeIn("slow");
		$("#quizcevapislemdis").html(html);
		setTimeout('$("#quizcevapislemdis").fadeOut("slow")',2000);
	}
	});
}
/*Quiz Cevap  JQuery Bitti*/
</script>
<div id="wrap">
<?php 
$form = new clsForms();
$form->doForm(array('basla'));
$quizler = new Quiz();
if($islem=="duzenle"){
    $dquizcevap =$quizler->QuizCevapGetir($duzenle);
}
$dquizsoru = $quizler->QuizSoruGetir($soruid)
?>
<fieldset>
    <legend>Quiz Cevap Form</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<?=$form->doHidden(array('quizid',$quizid));?>
<?=$form->doHidden(array('cevapid',$dquizcevap->id));?>
<?=$form->doHidden(array('soruid',$soruid));?>
<tr>
    <td width='10%'>Soru:</td><td><?=$dquizsoru->soru?></td>
</tr>
<tr>
	<td width='10%'>Cevap:</td><td><?=$form->doTextAreaInput(array("cevap",$dquizcevap->cevap));?></td>
</tr>
<tr>
     <?php
    $checked="";
    if($dquizcevap->dy =="D"){
        $checked="checked";
    }
    ?>
    <td width='10%'>DY:</td><td><?=$form->doCheckGroup(array('dogru','dogru',$checked,'Doğru'));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('quizcevapislem','Gönder'));?></td>
</tr>
<div id="quizcevapislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>