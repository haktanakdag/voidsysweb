<div class="w3-row-padding">
<?php 
$kayitlar = new Kayit();
if($anahtarid == "hepsi" or !$anahtarid){
    $dkayitlar =$kayitlar->KayitlariGetir();
}else{
    $dkayitlar = $kayitlar->KayitlariGetirAnahtaraGore($anahtarid);
}

  $i=0;
  if ($dkayitlar )
  foreach($dkayitlar as $dy){
  $i=$i+1;
  if(($i%4)==0){
      echo "</div><div class='w3-row-padding'>";
  }
?>
<div class="w3-third w3-container w3-margin-bottom">
     <div class="w3-container w3-white">
<p><b><?php echo "<a href='index.php?lx=kayitdetay.php&kayitid=$dy->id'>$dy->kayitad</a>"; ?></b></p>
<hr />
<p><?php 
echo ckeditor_temizle($dy->kayitdetay);
echo "<br>";
echo "<a href='index.php?lx=kayitdetay.php&kayitid=$dy->id'>Detay</a>";
?></p>
<?php

$klasor ="../resimler/kayitlar/".$dy->id."/";
$klasorthumb ="../resimler/kayitlar/".$dy->id."/thumb/";

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
    foreach($chanahtarlar as $cha){
    $anahtar = $anahtarlar->AnahtarGetir($cha);
    echo $anahtar->anahtarad;
    echo "&nbsp;";
    }
    ?>
    </div>
    </div>

   <?php } ?>  </div>
<div class="w3-container w3-padding-large" style="margin-bottom:32px">
    <h4 id="hakkimizda"><b>Hakkımda</b></h4>
    <p>2010 Yılından bu yana profesyonel olarak yazılım geliştiriyoruz, Bir çok projeye imza attık, bir çok şirket'e çözüm için dokunduk ve sorunlar çözdük. <br>Yazılımlar sorunları çözmek ve hayatı kolaylaştırmak için vardır, Kurumlar her alanda uzman personeli bünyelerinde çalıştıramayabilirler, Bu gibi durumlarda danışmanlıklar devreye girer.
        <br>Bütün sorunların kaynağını tespit etmek, sorunu çözmek için ilk aşamadır. <br> Sorunu tespit etmek ve çözüm üretmek tecrübe yardımıyla uzmanlık ister. Teknoloji çok hızlı ilerlediği için zamanı yakalamak adına dur durak bilmeden çalışmak zorunda olduğumuz bu sektörde
        tecrübe edinebilmek için çok çalıştık. Bugün şimdi birçok konuda çok hızlı çözümler üretebilmeyi geçmişteki çabalarımıza borçluyuz.<br>
    </p>
     <hr>
    
    <h4 id="egitim"><b>Biz kimiz ?</b></h4>
