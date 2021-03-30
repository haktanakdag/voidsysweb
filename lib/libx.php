<?php
/*function session_deger_getir($session){
	$ses= get_object_vars($session);
			foreach ($ses as $s){
				$rs= $s;
			}
	return $rs;
}*/

function redirect($url){ 
if (!headers_sent()){ 
header('Location: '.$url); exit; 
}else{ 
echo '<script type="text/javascript">'; 
echo 'window.location.href="'.$url.'";'; 
echo '</script>'; 
echo '<noscript>'; 
echo '<meta http-equiv="refresh" content="0;url='.$url.'" />'; 
echo '</noscript>'; exit; 
} 
} 

function recaptchaKontrol($recaptha){
    if (isset($recaptha)) {
        $captcha = $recaptha;
    }
    if (!$captcha) {
        echo '<h2>Lütfen robot olmadığınızı doğrulayın.</h2>';
        exit;
    }
    $kontrol = @file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcdtFgUAAAAADyd5grfVrD1qMx27z_QcnCpmr_e&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
    if ($kontrol.success == false) {
        echo '<h2>Spam Gönderi!</h2>';
        return false;
    } else {
        return true;
    }
}

function RandomString()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randstring = '';
    for ($i = 0; $i < 10; $i++) {
        $randstring = $characters[rand(0, strlen($characters))];
    }
    return $randstring;
}

/*
function redirect($url) {
    header("location: " . $url);
} */

function ckeditor_temizle($deger){
   $deger= str_replace("%<p>&nbsp;</p>%", " ",$deger);
   $deger= str_replace("%<p>/n</p>%", " ",$deger);
   $deger= str_replace("%<br>%", " ",$deger);
   return str_replace("<br />", " ",$deger);
   
}

//Bir dosyaya yaz� yazd�rmak i�in kullan�l�r. $tur 1 verilmesi durumunda dosyaya ekleme yapar �zerine yazmaz.
function dosyayaYaz($dosya, $yazilacak, $tur = 0) {
	$tip = ($tur) ? "a" : "w";
	$fh = fopen ( $dosya, $tip );
	fwrite ( $fh, $yazilacak );
	fclose ( $fh );
}


//bu da dizi i�in se
function ex_se($veri) {
	if (is_array ( $veri )) {
		foreach ( $veri as $q => $d ) {
			$d = se ( $d );
			$sonuc [$q] = $d;
		}
	} else {
		$sonuc = se ( $veri );
	}
	return $sonuc;
}

//�zel karakterleri gizler
function escape($str) {
	$trans = get_html_translation_table ( HTML_ENTITIES );
	return strtr ( $str, $trans );
}
//�zel karakterleri eki haline getirir
function unescape($str) {
	$trans = array_flip ( get_html_translation_table ( HTML_ENTITIES ) );
	return strtr ( $str, $trans );
}

// Stringi barcoda �evirir \\
function i($inStr, $yaz = 0) {
	define ( 'ZERO', 'l' ); // lowercase L
	define ( 'ONE', '|' ); // pipe symbol -- I made sure this worked using phpinfo()
	define ( 'DELIM', 'i' );
	$bc = '';
	$x = 0;
	while ( $inStr [$x] != '' ) {
		// characters in a string can be accessed like a zero-based array
		$bc .= str_replace ( '1', ONE, str_replace ( '0', ZERO, decbin ( ord ( $inStr [$x] ) - 32 ) ) ) . DELIM;
		$x ++;
	}
	if ($yaz) {
		echo substr ( $bc, 0, - 1 );
	} else {
		return substr ( $bc, 0, - 1 );
	}
}

// Barcodu stringe �evirir \\
function ii($inBCStr) {
	define ( 'ZERO', 'l' ); // lowercase L
	define ( 'ONE', '|' ); // pipe symbol -- I made sure this worked using phpinfo()
	define ( 'DELIM', 'i' );
	$bcArray = explode ( DELIM, $inBCStr );
	$str = '';
	foreach ( $bcArray as $bcChar ) {
		// foreach() is php4+ only; for php3 use list...each
		$str .= chr ( bindec ( str_replace ( ZERO, '0', str_replace ( ONE, '1', $bcChar ) ) ) + 32 );
	}
	return $str;
}

//Zaman� saniye cinsinden unix timestamp olarak g�nderir (Ge�en 35 y�l� stamptan ��kar�r)
function zaman() {
	return time () - (35 * (60 * 60 * 24 * 365));
}

//flashdan gelen herhangi bir dizi grubunu t�rk�e uyumlu hale getirebilirsiniz
//EXTRACT fonksiyonunun i�levini t�rk�eye �evirerek yapar
function ex_tr($veri) {
	foreach ( $veri as $q => $d ) {
		$d = tr ( $d );
		$sonuc [$q] = $d;
	}
	return $sonuc;
}

//g�nderilen verinin mail yaz�m format�na uygun olup olmad���n� s�yler.
function mailMi($veri) {
	$ctrl = preg_match ( "/^[a-zA-Z0-9_\-]+@[a-zA-Z0-9_\-]+\.[a-zA-Z0-9_\-]+|[a-zA-Z0-9_\-]+@[a-zA-Z0-9_\-]+\.[a-zA-Z0-9_\-]+\.[a-zA-Z0-9_\-]+$/", $veri );
	return ($ctrl) ? 1 : 0;
}

