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

$query= "SELECT id,mamkod,mamad,uretmiktar,hamkod,hamad,tuketmiktar,depokod,tarih from v_rpt_uretim order by id desc";
$raporkol=array('id','mamkod','mamad','uretmiktar','hamkod','hamad','tuketmiktar','depokod','tarih');
echo "<fieldset>";
echo "<legend>Üretimler</legend>";
$raporlar->RaporOlusturWithQuery($query,$raporkol,"rpt_uretim");
echo "</fieldset>";
?>