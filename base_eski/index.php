<?php
include_once('../classes_include.php');
s_start();
$forms = new clsForms();
$admingiris = new Giris(); 
$kullanicigiris= new Kullanicilar();
if($giris){
    $admingiriskontrol = $admingiris->AdminGirisKontrol($admin,$sifre);
    $kullanicigiriskontrol =$kullanicigiris->KullaniciGirisKontrol($admin,$sifre);
    if($admingiriskontrol){
        s_set('kullanici','admin');
    }if($kullanicigiriskontrol){
        s_set('kullanici',$kullanicigiriskontrol->id);
    }
    else{
        $girishatali ="<div class='error-page'><div class='try-again'>Error: Try again?</div></div>";
    }
}

if($_SESSION['oauth_provider'] =="Twitter" or $_SESSION['oauth_provider'] =="Facebook" or $_SESSION['oauth_provider'] =="Google" ){
    
    //s_set('kullanici',$_SESSION['logincust']);
    $skullanicivar =$kullanicigiris->SosyalKullaniciGirisKontrol($_SESSION['email']);
    if(isset($skullanicivar->id)){
        $kullanici =$kullanicigiris->KullaniciGetir($skullanicivar->id);
        s_set('kullanici',$kullanici->id);
    }else{
        $randstring =RandomString();
        $kullanici = $kullanicigiris->KullaniciEkle($_SESSION['first_name'].$_SESSION['last_name'], $_SESSION['email'], $randstring, $telefon, $birimid, $unvanid, $gorevid);
        s_set('kullanici',$kullanici->id);
    }
}

if($cikis){
    s_unlink("kullanici");
    session_unset();
    $sayfa = "./"; 
    redirect($sayfa);  
    ob_end_flush();
}

$anahtarlar = new Anahtarlar();
$anahtargruplar = new Listeler();
$anahtargrup = $anahtargruplar->ListeBaslikGetirAciklamayaGore("Anahtar_Gruplari");
if($dokumanlar==1){
$danahtargrup = $anahtargruplar->ListeDetayGetirAciklamayaGore($anahtargrup->id,"Yazılar"); 
$dozelanahtarlar = $anahtarlar->AnahtarlariGetirGrubaGore($danahtargrup->id," and ozel=1");
}else{
$danahtargrup = $anahtargruplar->ListeDetayGetirAciklamayaGore($anahtargrup->id,"Menüler");
$dozelanahtarlar = $anahtarlar->AnahtarlariGetirGrubaGore($danahtargrup->id," and ozel=1");
}
$danahtarlar = $anahtarlar->AnahtarlariGetirGrubaGore($danahtargrup->id);   


?>
<!DOCTYPE html>
<html>
<head>
<title>DOKUZ SİSTEM BİLİŞİM SAN. TİC. LTD. ŞTİ. VOIDEV Developer Haktan AKDAĞ</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="../js/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="../js/jquery.bxslider.js" type="text/javascript"></script>
<link href="../css/bxslider.css" rel="stylesheet" type="text/css"/>
<script>
 $(document).ready(function(){
      $('.bxslider').bxSlider();
    });
</script>
<link href="../css/loading.css" rel="stylesheet" type="text/css"/>
<script src="../js/loading.js" type="text/javascript"></script>
<link href="../css/fieldset.css" rel="stylesheet" type="text/css"/>
<link href="../css/accordion.css" rel="stylesheet" type="text/css"/>
<link rel="shortcut icon" href="../images/vkucuk.ico" type="image/x-icon" />
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

