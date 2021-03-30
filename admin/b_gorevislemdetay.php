<a name="bastaraf"><a href="#sontaraf">sayfanın altına in</a>
<?php
$gorevler = new Gorev ( );
$dbaslikgorev = $gorevler->GorevBaslikGetir ( $detaygoster );
$ddetaygorev = $gorevler->GorevDetayGetir ( $detaygoster );
$form = new clsForms ( );
$listeler = new Listeler ( );
$parametreler = new Parametreler ( );
$dislemtur = $parametreler->ParametreGetirA ( "islemtur" );
$dlisteislemtur = $listeler->listeDetayGetirC ( $dislemtur->deger );

$kullanicilar = new Kullanicilar ( );
$kulid = s_get('kullanici');
$dkullanicilar = $kullanicilar->YetkiliKullanicilariGetir ( $kulid );

$ddurum = $parametreler->ParametreGetirA ( "durum" );
$dlistedurum = $listeler->listeDetayGetirC ( $ddurum->deger );

?>
<?php $form->doBaglanti(array('','Geri',$_SERVER['HTTP_REFERER']));?>
<div id="wrap">
<fieldset><legend>Görev Başlık</legend>
<table cellpadding='2' cellspacing='2' border='1'>
	<tr>
		<td width='20%'>Görev No:</td>
		<td><?=$dbaslikgorev->id?></td>
	</tr>
	<tr>
		<td width='20%'>Konu:</td>
		<td><?=$dbaslikgorev->konu?></td>
	</tr>
	<tr>
		<td width='20%'>Kaynak:</td>
		<td><?=$dbaslikgorev->kaynak?></td>
	</tr>
	<tr>
		<td width='20%'>Neden:</td>
		<td><?=$dbaslikgorev->neden?></td>
	</tr>
	<tr>
		<td width='20%'>Aciliyet:</td>
		<td><?=$dbaslikgorev->aciliyet?></td>
	</tr>
	<tr>
		<td width='20%'>durum:</td>
		<td><?=$dbaslikgorev->durum?></td>
	</tr>
	<tr>
		<td width='20%'>Açılış:</td>
		<td><?=$dbaslikgorev->acilis?></td>
	</tr>
	<tr>
		<td width='20%'>Kapanış:</td>
		<td><?=$dbaslikgorev->kapanis?></td>
	</tr>
	<tr>
		<td width='20%'>Dış Sistem No 1:</td>
		<td><?=$dbaslikgorev->dissistemno1?></td>
	</tr>
	<tr>
		<td width='20%'>Dış Sistem No 2:</td>
		<td><?=$dbaslikgorev->dissistemno2?></td>
	</tr>
	<tr>
		<td width='20%'>Dış Sistem No 3:</td>
		<td><?=$dbaslikgorev->dissistemno3?></td>
	</tr>
	<tr>
		<td width='20%'>Açan Kullanıcı:</td>
		<td><?=$dbaslikgorev->acankul?></td>
	</tr>
	<tr>
		<td width='20%'>Kapatan Kullanıcı:</td>
		<td><?=$dbaslikgorev->kapatankul?></td>
	</tr>
</table>

<?php
if ($ddetaygorev) {
	foreach ( $ddetaygorev as $d ) {
		echo "<hr>";
		echo "<b>Görev Detay</b>";
		echo "<table border='1'>";
		echo "<tr><td width='20%'>Detay No:</td><td>$d->gorevdetayid</td></tr>";
		echo "<tr><td width='20%'>İşlem Tür:</td><td>$d->islemtur</td></tr>";
		echo "<tr><td width='20%'>Tarih Saat:</td><td>$d->detayislemtarihsaat</td></tr>";
		echo "<tr><td width='20%'>İşlem Yapan Kullanıcı:</td><td>$d->islemyapankul</td></tr>";
		echo "<tr><td width='20%'>Son Kullanıcı:</td><td>$d->sonkul</td></tr>";
		echo "<tr><td width='20%'>Süre:</td><td>$d->suresaat</td></tr>";
		echo "<tr><td width='20%'>Detay Açıklama:</td><td>$d->detayaciklama</td></tr>";
		echo "<tr><td width='20%'>Durum:</td><td>$d->durum</td></tr>";
		echo "</table>";
	}
}
if ($dbaslikgorev->durum != "Kapalı" and $dbaslikgorev->durum != "İptal" and $dbaslikgorev->sonkulid == s_get('kullanici')) {
	echo "<hr>";
	echo "<table width='800'>";
	$form->doForm ( array ('basla' ) );
	?>

<?=$form->doHidden ( array ('gdeklenengorevid', $detaygoster ) );?>
<tr>
	<td width='20%'>Durum:</td>
	<td><?php
	$form->doSelect ( array ('durumid', 'ldaciklama' ), $dlistedurum );
	?></td>
</tr>
<tr>
	<td width='20%'>Kime:</td>
	<td><?php
	$form->doSelect ( array ('sonkulid', 'adsoyad' ), $dkullanicilar );
	?></td>
</tr>
<tr>
	<td width='20%'>İşlem Tür:</td>
	<td><?php
	$form->doSelect ( array ('islemturid', 'ldaciklama' ), $dlisteislemtur );
	?></td>
</tr>
<tr>
	<td width='20%'>İşlem Süre (Saat):</td>
	<td><?=$form->doInput ( array ('islemsure' ) );?></td>
</tr>
<tr>
	<td width='20%'>Detay Açıklama:</td>
	<td><?=$form->doTextAreaInput ( array ('detayaciklama' ) );?></td>
</tr>
<tr>
	<td colspan='2' align='left'><?=$form->doButton ( array ('gorevdetayislem', 'Gönder' ) );?></td>
</tr>
<div id="gorevdetayislemdis"></div>
<?php
	$form->doForm ( array ('bitir' ) );
	echo "</table>";
}
?>


</fieldset>
</div>
<a href="#bastaraf">sayfanın üstüne çık</a><a name="sontaraf">