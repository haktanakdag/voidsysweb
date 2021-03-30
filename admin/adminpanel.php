<?php
include_once('../classes_include.php');

s_start();
if($cikis){
    s_unlink("kullanici");
    $sayfa = "./";
    redirect($sayfa);
    ob_end_flush();
}
if(!s_get('kullanici')){
	include 'admingiris.php';
}else{
if(s_get('kullanici')=="admin"){
$kullanici ="Admin";
}else{
$dkul = new Kullanicilar();
$dkuladsoyad =$dkul->KullaniciGetir(s_get('kullanici'));
$kullanici =$dkuladsoyad->adsoyad;
}
?>
<html>
<?php include "head.php"; ?>
<div id="loadingdiv"></div>
<div id="loadedpage">
<body class="w3-light-grey">
<!--<div class="animsition"   data-animsition-in-class="fade-in"
  data-animsition-in-duration="1000"
  data-animsition-out-class="fade-out"
  data-animsition-out-duration="800">-->
<!-- Top container -->


<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right"><a href="adminpanel.php?cikis=1" class="btn">Çıkış</a></span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
        <a href="./"><img src="../images/voidlogo.png" class="w3-circle w3-margin-right" style="width:92px"></a>
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Merhaba, <strong><?=$kullanici?></strong></span><br>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard Menü</h5>
  </div>
  <div class="searchContend_h">
        <div class="ui-grid-c">
            <div class="ui-block-a">
                <input name="text-12" id="text-12" value="" type="text" class="textSearchvalue_h" />
                 <a href="#" class="searchButtonClickText_h">Ara</a>
            </div>
            <div id="realTimeContents">
            <?php
                $anasayfa=0;
                include("../menu/menu.php");
            ?>
            </div>
        </div>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:310px;margin-top:5px;">
  <header class="w3-container" style="padding-top:22px">
    <h2><b><i class="fa fa-dashboard"></i> V01D3V Dashboard</b></h2>
   <?php
   if($lx){
   ?>
    <a href="javascript:history.go(-1)" title="Önceki sayfaya dön">&laquo; Geri</a>
   <?php } ?>
  </header>
       <?php
        if($_GET[lx]){
        include($_GET[lx]);
        }else{
        include("base.php");
        }
   ?>
</div>
</div>
<!--<script src="../js/animsition.min.js" charset="utf-8"></script>
<script>
$(document).ready(function() {
  $('.animsition').animsition();
});
</script>-->

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
    if (mySidebar.style.display === 'block') {
        mySidebar.style.display = 'none';
        overlayBg.style.display = "none";
    } else {
        mySidebar.style.display = 'block';
        overlayBg.style.display = "block";
    }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
    overlayBg.style.display = "none";
}
</script>

</body>
</html>
<?php
}
?></div>