.responsive {
    width: 100%;
    height: auto;
    
}
</style>
<script src="https://www.google.com/recaptcha/api.js?hl=tr"></script>
<link href="../css/login.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="../highslide/highslide-full.js"></script>
<link rel="stylesheet" type="text/css" href="../highslide/highslide.css" />
<script type="text/javascript">
	hs.graphicsDir = '../highslide/graphics/';
	hs.align = 'center';
	hs.transitions = ['expand', 'crossfade'];
	hs.outlineType = 'rounded-white';
	hs.fadeInOut = true;
	hs.dimmingOpacity = 0.75;

	// define the restraining box
	hs.useBox = true;
	hs.width = 640;
	hs.height = 480;

	// Add the controlbar
	hs.addSlideshow({
		//slideshowGroup: 'group1',
		interval: 5000,
		repeat: false,
		useControls: true,
		fixedControls: 'fit',
		overlayOptions: {
			opacity: 1,
			position: 'bottom center',
			hideOnMouseOut: true
		}
	});
</script>

</head><div id="loadingdiv"></div>
<div id="loadedpage"></div>
<body class="w3-light-grey w3-content" style="max-width:1600px">


<!-- Sidebar/menu -->

<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container">
    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
      <i class="fa fa-remove"></i>
    </a>
      <a href="./"><img src="../images/V_14.png" style="width:100%;" class="w3-round"></a>
     <?php if(s_get('kullanici')){
        $kullanicilar = new Kullanicilar();
        $duzenle=  s_get('kullanici');
        $dkullanici= $kullanicilar->KullaniciGetir($duzenle);   
     ?>
    <div class="w3-col s8 w3-bar">
        <span>Merhaba,<br> <strong><?php
      $kullanici ="";
      if($dkullanici->adsoyad==""){
          $kullanici ="Sahip";
      }else {
          $kullanici = $dkullanici->adsoyad;
      }
      echo $kullanici;
      ?></strong></span><br>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="index.php?lx=base.php&kullaniciayar=1" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="./?cikis=1" class="w3-bar-item w3-button"><i class="fa fa-sign-out"></i></a>
    </div>
      <hr>
     <?php } ?>

 
  </div> <div class="w3-container"><h4><b>VOIDEV Developer <br> Haktan AKDAĞ</b></h4></div>  
  <div class="w3-bar-block">
    <a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>PROJELER</a> 
    <a href="#hakkimizda" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>HAKKIMIZDA</a> 
    <a href="index.php?dokumanlar=1" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-large fa-fw w3-margin-right"></i>REFERANSLAR</a> 
    <!--<a href="index.php?lx=sunumlar.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-large fa-fw w3-margin-right"></i>SUNUMLAR</a> -->
    <a href="index.php?lx=iletisim.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-list fa-fw w3-margin-right"></i>İLETİŞİM</a>
    <a href="index.php?lx=../bot/getYoutube.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-list fa-fw w3-margin-right"></i>EĞİTİM</a>
    <a href="index.php?lx=teknolojiler.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-th-list fa-fw w3-margin-right"></i>KÜTÜPHANE</a>
  </div>
 
  <div class="w3-panel w3-large">
    <a href="https://www.facebook.com/enterthevoidev/" target="_blank"><i class="fa fa-facebook-official w3-hover-opacity"></i></a>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <a href="https://twitter.com/haktanakdag" target="_blank"><i class="fa fa-twitter w3-hover-opacity"></i></a>
    <a href="https://tr.linkedin.com/in/haktan-akda%C4%9F-b0a5b657/" target="_blank"><i class="fa fa-linkedin w3-hover-opacity"></i></a>
	
  </div>
   <div class="w3-panel w3-large">
   <img src="../images/github.png" width="250px" height="100px">
  <?php
  include "../bot/getGitHub.php";
  ?>
  </div>
  <img src="../images/twitter.png" width="250px" height="100px">
  <?php
  include "../bot/getTwitter.php";
  ?>
  <img src="../images/facebook.png" width="250px">
  <?php
  include "../bot/getFacebook.php";
  ?>
</nav>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px">

  <!-- Header -->
