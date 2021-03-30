<style type="text/css">
#masadegistirislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.masadegistirislem).ready(function(){
$('#masadegistirislem').click(function(){

var degistirilenmasaid=$('#degistirilenmasaid').val();
var degistirilecekmasaid=$('#degistirilecekmasaid').val();

var kayitformdatastr ='degistirilenmasaid=' + degistirilenmasaid + '&degistirilecekmasaid=' + degistirilecekmasaid;
$("#masadegistirislemdis").css("display", "block");
$("#masadegistirislemdis").html("Kaydınız Yapılıyor .... ");
$("#masadegistirislemdis").fadeIn("slow");

kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
setTimeout("fiyatjqislem('"+kayitformdatastr+"')",2000);
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function fiyatjqislem(kayitformdatastr){
	var islemurl='../islemler/islemler.php?islem=masadegistir';
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#masadegistirislemdis").fadeIn("slow");
		$("#masadegistirislemdis").html(html);
		setTimeout('$("#masadegistirislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<?php
$form = new clsForms();
$masalar = new Masa();
$dmasalar=$masalar->MasalariGetir();
$form->doForm(array('basla'));
echo "Değiştirilen Masa";
echo "<br>";
$form->doSelect(array("degistirilenmasaid","masaad",""),$dmasalar);
echo "<br>";
echo "Değiştirilecek Masa";
echo "<br>";
$form->doSelect(array("degistirilecekmasaid","masaad",""),$dmasalar);
echo "<br>";
$form->doButton(array('masadegistirislem','Gönder'));
echo '<div id="masadegistirislemdis"></div>';
$form->doForm(array('bitir'));
?>