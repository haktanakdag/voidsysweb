<div class="w3-row-padding">
<?php 
$yazilar = new Yazi();
if($anahtarid == "hepsi" or !$anahtarid){
    $dkayitlar =$yazilar->YazilariGetir();
}else{
    $dkayitlar = $yazilar->YazilariGetirAnahtaraGore($anahtarid);
}

  $i=0;
  if($dkayitlar)
  foreach($dkayitlar as $dy){
  $i=$i+1;
  if(($i%4)==0){
      echo "</div><div class='w3-row-padding'>";
  }
?>
<div class="w3-third w3-container w3-margin-bottom">
     <div class="w3-container w3-white">
<p><b><?php echo "<a href='index.php?lx=dokumandetay.php&kayitid=$dy->id'>$dy->yaziad</a>"; ?></b></p>
<hr />
<p><?php 
//echo str_replace("yazidetay=","",unserialize($dy->yazidetay));
//echo "<br>";
echo "<a href='index.php?lx=dokumandetay.php&kayitid=$dy->id'>Detay</a>";
?></p>
<?php

$klasor ="../resimler/yazilar/".$dy->id."/";
$klasorthumb ="../resimler/yazilar/".$dy->id."/thumb/";

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
    foreach(@$chanahtarlar as $cha){
    $anahtar = $anahtarlar->AnahtarGetir($cha);
    echo $anahtar->anahtarad;
    echo "&nbsp;";
    }
    ?>
    </div>
    </div>

   <?php } ?>  </div>
      <!--<img src="/w3images/mountains.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">-->

  <!-- Pagination 
  <div class="w3-center w3-padding-32">
    <div class="w3-bar">
      <a href="#" class="w3-bar-item w3-button w3-hover-black">«</a>
      <a href="#" class="w3-bar-item w3-black w3-button">1</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">»</a>
    </div>
  </div>-->
