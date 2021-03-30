<div class="w3-row-padding">
<?php 
$kayitlar = new Urun();
if($anahtarid == "hepsi" or !$anahtarid){
    $dkayitlar =$kayitlar->UrunleriGetir();
}else{
    $dkayitlar = $kayitlar->UrunleriGetirAnahtaraGore($anahtarid);
}

  $i=0;
  foreach($dkayitlar as $dy){

  if(($i%3)==0){
      echo "</div><div class='w3-row-padding'>";
  }
    $i=$i+1;
?>
<div class="w3-third w3-container w3-margin-bottom">
     <div class="w3-container w3-white">
<p><b><?php echo "<a href='index.php?lx=kayitdetay.php&kayitid=$dy->id'>$dy->urunad</a>"; ?></b></p>
<hr />
<p>
<?php

$klasor ="../resimler/urunler/".$dy->id."/";
$klasorthumb ="../resimler/urunler/".$dy->id."/thumb/";

if(is_dir($klasorthumb)==TRUE){
$dizin = opendir($klasorthumb);
echo "<br>";
$patlamisdosya="";
$dosyaad="";
    while($dosya = readdir($dizin)) {
        if(!($dosya=='.' OR $dosya=='..')){
        $dosyaad .= "|".$dosya;
        /*echo  "<a href='$klasor$dosya' class='highslide' onclick='return hs.expand(this)'>";
        echo  "<img src='$klasorthumb$dosya' />";
        echo "</a>";
        echo "<hr>";
         */
        }
    $patlamisdosya = explode("|",$dosyaad);
    $patlamisdosya =$patlamisdosya[1];
    }
    
    //echo print_r($patlamisdosya);
    //echo $patlamisdosya;
    echo  "<a href='$klasor$patlamisdosya' class='highslide' onclick='return hs.expand(this)'>";
    echo  "<img src='$klasorthumb$patlamisdosya' />";
    echo "</a>";
    echo "<hr>";
}
?>

    <?php
    echo "<br>";
    echo "<b>Özellikler :</b>";
    $anahtarlar = new Anahtarlar();
    $chanahtarlar= explode('|',$dy->anahtarlar);
	if(chanahtarlar)
    foreach($chanahtarlar as $cha){
    $anahtar = $anahtarlar->AnahtarGetir($cha);
	if($anahtar->anahtarad<>""){
	echo $anahtar->anahtarad;
    echo ",&nbsp;";
	}
 
    }
    ?>
    </div>
    </div>

   <?php } ?>  </div>
