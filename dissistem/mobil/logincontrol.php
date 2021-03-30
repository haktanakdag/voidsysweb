<?php
header('Content-Type: text/html; charset=utf-8');
include '../../s_cls/dbclass.php';
include '../../s_cls/sessions.php';
include '../../s_cls/cls_kullanicilar.php';

//$email = trim($_GET['email']);
//$pass = trim($_GET['pass']);
$email = trim($_POST['email']);
$pass = trim($_POST['pass']);
$kullanicigirdi =false;
//echo "Hello $name! Welcome to android Tech Point.\nYour email is $email";
$kullanicigiris= new Kullanicilar();
if($email){
    $kullanicigiriskontrol =$kullanicigiris->KullaniciGirisKontrol($email,$pass);
    if($kullanicigiriskontrol){
        s_set('kullanici',$kullanicigiriskontrol->id);
		$kullanicigirdi=true;
    }else{
		$kullanicigirdi=false;
	}
}

if($kullanicigirdi){
	//s_get('kullanici')
	echo "Kullanıcı Girişi Başarılı";
}else{
    echo "Kullanıcı Girişi Başarısız";
}
?>