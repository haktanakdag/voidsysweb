<?php
include '../classes_include.php';
s_start();
$forms = new clsForms();
$admingiris = new Giris(); 
$kullanicigiris= new Kullanicilar();
if($gonder){
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
if(s_get('kullanici')){
    echo "sayfa yenileniyor";
    $geldigi_sayfa = $_SERVER["HTTP_REFERER"];
    //echo $geldigi_sayfa;
    redirect($geldigi_sayfa);
    echo "<meta http-equiv='content-type|default-style|refresh'>";
}
?>

<link href='https://fonts.googleapis.com/css?family=Ubuntu:500' rel='stylesheet' type='text/css'>
    <link href="../css/buttonlink.css" rel="stylesheet" type="text/css"/>
    <style>
        body {
  background:url('');
  margin:0px;
  font-family: 'Ubuntu', sans-serif;
	background-size: 100% 110%;
}
h1, h2, h3, h4, h5, h6, a {
  margin:0; padding:0;
}
.login {
  margin:0 auto;
  max-width:500px;
}
.login-header {
  color:#000;
  text-align:center;
  font-size:300%;
}
/* .login-header h1 {
   text-shadow: 0px 5px 15px #000; } */

.login-form {
  border:.5px solid #fff;
  background:#206bad;
  border-radius:10px;
  box-shadow:0px 0px 10px #000;
}
.login-form h3 {
  text-align:left;
  margin-left:40px;
  color:#fff;
}
.login-form {
  box-sizing:border-box;
  padding-top:15px;
	padding-bottom:10%;
  margin:5% auto;
  text-align:center;
}
.login input[type="text"],
.login input[type="password"] {
  max-width:400px;
	width: 80%;
  line-height:3em;
  font-family: 'Ubuntu', sans-serif;
  margin:1em 2em;
  border-radius:5px;
  border:2px solid #f2f2f2;
  outline:none;
  padding-left:10px;
}
.login-form input[type="button"] {
  height:30px;
  width:100px;
  background:#fff;
  border:1px solid #f2f2f2;
  border-radius:20px;
  color: slategrey;
  text-transform:uppercase;
  font-family: 'Ubuntu', sans-serif;
  cursor:pointer;
}
.sign-up{
  color:#f2f2f2;
  margin-left:-70%;
  cursor:pointer;
  text-decoration:underline;
}
.no-access {
  color:#E86850;
  margin:20px 0px 20px -57%;
  text-decoration:underline;
  cursor:pointer;
}
.try-again {
  color:#f2f2f2;
  text-decoration:underline;
  cursor:pointer;
}

/*Media Querie*/
@media only screen and (min-width : 150px) and (max-width : 530px){
  .login-form h3 {
    text-align:center;
    margin:0;
  }
  .sign-up, .no-access {
    margin:10px 0;
  }
  .login-button {
    margin-bottom:10px;
  }
}
    </style>
    <script type="text/javascript">$('.error-page').hide(0);

$('.login-button , .no-access').click(function(){
  $('.login').slideUp(500);
  $('.error-page').slideDown(1000);
});

$('.try-again').click(function(){
  $('.error-page').hide(0);
  $('.login').slideDown(1000);
});</script>
    
    <div class="login">
  <div class="login-header">
    <h2>VOID SYS Giriş</h2>
  </div>
  <?php $forms->doForm(array('basla','giris','adminpanel.php','form')); ?>
  <div class="login-form">
    <h3>Kullanıcı:</h3>
    <?=$forms->doInput(array("admin","")); ?><br>
    <h3>Şifre:</h3>
      <?=$forms->doInputP(array("sifre","")); ?><br>
            <?=$forms->doButton(array('gonder','Gönder'));?>
<?php $forms->doForm(array('bitir')); ?>
    <br>
  </div>
</div>
<?=$girishatali ?>