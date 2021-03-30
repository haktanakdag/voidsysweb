<?php
if ($secilianahtar==""){
    $secilianahtar =15;
}
$kayitlar = new Kayit();
$dkayitlar = $kayitlar->KayitlariGetirAnahtaraGore($secilianahtar);
?>
<?php
if ($dkayitlar)
foreach($dkayitlar as $dk){
$klasor ="../resimler/kayitlar/".$dk->id."/";
$klasorthumb ="../resimler/kayitlar/".$dk->id."/thumb/";

?>
<div class="col-lg-4 col-md-6 mb-4">
<div class="card">
    <?php
    if(is_dir($klasorthumb)==TRUE){
$dizin = opendir($klasorthumb);
echo "<br>";
$patlamisdosya="";
$dosyaad="";
    while($dosya = readdir($dizin)) {
        if(!($dosya=='.' OR $dosya=='..')){
        $dosyaad .= "|".$dosya;
        }
    $patlamisdosya = explode("|",$dosyaad);
    $patlamisdosya =$patlamisdosya[1];
    }
    
    //echo print_r($patlamisdosya);
    //echo $patlamisdosya;
    echo  "<a href='#'>";
    echo  "<img class='card-img-top' src='$klasor$patlamisdosya' w alt='' />";
    echo "</a>";
}
?>
  <!--<a href="#"><img class="card-img-top" src="./images/Vitrin1.PNG" alt=""></a>-->
  <div class="card-body">
    <h4 class="card-title">
      <a href="#"><?php echo $dk->kayitad ?></a>
    </h4>
    <p class="card-text"><?php echo $dk->kayitdetay; ?></p>
  </div>
</div>
</div>
<?php
}
?>
