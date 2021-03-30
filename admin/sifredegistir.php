<style type="text/css">
#sifreislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">

/* Form Validation Başladı*/
$(document.sifreislem).ready(function(){
$('#sifreislem').click(function(){
var valid = '';
var isr = ' gerekli.';

var sifre=$('#sifre').val();
if(sifre=="")
{
valid += 'Sifre'+isr;
}

if (valid!='') {	
			$("#sifreislemdis").fadeIn("slow");
			$("#sifreislemdis").html("Hata : "+valid);
}else {
			var kayitformdatastr ='sifre=' + sifre;
			$("#sifreislemdis").css("display", "block");
			$("#sifreislemdis").html("Kaydınız Yapılıyor .... ");
			$("#sifreislemdis").fadeIn("slow");
			kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
			setTimeout("sifrejqislem('"+kayitformdatastr+"')",2000);
}
return false;
});
});
/* Form Validation Bitti*/


/*JQuery Başladı*/
function sifrejqislem(kayitformdatastr,islem){
	var islemurl='../islemler/islemler.php?islem=sifredegistir'
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#sifreislemdis").fadeIn("slow");
		$("#sifreislemdis").html(html);
		setTimeout('$("#sifreislemdis").fadeOut("slow")',2000);
	}
	});
}

/*JQuery Bitti*/
</script>
<div id="wrap">
<?php 
$admin = new Admin(); 
$dadmin =$admin->SifreGetir();
$form = new clsForms();
$form->doForm(array('basla'));
?>
<fieldset>
    <legend>Mail Düzenle</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr>
	<td width='20%'>Şifre :</td><td><?=$form->doInput(array('sifre',$dadmin->sifre));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('sifreislem','Gönder'));?></td>
</tr>
<div id="sifreislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>
