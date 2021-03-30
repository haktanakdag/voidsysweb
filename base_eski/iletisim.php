<style type="text/css">
#gonderislemdis {
	display: none;
	border: 1px solid #ccc;
	background: #FFFFA0;
	padding: 30px;
	width: 450px;
}
</style>
<script type="text/javascript">
$(document.gonderislem).ready(function(){
$('#gonderislem').click(function(){
var valid = '';
var isr = ' gerekli.';
var adsoyad=$('#adsoyad').val();
var eposta=$('#eposta').val();
var telefon=$('#telefon').val();
var mesaj=$('#mesaj').val();

if(adsoyad=='')
{
valid += 'Ad Soyad'+isr;
}
if(eposta=='')
{
valid += ' Eposta'+isr;
}
if(telefon=='')
{
valid += ' Telefon'+isr;
}
if(mesaj=='')
{
valid += ' Mesaj'+isr;
}
if (valid!='') {	
    $("#gonderislemdis").fadeIn("slow");
    $("#gonderislemdis").html("Hata : "+valid);
}else {
    var kayitformdatastr ='adsoyad=' + adsoyad + '&eposta='+ eposta +'&telefon=' + telefon + '&mesaj=' + mesaj;
    $("#gonderislemdis").css("display", "block");
    $("#gonderislemdis").html("Gönderim Yapılıyor .... ");
    $("#gonderislemdis").fadeIn("slow");
    kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />");
    setTimeout("mesajjqislem('"+kayitformdatastr+"')",2000);
}
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function mesajjqislem(kayitformdatastr){
var islemurl='mesajgonder.php'
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
		$("#gonderislemdis").fadeIn("slow");
		$("#gonderislemdis").html(html);
		setTimeout('$("#gonderislemdis").fadeOut("slow")',2000);
	}
	});
}
/* jquery bitti */
</script>

<div class="w3-container w3-padding-large w3-grey">
    <h4 id="iletisim"><b>Bana Ulaşın</b></h4>
    <div class="w3-row-padding w3-center w3-padding-24" style="margin:0 -16px">
      <div class="w3-third w3-dark-grey">
        <p><i class="fa fa-envelope w3-xxlarge w3-text-light-grey"></i></p>
        <p>bilgi@dokuzsistem.com</p>
      </div>
      <div class="w3-third w3-teal">
        <p><i class="fa fa-map-marker w3-xxlarge w3-text-light-grey"></i></p>
        <p>Atölye : Hasanefendi Mah. 1911 Sok. No : 6/1 - Satış Ofisi: Ata Mh. Denizli Blv. No:18 
Aydın Ticaret Borsası Hizmet Binası Kat: 6 No: 5 Aydın , Efeler </p>
      </div>
      <div class="w3-third w3-dark-grey">
        <p><i class="fa fa-phone w3-xxlarge w3-text-light-grey"></i></p>
        <p>0850 441 90 99  - 0555 663 49 87</p>
      </div>
    </div>
    <hr class="w3-opacity">
   
  </div>
<div class="w3-container w3-padding-large w3-grey">
 <form action="" target="" method="POST">
        <div id="gonderislemdis"></div>
      <div class="w3-section">
        <label>Ad Soyad</label>
        <input class="w3-input w3-border" type="text" name="adsoyad" id="adsoyad">
      </div>
      <div class="w3-section">
        <label>E-Posta</label>
        <input class="w3-input w3-border" type="text" name="eposta" id="eposta">
      </div>
      <div class="w3-section">
        <label>Telefon</label>
        <input class="w3-input w3-border" type="text" name="telefon" id="telefon">
      </div>
      <div class="w3-section">
        <label>Mesaj</label>
        <input class="w3-input w3-border" type="text" name="mesaj" id="mesaj">
      </div>
      <button type="submit" name="gonderislem" id="gonderislem" class="w3-button w3-black w3-margin-bottom">
          <i class="fa fa-paper-plane w3-margin-right"></i>Mesaj Gönder</button>
    </form>
  </div>