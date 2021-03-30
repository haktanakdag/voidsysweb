<?php include "../classes_include.php"; ;?>
<?php include "head.php"; ?>
<div id="wrap">
<?php 
if($quizid){
$form = new clsForms();
$quiz = new Quiz();
$dquiz=$quiz->QuizGetir($quizid);
$dquizsorular = $quiz->QuizUygulamaSorulariGetir($quizid);
if($quizuygulamaislem){
    if(recaptchaKontrol($_POST['g-recaptcha-response'])){
    $quizsonuc =$quiz->QuizSonucBaslikEkle($quizid, $adsoyad, $aciklama);
    if($adsoyad==""){
    echo "<H2>Ad Soyad Kısmını Boş Geçemezsiniz.</H2>";
    }elseif($quizsonuc=="zatenvar"){
    echo "<H2>Aynı isimle birden fazla kayıt ekleyemezsiniz.</H2>";
    }else{

    foreach($_POST as $baslik=>$deger){
    $sonuc =explode("_",$deger);
    if(is_numeric($sonuc[0]) and is_numeric($sonuc[1])){
        if($quizsonuc){
           $quiz->QuizSonucDetayEkle($quizsonuc, $quizid, $sonuc[0], $sonuc[1]);
           }
        }
    }
    echo "<H2>İşlem başarılı bir şekilde kaydedildi.</H2>";
    }
}
}

$form->doForm(array('basla'));
?>

<fieldset>
    <legend>Quiz Adı : <?=$dquiz->quizad ?></legend>
<?php
/*if($anketuygulamaislem){
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
 */
?>
<table width='100%' cellpadding='2' cellspacing='2'>
<?=$form->doHidden(array('quizid',$quizid));?>
<tr>
	<td><b>Quiz Açıklaması :</b></td>
</tr>
<tr>
	<td><?=$dquiz->quizad ?><hr></td>
</tr>
<tr>
	<td>*Ad Soyad:(Lütfen Boş Bırakmayınız!)<br><?=$form->doInput(array('adsoyad'));?></td>
</tr>
<tr>
	<td>Açıklama:<br><?=$form->doTextAreaInput(array('aciklama'));?></td>
</tr>

<tr><td><hr></td></tr>
<?php foreach ($dquizsorular as $dquizsoru){ ?>
<tr>
	<td width='100%'><?="<b>".$dquizsoru->soru."</b>" ?>
            <br>
       <?php
       $dquizcevalar =$quiz->QuizUygulamaSoruCevaplariniGetir($dquizsoru->id);
       if($dquizcevalar)
       foreach ($dquizcevalar as $dquizcevap) {
           echo $form->doRadioGroup(array("cevap_$dquizsoru->id",$dquizsoru->id."_".$dquizcevap->id,$dquizcevap->cevap));
           echo "<br>";
       }
       ?>
	</td>
</tr>
<?php } ?>
<tr>
<td align='left'>
    <div class="g-recaptcha" data-sitekey="6LcdtFgUAAAAACfR1rYD6_Rn2GKAFtGD3OCNxcYc"></div>
</td>
</tr>

<tr>
	<td align='left'><?=$form->doButton(array('quizuygulamaislem','Gönder'));?></td>
</tr>
</table>
<?php } ?>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>