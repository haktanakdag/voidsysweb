 <?php
 $anahtarlar = new Anahtarlar();
 $anahtarlard = $anahtarlar->AnahtarlariGetirGrubaGore(10);
 $danahtarlar = $anahtarlar->AnahtarlariGetirGrubaGore(10);

 $urunler = new Urun();
 $urunler =$urunler->UrunleriGetir();
 
 ?>
<section id="portfolio"  class="section-bg" >
      <div class="container" id="urunler">

        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Hepsi</li>
              <?php
              foreach ($danahtarlar as $da){
                  echo "<li data-filter='.filter-$da->anahtarad'>$da->anahtarad</li>";
              }
              ?>
            </ul>
          </div>
        </div>
        <div class="row portfolio-container">
         <?php
                                    foreach($urunler as $an){
$klasor ="../resimler/urunler/".$an->id."/";
$klasorthumb ="../resimler/urunler/".$an->id."/thumb/";

if(is_dir($klasorthumb)==TRUE){
$dizin = opendir($klasorthumb);
$patlamisdosya="";
$dosyaad="";
    while($dosya = readdir($dizin)) {
        if(!($dosya=='.' OR $dosya=='..')){
        $dosyaad .= "|".$dosya;
        }
    $patlamisdosya = explode("|",$dosyaad);
    $patlamisdosya =$patlamisdosya[1];
    }
    //echo $an->anahtarlar;
    $anahtarid = str_replace("|","",$an->anahtarlar);
    $anahtar= $anahtarlar->AnahtarGetir($anahtarid);
    //echo "<img data-gallery-tag='$anahtar->anahtarad' class='gallery-item' src='$klasor$patlamisdosya' /></img>";
    echo"<div class='col-lg-4 col-md-6 portfolio-item filter-$anahtar->anahtarad wow fadeInUp'>
            <div class='portfolio-wrap'>
              <figure>
                <img src='$klasor$patlamisdosya' class='img-fluid' alt=''>
                <a href='$klasor$patlamisdosya' data-lightbox='portfolio' data-title='$anahtar->anahtarad' class='link-preview' title='Preview'><i class='ion ion-eye'></i></a>
                <a href='#' class='link-details' title='$an->urunad'><i class='ion ion-android-cart'></i></a>
              </figure>
              <div class='portfolio-info'>
                <h4><a href='#'>$an->urunad</a></h4>
                <p>$an->urunad</p>
              </div>
            </div>
          </div>";
}
}
?>

        </div>

      </div>
    </section>