<header id="anasayfa">
<span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
<div class="w3-container">
<ul class="bxslider">
<li><img src="./tech/slide9.jpeg" alt=""></li>
<li><img src="./images/slide1.png" alt=""></li>
<li><img src="./images/slide2.png" alt=""></li>
<li><img src="./tech/slide10.png" alt=""></li>
<li><img src="./tech/slide1.png" alt=""></li>
<li><img src="./tech/slide2.png" alt=""></li>
<li><img src="./tech/slide3.png" alt=""></li>
<li><img src="./tech/slide4.png" alt=""></li>
<li><img src="./tech/slide5.png" alt=""></li>
<li><img src="./tech/slide6.png" alt=""></li>
<li><img src="./tech/slide7.png" alt=""></li>
<li><img src="./tech/slide8.png" alt=""></li>
<li><img src="./tech/slide9.png" alt=""></li>

</ul>
    <hr>
<?php
if(isset($kullaniciayar) and s_get('kullanici')){
?>
<div class="profilecontainer">
<div class="content">
<?php
include 'kullanici.php';
?>
<a href='./?cikis=1' class="w3-button w3-black w3-margin-bottom">Çıkış </a>
</div>
</div>
<?php
}else if (s_get('kullanici')==null){
include "kullanicigiris.php";
} 
?>
  <div class="w3-bar w3-border w3-card-4 w3-light-grey">
     
  <?php 
  $url =$_SERVER['REQUEST_URI'];
  $url1 =explode("?",$url);
  $url2 =explode("&",$url1[1]);
  $url =$url1[0]."?".$url2[0]; 
  ?>
 
  <?php
  if($dozelanahtarlar){
      echo  "<a href='index.php?anahtarid=hepsi' class='w3-bar-item w3-button w3-black'>Hepsi</a>";
  foreach ($dozelanahtarlar as $doa){
      echo "<a href='$url&anahtarid=$doa->id' class='w3-bar-item w3-button'>$doa->anahtarad</a>";
  }
  }
  ?>
</div>  <hr>
    </div>
  </header>
  
 <?php
        if(@$lx){
            include $lx;
        }else{
            if($dokumanlar==1){
            include './dokumanbase.php';
            }else{
            include './kayitbase.php';
            }
        }
        ?>
  
  <!-- Footer -->
  <footer class="w3-container w3-padding-32 w3-dark-grey">
  <div class="w2-row-padding">
  
    <div class="w2-third">
      <h3>Anahtar kelimeler</h3>
      <p>
        <?php
        foreach ($danahtarlar as $doa){
            echo "<span class='w3-tag w3-grey w3-small w3-margin-bottom'>$doa->anahtarad</span> &nbsp;";
        }
        ?>
       </p>
    </div>
  <div class="w2-third">
      <h4>Teşekkürü bir borç biliriz..</h4>
      <p>Microsoft Ürünleri</p>
      <img src="images/microsofturunleri.png" alt="" class="responsive"/>
      <p>Veritabanı Teknolojileri</p>
      <img src="images/veritabanicasitleri.png" alt="" class="responsive"/>
      <p>Web Teknolojileri</p>
      <img src="images/webtools.png" alt="" class="responsive"/>
	  <p> Mobil Programlama</p>
      <img src="images/mobile.png" alt="" class="responsive"/>
      <p> Kullanıcı arayüzü araçları</p>
      <img src="images/uiaraclari.png" alt="" class="responsive"/>
	  <p> Açık Kaynak Kodlu İçerik Yönetim Sistemleri</p>
      <img src="images/cmssistemleri.png" alt="" class="responsive"/>
	  <p> Ticari Paket Programları</p>
      <img src="images/ticaripaketler.png" alt="" class="responsive"/>
	  <p> Ön Muhasebe Sistemleri</p>
      <img src="images/onmuhasebe.png" alt="" class="responsive"/>
	  
    </div>
  </div>
  </footer>
  
  <div class="w3-black w3-center w3-padding-24">Powered by <a href="#" title="W3.CSS" target="_blank" class="w3-hover-opacity">VOIDEV Developer, Haktan Akdağ (Geliştirici)</a></div>

<!-- End page content -->
</div>

</body>
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
</script>


</body>
</html>
