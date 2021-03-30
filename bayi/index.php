<?php
include_once('../classes_include.php');
s_start();
?>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>VDF Teknoloji</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/shop-homepage.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="css/login.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    <?php
    $anahtarlar = new Anahtarlar();
    $danahtarlar = $anahtarlar->AnahtarlariGetirGrubaGore(41 ," and ozel=1");
    ?>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#"></img>VDF Teknoloji Ltd. Şti.</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Anasayfa
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Hakkımızda</a>
          </li>
            <?php
            foreach($danahtarlar as $a){
                echo "<li class='nav-item'> <a class='nav-link' href='index.php?secilianahtar=$a->id'>" . $a->anahtarad ."</a></li>";
            }
            ?>
          <li class="nav-item">
            <a class="nav-link" href="#">İletişim</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
          <h3 class="my-4"><img src="./images/vdLogo2.png"></img>VDF Teknoloji</h3>
      <?php //include 'login.php'; ?>
      <?php include 'solmenu.php'; ?>
          <hr>
      <ul class="list-group">
          <li class="list-group-item"><img src="../images/twitter.png" width="220px" height="100px">  <?php include "getTwitter.php"; ?> </li>
          <li class="list-group-item">  <img src="../images/facebook.png" width="220px"> <?php include "getFacebook.php"; ?> </li>
</ul>
  
  
      </div>
      <!-- /.col-lg-3 -->
      <div class="col-lg-9">
        <?php include 'slide.php'; ?>
        <div class="row">
         <?php
         include 'vitrin.php';
         ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; VoidSYSWeb</p>
    </div>
    <!-- /.container -->
  </footer>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
