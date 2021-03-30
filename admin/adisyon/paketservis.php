<?php include '../../classes_include.php'; ?>
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link href="../../css/fieldset.css" rel="stylesheet" type="text/css"/>
<link href="../../css/zerogrid.css" rel="stylesheet" type="text/css"/>
<script src="../../js/tree.js" type="text/javascript"></script>
<link href="../../css/tree.css" rel="stylesheet" type="text/css"/>
<link href="../../css/table.css" rel="stylesheet" type="text/css"/> 
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<div class="zerogrid">
    <div class="row">
    <div class="col-2-3">
        <div class="wrap-col">
<?php
include 'urunler.php';
?>
</div>
    </div>
<div class="col-1-3">
    <div class="wrap-col">
<?php
$forms = new clsForms();
$kuryelar= new Kurye();
$adisyon = new Adisyon();
$urunler = new Urun();

if($kapat==1){
    $adisyon->AdisyonKapat($adisyonid);
}
if($urunid){
    $dkurye=$kuryelar->KuryeAcikKapaliKontrol($kuryeid);
    if ($dkurye->acikkapali=='1'){
        $dadisyon =$adisyon->AdisyonGetirKuryeyeGore($kuryeid);
        $adisyon->AdisyonDetayEkle($dadisyon->id,$urunid);
    }
}
if($detaysil){
    $adisyon->AdisyonDetayIptal($adisyondetayid);
}
if($detaymiktararttir){
     $adisyon->AdisyonDetayMiktarArttir($adisyondetayid);
     //redirect("./adisyon.php?kuryeid=$kuryeid");
}
if($detaymiktarazalt){
     $adisyon->AdisyonDetayMiktarAzalt($adisyondetayid);
     redirect("./adisyon.php?kuryeid=$kuryeid");
}
if($detayodemearttir){
     $adisyon->AdisyonDetayOdemeArttir($adisyondetayid);
     redirect("./adisyon.php?kuryeid=$kuryeid");
}
if($detayodemeazalt){
     $adisyon->AdisyonDetayOdemeAzalt($adisyondetayid);
     redirect("./adisyon.php?kuryeid=$kuryeid");
}
?>
<script type="text/javascript">
$(document.adisyonislem).ready(function(){
$('#adisyonislem').click(function(){
var adisyonid=$('#adisyonid').val();
var kuryeid=$('#kuryeid').val();
var kayitformdatastr ='kuryeid='+ kuryeid;
var islem =''
if(adisyonid==0){
islem  ='0';
}else{
islem  ='1';
kayitformdatastr = kayitformdatastr + '&adisyonid=' + adisyonid;
}
kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
setTimeout("adisyonjqislem('"+kayitformdatastr+"','"+islem+"')",500);
return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function adisyonjqislem(kayitformdatastr,islem){
	if (islem=='0'){ var islemurl='../../islemler/islemler.php?islem=PaketAdisyonEkle'}
	else{var islemurl='../../islemler/islemler.php?islem=adisyonkapat'}
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
                $("#dvloader").show();
                $('#dvadisyon').load(document.URL +  ' #dvadisyon');
                location.reload();
                window.opener.location.reload();
                $('#dvorta').load(document.URL +  ' #dvorta',function(){ $("#dvloader").hide(); });
	}
	});
}
/* jquery bitti */
</script>
<script type="text/javascript">
$(document.adisyoniptal).ready(function(){
$('#adisyoniptal').click(function(){
var adisyonid=$('#adisyonid').val();
var kayitformdatastr = kayitformdatastr + '&adisyonid=' + adisyonid;
kayitformdatastr = kayitformdatastr.replace(/\n/g, "<br />")
setTimeout("adisyonjqiptal('"+kayitformdatastr+"')",500);

return false;
});
});
/*Form Validation Bitti*/

/*JQuery Başladı*/
function adisyonjqiptal(kayitformdatastr){
	var islemurl='../../islemler/islemler.php?islem=adisyoniptal';
	$.ajax({	
		type: "POST",
		url: islemurl,
		data: kayitformdatastr,
		cache: false,
		success: function(html){
                $("#dvloader").show();
                $('#dvadisyon').load(document.URL +  ' #dvadisyon');
                location.reload();
                window.opener.location.reload();
                $('#dvorta').load(document.URL +  ' #dvorta',function(){ $("#dvloader").hide(); });
	}
	});
}
/* jquery bitti */
</script>

<div id='dvadisyon'>
<?PHP

$dkuryelar = $kuryelar->KuryeGetir($kuryeid);
$adisyonKurye=$adisyon->AdisyonGetirKuryeyeGore($kuryeid);
$durunler = $urunler->UrunleriGetir();

echo "<form>";
echo "<fieldset>";
echo "<legend>$dkuryelar->kuryead</legend>";
if(!$adisyonKurye){
    $forms->doHidden(array('adisyonid',0));
    $forms->doHidden(array('kuryeid',$kuryeid));
    $forms->doButton(array('adisyonislem','AdisyonAc'));
}else{
    $forms->doHidden(array('adisyonid',$adisyonKurye->id));
    $forms->doHidden(array('kuryeid',$kuryeid));
    $adisyonKuryeDetaylar=$adisyon->AdisyonDetaylariGetir($adisyonKurye->id);
    echo "<table border='1' color='black' class='table'>";
    echo "<tr>";
    echo "<td>UrunAd</td>";
    echo "<td>Mk</td>";
    echo "<td>Tt</td>";
    echo "<td>OdMk</td>";
    echo "<td>OdTt</td>";
    echo "<td>İşlem</td>";
    echo "</tr>";
    if($adisyonKuryeDetaylar)
    foreach($adisyonKuryeDetaylar as $ad){
        $urun =$urunler->UrunGetir($ad->urunid);
        $Detayhref=$_SERVER['PHP_SELF']."?adisyonid=$adisyonKurye->id&kuryeid=$kuryeid&adisyondetayid=$ad->id";
        echo $actual_link;
        echo "<tr>";
        echo "<td>$urun->urunad</td>";
        echo "<td>$ad->satmiktar</td>";
        echo "<td>$ad->sattutar</td>";
        echo "<td>$ad->odmiktar</td>";
        echo "<td>$ad->odtutar</td>";
        //echo "<td><a href='#' class='btn'>Sil</a></td>";
        //echo "<td>".$forms->doBaglanti(array('sil','sil','sil','btn'))."</td>";
        //echo "<td>".$forms->doBaglanti(array('sil','sil','sil'))."</td>";
        $class ="class='w3-button w3-circle w3-tiny w3-black w3-card-4'";
        echo "<td><a href='$Detayhref&detaysil=1' $class>Sil</a><a href='$Detayhref&detaymiktararttir=1' $class>+</a><a href='$Detayhref&detayodemearttir=1' $class>$+</a><a href='$Detayhref&detaymiktarazalt=1' $class>-</a><a href='$Detayhref&detayodemeazalt=1' $class>$-</a></td>";
        echo "</tr>";
    }
    $adisyontoplam = $adisyon->AdisyonToplamGetir($adisyonKurye->id);
    echo "<tr>";
    echo "<td>Toplam</td>";
    echo "<td>$adisyontoplam->satmiktar</td>";
    echo "<td>$adisyontoplam->sattutar</td>";
    echo "<td>$adisyontoplam->odmiktar</td>";
    echo "<td>$adisyontoplam->odtutar</td>";
    echo "<td>&nbsp;</td>";
    echo "</tr>";
    echo "</table>";
    $forms->doButton(array('adisyonislem','Tamamini Ode VeKapat','adisyonid'));
    $forms->doButton(array('adisyoniptal','İptal','adisyonid'));
}
echo "</fieldset>";
echo "</form>";
?>
</div>
          </div>
    </div>
        </div>