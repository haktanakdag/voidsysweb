<style type="text/css">
#mailislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">

/*mail Form Validation Başladı*/
$(document.mailislem).ready(function(){
$('#mailislem').click(function(){
var valid = '';
var isr = ' gerekli.';

var mail=$('#mail').val();
if(mail=="")
{
valid += 'Mail'+isr;
}

if (valid!='') {	
			$("#mailislemdis").fadeIn("slow");
			$("#mailislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='mail=' + mail;
			$("#mailislemdis").css("display", "block");
			$("#mailislemdis").html("Kaydınız Yapılıyor .... ");
			$("#mailislemdis").fadeIn("slow");
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("mailjqislem('"+kayitformdatastr+"')",2000);
}
return false;
});
});
/*mail Form Validation Bitti*/


/*Mail JQuery Başladı*/
function mailjqislem(kayitformdatastr,islem){
	var islemurl='../islemler/islemler.php?islem=maildegistir'
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#mailislemdis").fadeIn("slow");
		$("#mailislemdis").html(html);
		setTimeout('$("#mailislemdis").fadeOut("slow")',2000);
	}
	});
}

/*Mail JQuery Bitti*/
</script>
<div id="wrap">
<?php 
$admin = new Admin(); 
$dadmin =$admin->MailGetir();
$form = new clsForms();
$form->doForm(array('basla'));
?>
<fieldset>
    <legend>Mail Düzenle</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr>
	<td width='20%'>Email :</td><td><?=$form->doInput(array('mail',$dadmin->mail));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('mailislem','Gönder'));?></td>
</tr>
<div id="mailislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>
