<body>
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
echo "<legend> Defter Rapor</legend>";
$raporlar->RaporOlusturSSP("defter_rapor_ssp",array($basislemtarih,$bitislemtarih,$sirketid),array('id','sirketad','projead','islem','aciklama','islemtarih','cikis','giris','detayaciklama'));
echo "</fieldset>";
/**/
/*
echo "<fieldset>";
echo "<legend> Defter Rapor</legend>";
$raporlar->RaporOlustur("defter_rapor");
echo "</fieldset>";

echo "<fieldset>";
echo "<legend> Defter Rapor</legend>";
$raporlar->RaporOlustur("defter_rapor2");
echo "</fieldset>";
*/
?>
 
</body>
</html>