Çeşitli sektörlerde sistem yazılımları geliştirdikten sonra dikey çözümler için yapılan geliştirmeleri ürün haline dönüştürüp, markalaşmayı ve uçtan uca çözümler ile orta ve büyük ölçekli işletmelerin bilgi işlem ve yazılım altyapısındaki sorunlarına çözüm üretmeyi kendine misyon edinmiş bir işletmeyiz.
<br> 2019 yılında Aydın'da kurulan DOKUZ SİSTEM BİLİŞİM SAN. TİC. LTD. ŞTİ aslında bir çok çözümü kendi bünyesinde barındıran bir yazılım şirketidir.<BR>
Üstlendiği her projeden alnının akıyla çıkmayı başaran Dokuz Sistem Bilişim'in geliştirdiği bir çok yazılım çeşitli kurum ve kuruluşlarda çalışmaya devam etmektedir.<br>
Özellikle çözüm ortaklığı mantığıyla çalışan şirketimiz, genellikle büyük ve orta ölçekli firmalara yazılım yapan, kuran ve çözüm geliştiren firmaların'da çözüm ortaklığını yapmaktadır.<br>
Bunlardan bazıları Univera (Enroute Panorama), Dia, Kerzzpos gibi büyük firmalardır.
Çözüm ortaklığı bünyesinde olmayan bir çok kurumsal yazılım çözümüne dikey çözümler geliştirmiş ve çeşitli kurum ve kuruluşlara ürünlerini pazarlamıştır. Örneğin; Netsis, Mikro, Eta gibi büyük kurumsal yazılım çözümlerine dikey çözümler geliştirerek, çözümün merkezi konumunda müşterilerimize ve iş ortaklarımıza iş geliştirmekteyiz.<br>

    <hr>
    <!--  
    <h4>Size Nasıl yardımcı olabilirim ?</h4>
   Pricing Tables 
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-third w3-margin-bottom">
        <ul class="w3-ul w3-border w3-white w3-center w3-opacity w3-hover-opacity-off">
          <li class="w3-black w3-xlarge w3-padding-32">Bronz Hizmet</li>
          <li class="w3-padding-16">Statik web sitesi</li>
          <li class="w3-padding-16">İçerik yönetim sistemi</li>
          <li class="w3-padding-16">Ön Muhasebe yazılımı entegrasyonu</li>
          <li class="w3-padding-16">Kurumsal eposta hizmeti</li>
          <li class="w3-padding-16">Sosyal Medya Danışmanlığı</li>
          <li class="w3-padding-16">Bilişim danışmanlığı</li>
          <li class="w3-light-grey w3-padding-24">
          </li>
        </ul>
      </div>
      
      <div class="w3-third w3-margin-bottom">
        <ul class="w3-ul w3-border w3-white w3-center w3-opacity w3-hover-opacity-off">
          <li class="w3-teal w3-xlarge w3-padding-32">Gümüş Hizmet</li>
          <li class="w3-padding-16">Dinamik web sitesi</li>
          <li class="w3-padding-16">İçerik yönetim sistemi</li>
          <li class="w3-padding-16">Ön Muhasebe yazılımı entegrasyonu</li>
          <li class="w3-padding-16">Kurumsal eposta hizmeti</li>
          <li class="w3-padding-16">Sosyal Medya Danışmanlığı</li>
          <li class="w3-padding-16">Bilişim danışmanlığı</li>
          <li class="w3-padding-16">Telefon Desteği</li>
          <li class="w3-padding-16">Uzaktan Yardım</li>
          <li class="w3-padding-16">Aylık bilgisayar bakımı</li>
          <li class="w3-padding-16">Teknik arıza bakım onarım</li>
        
          <li class="w3-light-grey w3-padding-24">
          </li>
        </ul>
      </div>
      
      <div class="w3-third">
        <ul class="w3-ul w3-border w3-white w3-center w3-opacity w3-hover-opacity-off">
          <li class="w3-black w3-xlarge w3-padding-32">Altın Hizmet</li>
          <li class="w3-padding-16">Dinamik web sitesi E-Ticaret</li>
          <li class="w3-padding-16">İçerik yönetim sistemi</li>
          <li class="w3-padding-16">Ön Muhasebe yazılımı entegrasyonu</li>
          <li class="w3-padding-16">Kurumsal eposta hizmeti</li>
          <li class="w3-padding-16">Sosyal Medya Danışmanlığı</li>
          <li class="w3-padding-16">Bilişim danışmanlığı</li>
          <li class="w3-padding-16">Telefon Desteği</li>
          <li class="w3-padding-16">Uzaktan Yardım</li>
          <li class="w3-padding-16">Aylık bilgisayar bakımı</li>
          <li class="w3-padding-16">Teknik arıza bakım onarım</li>
          <li class="w3-padding-16">24 Saat içinde yerinde servis.</li>
        
          <li class="w3-light-grey w3-padding-24">
          </li>
        </ul>
      </div>
    </div>
  </div>
  -->
  <!-- Contact Section -->
  
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
