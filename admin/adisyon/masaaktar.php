<style type="text/css">
#masaaktarislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.masaaktarislem).ready(function(){
$('#masaaktarislem').click(function(){

var masa1=$('#masa1').val();
var masa2=$('#masa2').val();

var kayitformdatastr ='masa1=' + masa1 + '&masa2=' + masa2;
$("#masaaktarislemdis").css("display", "block");
$("#masaaktarislemdis").html("Kaydınız Yapılıyor .... ");
$("#masaaktarislemdis").fadeIn("slow");

kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
setTimeout("fiyatjqislem('"+kayitformdatastr+"')",2000);
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function fiyatjqislem(kayitformdatastr){
	var islemurl='../islemler/islemler.php?islem=masaaktar';
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#masaaktarislemdis").fadeIn("slow");
		$("#masaaktarislemdis").html(html);
		//setTimeout('$("#masaaktarislemdis").fadeOut("slow")',2000);
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
$form->doSelect(array("masa1","masaad",""),$dmasalar);
echo "<br>";
echo "Değiştirilecek Masa";
echo "<br>";
$form->doSelect(array("masa2","masaad",""),$dmasalar);
echo "<br>";
$form->doButton(array('masaaktarislem','Gönder'));
echo '<div id="masaaktarislemdis"></div>';
$form->doForm(array('bitir'));
?>