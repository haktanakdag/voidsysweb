<?php

    include_once('../classes_include.php');
    s_start();
    if($girisyap){
        $kullanici = new Kullanicilar();
        $dkullanici = $kullanici->KullaniciGirisKontrol($email, $sifre);
        if($dkullanici->id){
            s_set('menukullanici', $dkullanici->id);
            redirect("./");
        }else{
            $girishatali ="<p class='text-white'>Error: Hatalı giriş yaptınız!</p>";
        }
    }
  
    if($cikis){
    s_unlink("menukullanici");
    session_unset();
    $sayfa = "./"; 
    redirect($sayfa);  
    ob_end_flush();
    }
      
    if ($sepeturun){
        $sepet = new Sepet();
        $tarih = date("Y-m-d H:i:s");
        $sepet->SepetEkle(s_get("menukullanici"), $sepeturun, 1, $tarih);
    }
   
?>
<!DOCTYPE html>
<html>
<title>V01D Mobil Menü</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
<link href="./assets/main.css" rel="stylesheet" type="text/css"/>
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
.w3-bar-block .w3-bar-item {padding:20px}
</style>
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBy6yZ7Rm4QtCZ4nNqP-b0z0k_8NRWiQCo&v=3.exp'></script>
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">
  <!-- Bootstrap CSS File -->
<link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Libraries CSS Files -->
<link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="lib/animate/animate.min.css" rel="stylesheet">
<link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
  <!-- Main Stylesheet File -->
<link href="css/style.css" rel="stylesheet">
<body>

<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:40%;min-width:300px" id="mySidebar">
      <div class="col-sm-12">
          <?php 
          //echo s_get("kullanici");
          if(s_get("menukullanici")){
              
            include "girisyapildi.php";
          }else{
              
            include "girisyapust.php";  
            echo $girishatali;
          }
          ?>
        </div>
  <a href="javascript:void(0)" onclick="w3_close()"
  class="w3-bar-item w3-button">Kapat</a>
  <a href="#urunler" onclick="w3_close()" class="w3-bar-item w3-button">Ürünlerimiz</a>
  <a href="#siparis" onclick="w3_close()" class="w3-bar-item w3-button">Siparişlerim</a>
  <a href="#hesap" onclick="w3_close()" class="w3-bar-item w3-button">Hesap</a>
  <a href="#hakkimizda" onclick="w3_close()" class="w3-bar-item w3-button">Hakkımızda</a>
</nav>

<!-- Top menu -->
<div class="w3-top">
  <div class="w3-white w3-xlarge" style="max-width:1200px;margin:auto">
    <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">&#9776;</div>
<?php include 'profilmenu.php';  ?>
    <div class="w3-center w3-padding-16"><b>Blue White Gastro</b>'a hoşgeldiniz. <hr><b>Telefon Numaranız :</b> 05556634987 <hr> <b>Adresiniz : </b> Yedieylül Mah. Çine Caddesi No: 6 /1 Efeler - AYDIN <hr> </div>
      
  </div>
   
</div>

<!-- Top menu -->

<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
  <!-- First Photo Grid-->
  <?php
      include 'vitrin.php';
  ?>
  <hr>
  <!-- About Section -->
    <div class="w3-container w3-padding-32 w3-center">  
     <?php
     include 'odeme.php';
     ?>
  </div>
  <div class="w3-container w3-padding-32 w3-center" id="hakkimizda">  
    <h3>Blue White Cafe Bar & Bistro</h3><br>
    <img src="../images/bwgastro.PNG" alt="Me" class="w3-image" style="display:block;margin:auto" width="800" height="533">
    <div class="w3-padding-32">
      <h4><b>2012 yılından bu yana hizmetinizdeyiz.</b></h4>
      <h6><i>Her yıl sizlerle birlikte daha çok büyüyoruz.</i></h6>
      <p>Bizleri tercih ettiğiniz için teşekkür ederiz.</p>
    </div>
  </div>
  <hr>
  <!-- Footer -->
  <footer class="w3-row-padding w3-padding-32">
    <h2>Benzer Mekanlar</h2>
         <div id="map" style="width: 100%; height: 250px;"></div>
      <script type="text/javascript">
    var locations = [
      ['Koçarlı', 37.760177, 27.706331, 1],
      ['Nazilli', 37.915271, 28.328066, 2],
      ['İncirliova', 37.8535843,27.7233486, 3],
      ['Söke', 37.750468, 27.407007, 4],
      ['Kuşadası', 37.859883, 27.264413, 5],
      ['Didim', 37.376527, 27.267777, 6],
      ['Germencik', 37.870312, 27.602024, 7],
      ['Çine', 37.614843, 28.060787, 8],
      ['Kurtuluş', 37.842602, 27.841886, 9],
      ['Köşk', 37.853891, 28.051978, 10],
      ['Mimar Sinan', 37.851861, 27.812313, 11],
      ['Balık Hali', 37.848699, 27.847052, 12],
      ['Çarşamba', 0,0, 11]
    ];

    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 10,
      center: new google.maps.LatLng(37.844428, 27.841660),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
  </script>
  </footer>

<!-- End page content -->
</div>

<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}
</script>
  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/isotope/isotope.pkgd.min.js"></script>
  <script src="lib/lightbox/js/lightbox.min.js"></script>
  <script src="lib/touchSwipe/jquery.touchSwipe.min.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>
  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

</body>
</html>