//verinin max karakter say�s�nda olup olmad���n� denetler.
function maxis($veri, $encok) {
	$ctrl = ((strlen ( $veri ) > $encok)) ? 0 : 1;
	return $ctrl;
}
////verinin min karakter say�s�nda olup olmad���n� denetler.
function minis($veri, $enaz) {
	$ctrl = ((strlen ( $veri ) < $enaz)) ? 0 : 1;
	return $ctrl;
}
//verinin kullan�c� ad� format�na uyup uymad���n� denetler.
function kidMi($veri) {
	$ctrl = preg_match ( "/^[0-9a-zA-Z][0-9a-zA-Z_]+$/", $veri );
	return ($ctrl) ? 1 : 0;
}

function websiteMi($veri) {
	$ctrl = preg_match ( "/^[0-9a-zA-Z]+\.[0-9a-zA-Z]+|[0-9a-zA-Z]+\.[0-9a-zA-Z]+\.[0-9a-zA-Z]+|[0-9a-zA-Z]+\.[0-9a-zA-Z]+\.[0-9a-zA-Z]+\.[0-9a-zA-Z]+$/", $veri );
	return ($ctrl) ? 1 : 0;
}

function guvenliMi($veri) {
	$ctrl = preg_match ( "/^[0-9a-zA-Z������������][0-9a-zA-Z������������_.\/ ,;:\-]+$/", $veri );
	return ($ctrl) ? 1 : 0;
}

//flashdan gelen herhengi bir dei�kenin karakter kodlamas�n� t�rk�e uyumlu hale �evirir
function tr($veri) {
	$veri = ereg_replace ( 'ö', "�", $veri );
	$veri = ereg_replace ( 'ü', "�", $veri );
	$veri = ereg_replace ( 'Ö', "�", $veri );
	$veri = ereg_replace ( 'Ü', "�", $veri );
	$veri = ereg_replace ( 'ş', "�", $veri );
	$veri = ereg_replace ( '�?', "�", $veri );
	$veri = ereg_replace ( 'ç', "�", $veri );
	$veri = ereg_replace ( 'Ç', "�", $veri );
	$veri = ereg_replace ( 'ğ', "�", $veri );
	$veri = ereg_replace ( '�?', "�", $veri );
	$veri = ereg_replace ( 'ı', "�", $veri );
	$veri = ereg_replace ( 'İ', "�", $veri );
	$veri = ereg_replace ( '���', "", $veri );
	$veri = ereg_replace ( '�', "�", $veri );
	$veri = ereg_replace ( '�', "�", $veri );
	$veri = ereg_replace ( "\?", "�", $veri );
	$veri = ereg_replace ( '���', "�", $veri );
	$veri = ereg_replace ( '�', "�", $veri );
	$veri = ereg_replace ( 'ç', "�", $veri );
	$veri = ereg_replace ( 'Ç', "�", $veri );
	return $veri;
}

//Tarihi d�nd�r�r
function tarih() {
	$zaman = getdate ();
	$tarih = $zaman ['mday'] . " " . $zaman ['mon'] . " " . $zaman ['year'];
	return $tarih;
}

function bugun() {
	$zaman = getdate ();
	if($zaman ['mon']<10)
	{
	$ay ="0".$zaman ['mon'];
	}
	if($zaman ['mon']<10)
	{
	$gun ="0".$zaman ['mday'];
	}
	$tarih = $zaman ['year'].$ay.$gun;
	return $tarih;
}

//deger yerine 28|01|2004 gibi bir de�er girin girdi�iniz tarihten bu yana ge�en s�reyi hesaplar
//tur yerine g -g�n, s -saniye, d -dakika h -saat parametrelerinden atayabilrsiniz
function gecenSure($deger, $tur = "d") {
	$s = 1;
	$d = 60;
	$h = 60 * 60;
	$g = 60 * 60 * 24;
	
	$tarih = explode ( "|", $deger );
	$sonuc = floor ( (time () - mktime ( 0, 0, 0, $tarih [1], $tarih [0], $tarih [2] )) / ($$tur) );
	return $sonuc;
}

//trim fonksiyonunun \n \t \r ve <TAG> gibi karakterleri de kapsad��� bi fonksiyon
function kes($veri) {
	if (is_array ( $veri )) {
		foreach ( $veri as $d ) {
			$d = trim ( $d );
			$d = eregi_replace ( "[\n\r\t]", '', $d );
			$d = strip_tags ( $d );
			$veri [] = $d;
		}
		return $veri;
	} else {
		$veri = trim ( $veri );
		$veri = eregi_replace ( "[\n\r\t]", '', $veri );
		$veri = strip_tags ( $veri );
		return $veri;
	}
}

