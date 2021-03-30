<?php
$raporlar = new Raporlar();
if(!$sirketid){
    $sirketid ='1';
}

$tarih =getdate();

if(!$basislemtarih){
    $basislemtarih ='01/01/'.$tarih[year].'';
}
if(!$bitislemtarih){
    $bitislemtarih ='12/31/'.$tarih[year].'';
}


echo "<fieldset>";
echo "<legend> BT Rapor</legend>";
$raporlar->RaporOlusturSSP("RptGorevler",array($basislemtarih,$bitislemtarih),array('id','gorevad','gorevdetay','durum','kullanici','gorevtarih','duzenlemetarih'));

echo "</fieldset>";

?>
 