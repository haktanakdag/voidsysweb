<?php include "../classes_include.php"; ;?>
<?php include "head.php"; ?>
<div id="wrap">
<?php 
if($anketid){
$form = new clsForms();
$anket = new Anket();
$danket=$anket->AnketGetir($anketid);
$danketsorular = $anket->AnketUygulamaSorulariGetir($anketid);

$parametreler = new Parametreler();
$listeler = new Listeler();
$dcinsiyet = $parametreler->ParametreGetirA ( "cinsiyet" );
$dcinsiyetlistedurum = $listeler->listeDetayGetirC ( $dcinsiyet->deger );

$dsorutip = $parametreler->ParametreGetirA ( "anketsorutip" );
$danketsorutip = $listeler->listeDetayGetirC ( $dsorutip->deger );
foreach ($danketsorutip as $st)
{
	if($st->ldaciklama=="karakter"){
		$karakter=$st->id;
	}
	if($st->ldaciklama=="sayisal"){
		$sayisal=$st->id;
	}
}
if($yayinla<>1){
	$form->doBaglanti(array('anketler','Geri',$_SERVER['HTTP_REFERER']));
	//$form->doBaglanti(array('yayinla','Dışarıya Yayınla','../dissistem/dissistem.php?lx=../admin/anketuygula.php&yayinla=1&anketid='.$anketid,'','blank'));
}
$form->doForm(array('basla'));
?>

<fieldset>
    <legend>Anket Adı : <?=$danket->anketad ?></legend>
<?php
if($anketuygulamaislem){
	if(!$adsoyad or !$email or !$telefon){
		echo "(*) Boş bırakılamaz alanları doldurup tekrar deneyiniz.";
		$form->doBaglanti(array('','Geri',$_SERVER['HTTP_REFERER']));
	}else{
		$anketcevapbaslikid =$anket->AnketCevapBaslikEkle($anketid,$adsoyad,$cinsiyetid,$email,$telefon,$adres);
		foreach($danketsorular as $danketsoru){
			$cevap = "soru_".$danketsoru->id;
			if ($danketsoru->sorutip ==$karakter){
				$cevapyazi=$$cevap;
			}else{
				$cevapyazi="";
			}
			if ($danketsoru->sorutip ==$sayisal){
				$cevapsayi=$$cevap;
			}else{
				$cevapsayi=0;
			}
			$anket->AnketCevapDetayEkle($anketid,$danketsoru->id,$anketcevapbaslikid,$cevapsayi,$cevapyazi);
		}
		echo "Anket Cevaplarınız Başarı ile Sisteme Kaydedilmiştir.";
		$form->doBaglanti(array('','Geri',$_SERVER['HTTP_REFERER']));
	}
}else {
?>
<table width='100%' cellpadding='2' cellspacing='2'>
<?=$form->doHidden(array('anketid',$anketid));?>
<tr>
	<td><b>Anket Açıklaması :</b></td>
</tr>
<tr>
	<td><?=$danket->anketad ?><hr></td>
</tr>
<tr>
	<td>*Ad Soyad:<br><?=$form->doInput(array('adsoyad'.$danketsoru->id));?></td>
</tr>
<tr>
	<td width='10%'>Cinsiyet:<br><?=$form->doSelect(array("cinsiyetid","ldaciklama"),$dcinsiyetlistedurum)?></td>
</tr>
<tr>
	<td>*Mail:<br><?=$form->doInput(array('email'.$danketsoru->id));?></td>
</tr>
<tr>
	<td>*Telefon:<br><?=$form->doInput(array('telefon'.$danketsoru->id));?></td>
</tr>
<tr>
	<td>Adres:<br><?=$form->doTextAreaInput(array('adres'.$danketsoru->id));?></td>
</tr>
<tr><td><hr></td></tr>
<?php foreach ($danketsorular as $danketsoru){ ?>
<tr>
	<td width='100%'><?=$danketsoru->soru ?><br><?=$form->doInput(array('soru_'.$danketsoru->id));?>
	<?php if ($danketsoru->sorutip ==$karakter){
				$karaktersayisal="(Lütfen Karakter Değer Giriniz..)";
			}
			if ($danketsoru->sorutip ==$sayisal){
				$karaktersayisal="(Lütfen Sayısal Değer Giriniz..)";
			}
		echo $karaktersayisal;
	?>
	</td>
</tr>
<?php } ?>
<tr>
	<td align='left'><?=$form->doButton(array('anketuygulamaislem','Gönder'));?></td>
</tr>
</table>
<?php } ?>
</fieldset>
<?php
$form->doForm(array('bitir'));
}
 ?>
</div>