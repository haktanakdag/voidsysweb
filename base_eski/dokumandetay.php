<div class="w3-row-padding">
<?php 
$kayitlar = new Yazi();
$dkayit =$kayitlar->YaziGetir($kayitid);

?>
<div class="w3-secont w3-container w3-margin-bottom">
     <div class="w1-container w3-white">
<p><b><?=$dkayit->yaziad ?></b></p>
<hr />
<p><?=str_replace("yazidetay=","",unserialize($dkayit->yazidetay)) ?></p>
<?php

$klasor ="../resimler/yazilar/".$dkayit->id."/";
$klasorthumb ="../resimler/yazilar/".$dkayit->id."/thumb/";

if(is_dir($klasorthumb)==TRUE){
$dizin = opendir($klasorthumb);
echo "<br>";
    while($dosya = readdir($dizin)) {
        if(!($dosya=='.' OR $dosya=='..')){
           echo  "<a href='$klasor$dosya' class='highslide' onclick='return hs.expand(this)'>";
           echo  "<img src='$klasorthumb$dosya' />";
           echo "</a>";
           echo "&nbsp;";
        }
    }
}
?>
     </div></div></div>
    <?php
    echo "<br>";
    echo "<b>Özellikler :</b>";
    $anahtarlar = new Anahtarlar();
    $chanahtarlar= explode('|',$dkayit->anahtarlar);
    foreach($chanahtarlar as $cha){
        $anahtar = $anahtarlar->AnahtarGetir($cha);
        if($anahtar<>""){
        echo $anahtar->anahtarad;
        echo ", &nbsp;";
        }
    }

            ?>

