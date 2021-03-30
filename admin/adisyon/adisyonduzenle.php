<style type="text/css">
#adisyonduzenleislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.adisyonduzenleislem).ready(function(){
$('#adisyonduzenleislem').click(function(){

var adisyonid=$('#adisyonid').val();
var masaid=$('#masaid').val();

var kayitformdatastr ='masaid=' + masaid + '&adisyonid=' + adisyonid;
$("#adisyonduzenleislemdis").css("display", "block");
$("#adisyonduzenleislemdis").html("Kaydınız Yapılıyor .... ");
$("#adisyonduzenleislemdis").fadeIn("slow");

kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
setTimeout("adisyonduzenlejqislem('"+kayitformdatastr+"')",2000);
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function adisyonduzenlejqislem(kayitformdatastr){
	var islemurl='../islemler/islemler.php?islem=adisyonduzenle';
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#adisyonduzenleislemdis").fadeIn("slow");
		$("#adisyonduzenleislemdis").html(html);
		setTimeout('$("#adisyonduzenleislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>

<script type="text/javascript">
$(document.adisyonsilislem).ready(function(){
$('#adisyonsilislem').click(function(){

var adisyonid=$('#adisyonid').val();

var kayitformdatastr ='adisyonid=' + adisyonid;
$("#adisyonduzenleislemdis").css("display", "block");
$("#adisyonduzenleislemdis").html("Kaydınız Yapılıyor .... ");
$("#adisyonduzenleislemdis").fadeIn("slow");

kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
setTimeout("adisyonsiljqislem('"+kayitformdatastr+"')",2000);
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function adisyonsiljqislem(kayitformdatastr){
	var islemurl='../islemler/islemler.php?islem=adisyonsil';
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#adisyonduzenleislemdis").fadeIn("slow");
		$("#adisyonduzenleislemdis").html(html);
		setTimeout('$("#adisyonduzenleislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>
<?php
$form = new clsForms();
$masalar = new Masa();
$dmasalar=$masalar->AcikOlmayanMasalariGetir();
$form->doForm(array('basla'));
echo "Düzenlenecek Adisyon";
echo "<br>";
$form->doSelect(array("masaid","masaad",""),$dmasalar);
echo "<br>";
$form->doInput(array("adisyonid"));
echo "<br>";
$form->doButton(array('adisyonduzenleislem','Adisyon Tekrar Aç'));
echo "<br>";
$form->doButton(array('adisyonsilislem','Adisyon Sil'));
echo '<div id="adisyonduzenleislemdis"></div>';
$form->doForm(array('bitir'));
?>