//Se�ti�iniz bir diziyi pre format�nda yazd�r�r
function diziYaz($dizi, $dondur = 0) {
	if ($dondur) {
		$sonuc = print_r ( $dizi, true );
		return $sonuc;
	} else {
		echo "<PRE><h4><strong><font color=red>|==============================|<i><font color=darkblue face=tahoma>\n";
		print_r ( $dizi );
		echo "</font></i><br>|==============================|</font></strong></h4></PRE>";
		return true;
	}
}


//Flasha deisken g�nderen bir fonksiyon yaz�m �ekli 'deisken=deger|deisken2=deger2' deisken say�s� �o�alt�labilir
//$bicim parametresi 1 se�ilirse direk g�nderme yap�lmaz fonksiyon de�eri bir de�i�kene ataman�z i�in d�nd�r�r
// "|" ayr�c�s�n�n �n�ne ve arkas�na enter bas�labilir fonksiyon yine de alg�layacakt�r.
function flasaVer($veri, $bicim = 0) {
	$veri = trim ( $veri );
	$veri = ereg_replace ( "�", "%C3%BC", $veri );
	$veri = ereg_replace ( "�", "%C3%9C", $veri );
	$veri = ereg_replace ( "�", "%C3%B6", $veri );
	$veri = ereg_replace ( "�", "%C3%96", $veri );
	$veri = ereg_replace ( "�", "%C5%9E", $veri );
	$veri = ereg_replace ( "�", "%C3%87", $veri );
	$veri = ereg_replace ( "�", "%C5%9F", $veri );
	$veri = ereg_replace ( "�", "%C3%A7", $veri );
	$veri = ereg_replace ( "�", "%C4%9E", $veri );
	$veri = ereg_replace ( "�", "%C4%9F", $veri );
	$veri = ereg_replace ( "�", "%C4%B0", $veri );
	$veri = ereg_replace ( "�", "%C4%B1", $veri );
	$veri = ereg_replace ( '<', "%3C", $veri );
	$veri = ereg_replace ( '>', "%3E", $veri );
	/*$veri = ereg_replace ("<","%3C",$veri);
	$veri = ereg_replace ("<","%3C",$veri);*/
	
	$veri = ereg_replace ( "\|" . "\n", "\|", $veri );
	$veri = ereg_replace ( "\n" . "\|", "\|", $veri );
	$veri = ereg_replace ( "\|" . "\r", "\|", $veri );
	$veri = ereg_replace ( "\r" . "\|", "\|", $veri );
	$veri = ereg_replace ( '&', '%26', $veri );
	$veri = ereg_replace ( "\+", '%2B', $veri );
	if (ereg ( "\|", $veri )) {
		$veriler = explode ( '|', $veri );
		$veri = "";
		foreach ( $veriler as $d ) {
			$veri .= '&' . $d;
		}
	} else {
		$veri = '&' . $veri;
	}
	if ($bicim) {
		return $veri;
	} else {
		echo $veri;
		return true;
	}
}
//Web sayfa(lar)�n� tarayarak i�inden istedi�iniz metin k�mesini getirir
/*Parametreler
$on : istedi�iniz katar�n �n�nde kalan k�s�m
$arka : istedi�iniz katar�n arkas�nda kalan k�s�m
$link : i�inden kesmek istedi�iniz link verisi
$ilk_deger : Bir PHP(ASP) linkinden veri �ekerken bir k�sm� s�rekli artan bir linkler k�mesine ula�mak isteyebilirsiniz
bu durumda linkte say�n�n oldu�u yere || koyun ve buraya bir ilk deger belirleyin.
$son_deger : || i�in son de�er.
*/
function gitGetir($on, $arka, $link) {
	if (! $veri = file_get_contents ( $link )) {
		$sonuc = 0;
	} else {
		$sonuc = 1;
	}
	$sonuc = araDeger ( $on, $arka, $veri );
	return $sonuc;
}


function buf_include($filename) {
	if (is_file ( $filename )) {
		ob_start ();
		include $filename;
		$contents = ob_get_contents ();
		ob_end_clean ();
		return $contents;
	}
	return "Dosya bulunamad�... -> $filename";
}
function gunDeger($string) {
	list ( $gun, $ay, $yil ) = explode ( " ", $string );
	switch ( $ay) {
		case "Ocak" :
			$ay = 1;
		break;
		case "�ubat" :
			$ay = 2;
		break;
		case "Mart" :
			$ay = 3;
		break;
		case "Nisan" :
			$ay = 4;
		break;
		case "May�s" :
			$ay = 5;
		break;
		case "Haziran" :
			$ay = 6;
		break;
		case "Temmuz" :
			$ay = 7;
		break;
		case "A�ustos" :
			$ay = 8;
		break;
		case "Eyl�l" :
			$ay = 9;
		break;
		case "Ekim" :
			$ay = 10;
		break;
		case "Kas�m" :
			$ay = 11;
		break;
		case "Aral�k" :
			$ay = 12;
		break;
	}
	$gunsay = array (0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 );
	if ($yil % 4 == 0) {
		$gunsay [2] = 29;
	}
	$yilsay = ($yil - 2000) * 365;
	for($i = 1; $i <= $ay - 1; $i ++) {
		$aysay += $gunsay [$i];
	}
	$toplam = $gun + $aysay + $yilsay;
	return $toplam;
}
?>