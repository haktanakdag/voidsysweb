<!DOCTYPE html>
<html lang="en">
<title>W3.CSS Template</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
<link href="./css/style.build.css?v=4" rel="stylesheet" type="text/css"/> 
<script type="text/javascript" src="https://tags.tiqcdn.com/utag/vodafone/tr-main/prod/utag.sync.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<link href="css/w3slider.css" rel="stylesheet" type="text/css"/>

<style>    
body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
body {font-size:16px;}
.w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
.w3-half img:hover{opacity:1}
</style>

<body>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-red w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container">
      <br>
    <img src="./images/vdLogo2.png"></img>
    <h3 class="w3-padding-64"><b>VDF TEKNOLOJİ</b></h3>
  </div>
  <div class="w3-bar-block">
    <a href="#" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Anasayfa</a> 
    <a href="#showcase" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Kampanyalar</a> 
    <a href="#services" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Haberler</a> 
    <a href="#designers" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Ürünler</a> 
    <a href="#packages" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Foto Galeri</a> 
    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">İletişim</a>
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">
  <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
  <span>TABAKOĞLU</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:340px;margin-right:40px">

  <!-- Header -->
<div class="w3-container" style="margin-top:80px" id="showcase">
<?php
include "slider.php";
?> 
 </div>
  <hr style="width:100%;border:5px solid red" class="w3-round">
  <?php
include "populer_telefonlar.php";
?>
  <hr style="width:100%;border:5px solid red" class="w3-round">

<?php
include "onecikan_tarifeler.php";
?>
  <hr style="width:100%;border:5px solid red" class="w3-round">

  
<!-- End page content -->
</div>
<!-- W3.CSS Container -->
<style>
.footcont {
    margin-top:75px;padding-left:300px;width:100%;
}
@media (max-width: 990px) {
    .footcont {
       margin-top:75px;padding-left:10px;width:100%
    }
}
</style>
<div class="footcont" >
<?php
include "footer.php";
?>
</div>
<script src="js/w3slider.js" type="text/javascript"></script>
<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}
</script>

</body>
</html>
