<div id="wrap">
<?php 
$form = new clsForms();

$parametreler = new Parametreler();
$listeler = new Listeler();
$danketsorutip = $parametreler->ParametreGetirA ( "anketsorutip" );
$danketlistesorutip = $listeler->listeDetayGetirC ( $danketsorutip->deger );


$anketler = new Anket();
$danket =$anketler->AnketSoruGetir($duzenle);

$form->doForm(array('basla'));
?>
<?php $form->doBaglanti(array('','Geri',$_SERVER['HTTP_REFERER']));?>
<fieldset>
    <legend>Anket Soru Ekle</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<?=$form->doHidden(array('anketid',$anketid));?>
<?=$form->doHidden(array('anketsoruid',$duzenle));?>
<tr>
	<td width='10%'>Durum:</td><td><?=$form->doSelect(array("sorutip","ldaciklama",$danket->sorutip),$danketlistesorutip)?></td>
</tr>
<tr>
	<td width='10%'>Soru:</td><td><?=$form->doTextAreaInput(array("soru",$danket->soru));?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton(array('anketsoruislem','Gönder'));?></td>
</tr>
<div id="anketsoruislemdis"></div>
</table>
</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
</div>

