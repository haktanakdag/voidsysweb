<a name="bastaraf"><a href="#sontaraf">sayfanın altına in</a>
<div id="wrap">
<?php
$form = new clsForms();
$listeler = new Listeler();
$parametreler = new Parametreler();
$dkaynaklar = $parametreler->ParametreGetirA("kaynak");
$dlistekaynak = $listeler->listeDetayGetirC($dkaynaklar->deger);

$dneden = $parametreler->ParametreGetirA("neden");
$dlisteneden = $listeler->listeDetayGetirC($dneden->deger);

$daciliyet = $parametreler->ParametreGetirA("aciliyet");
$dlisteaciliyet = $listeler->listeDetayGetirC($daciliyet->deger,"aciliyet");

$ddurum = $parametreler->ParametreGetirA("durum");
$dlistedurum = $listeler->listeDetayGetirC($ddurum->deger);

$dislemtur = $parametreler->ParametreGetirA("islemtur");
$dlisteislemtur = $listeler->listeDetayGetirC($dislemtur->deger);


$kullanicilar = new Kullanicilar();
$kulid =s_get('kullanici');
$dkullanicilar  = $kullanicilar->YetkiliKullanicilariGetir(0);


if($gorevaramaislem){
	$where = "1=1";
	if($chkgorevid=="on"){
		$where .= " and gorevid =".$gorevid;
	}
	if($chkkonu=="on"){
		$where .= " and konu =".$konu;
	}
	if($chkkonu=="on"){
		$where .= " and konu =".$konu;
	}
	if($chkkaynak=="on"){
		$where .= " and kaynak =".$kaynak;
	}
	if($chkkime=="on"){
		$where .= " and kime =".$kime;
	}
	if($chkneden=="on"){
		$where .= " and neden =".$neden;
	}
	if($chkaciliyet=="on"){
		$where .= " and aciliyet =".$aciliyet;
	}
	if($chkdurum=="on"){
		$where .= " and durum =".$durum;
	}
	if($chkacankulid=="on"){
		$where .= " and acankulid =".$acankulid;
	}
	if($chkacilistarih=="on"){
		$where .= " and acilistarih between ".$basacilistarih." and ".$bitacilistarih;
	}
	if($chkkapanistarih=="on"){
		$where .= " and kapanistarih between ".$baskapanistarih." and ".$bitkapanistarih;
	}
	if($chkdissistemno1=="on"){
		$where .= " and dissistemno1 =".$dissistemno1;
	}
	if($chkdissistemno2=="on"){
		$where .= " and dissistemno2 =".$dissistemno2;
	}
	if($chkdissistemno3=="on"){
		$where .= " and dissistemno3 =".$dissistemno3;
	}
	if($chkislemtur=="on"){
		$where .= " and islemturid =".$islemturid;
	}
	if($chkislemsure=="on"){
		$where .= " and islemsure =".$islemsure;
	}
	if($chkislemtur=="on"){
		$where .= " and islemturid =".$islemturid;
	}
	if($chkislemtarih=="on"){
		$where .= " and islemtarih between ".$basislemtarih." and ".$bitislemtarih;
	}
	if($chkislemyapankulid=="on"){
		$where .= " and islemyapankulid =".$islemyapankulid;
	}
	if($chksonkulid=="on"){
		$where .= " and sonkulid =".$sonkulid;
	}
	if($chkdetayaciklama=="on"){
		$where .= " and detayaciklama =".$detayaciklama;
	}
	if($chksonkulid=="on"){
		$where .= " and sonkulid =".$sonkulid;
	}
	
	$gorevler = new Gorev();
	$dgorevler = $gorevler->GorevAra($where);
	
	echo "<table class='pure-table pure-table-bordered'><thead><tr><th>No</th><th>Konu</th><th>Kaynak</th><th>Aciliyet</th><th>Kim Açmış</th><th>Kimde</th><th>Durum</th><th>Opsiyon</th></tr></thead><tbody>";
	if($dgorevler){
	foreach ($dgorevler as $dgorev){
		$gorev = $gorevler->GorevBaslikGetir($dgorev->gorevid);
		echo "<tr>";
		echo "<td>".$gorev->id."</td>";
		echo "<td>".$gorev->konu."</td>";
		echo "<td>".$gorev->kaynak."</td>";
		echo "<td>".$gorev->aciliyet."</td>";
		echo "<td>".$gorev->acankul."</td>";
		echo "<td>".$gorev->sonkul."</td>";
		echo "<td>".$gorev->durum."</td>";
		//echo "<td><a class='pure-button' href='#'>A Pure Button</a></td>";
		echo "<td>";
		$form->doBaglanti(array('detaygoster','Detay Göster','adminpanel.php?lx=gorevislemdetay.php&detaygoster='.$gorev->id,'pure-button'));
		echo "</td>";
		//echo "<td><a href='b_gorevler.php?lx=gorevislemdetay.php&detaygoster=4' class='pure-button' name=''  >Detay Göster</a></td>";
		echo "</tr>";
	}
	}else {
		echo "Gösterilecek Sonuç Yok.";
	}
	echo "</tbody></table>";
}
$form->doForm(array('basla','b_gorevler.php'));
?>

<fieldset>
    <legend>Görev Arama</legend>
<table width='100%' cellpadding='2' cellspacing='2'>
<tr>
	<td colspan='3' align='left'><?=$form->doButton(array('gorevaramaislem','Görev Ara'));?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkgorevid","chkgorevid","","Görev Id :")); ?></td><td><?=$form->doInput(array('gorevid'));?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkkonu","chkkonu","","Konu :")); ?></td><td><?=$form->doInput(array('konu'));?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkkaynak","chkkaynak","","Kaynak :")); ?></td><td><?php $form->doSelect(array('kaynakid','ldaciklama'),$dlistekaynak); ?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkkime","chkkime","","Kime :")); ?></td><td><?php $form->doSelect(array('sonkulid','adsoyad'),$dkullanicilar); ?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkneden","chkneden","","Neden :")); ?></td><td><?php $form->doSelect(array('nedenid','ldaciklama'),$dlisteneden); ?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkaciliyet","chkaciliyet","","Aciliyet :")); ?></td><td><?php $form->doSelect(array('aciliyetid','ldaciklama'),$dlisteaciliyet); ?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkdurum","chkdurum","","Durum :")); ?></td><td><?php $form->doSelect(array('durumid','ldaciklama'),$dlistedurum); ?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkacankulid","chkacankulid","","Açan Kullanıcı :")); ?></td><td><?php $form->doSelect(array('acankulid','adsoyad'),$dkullanicilar); ?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkacilistarih","chkacilistarih","","Açılış Tarihi (Aralık):")); ?></td><td><?=$form->doDateInput(array('basacilistarih'));?> <?=$form->doDateInput(array('bitacilistarih'));?> </td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkkapanistarih","chkkapanistarih","","Kapanış Tarihi (Aralık):")); ?></td><td><?=$form->doDateInput(array('baskapanistarih'));?> <?=$form->doDateInput(array('bitkapanistarih'));?> </td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkdissistemno1","chkdissistemno1","","Dış Sistem No1 :")); ?></td><td><?=$form->doInput(array('dissistemno1'));?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkdissistemno2","chkdissistemno2","","Dış Sistem No2 :")); ?></td><td><?=$form->doInput(array('dissistemno2'));?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkdissistemno3","chkdissistemno3","","Dış Sistem No3 :")); ?></td><td><?=$form->doInput(array('dissistemno3'));?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkislemtur","chkislemtur","","İşlem Tür :")); ?></td><td><?php $form->doSelect(array('islemturid','ldaciklama'),$dlisteislemtur); ?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkislemsure","chkislemsure","","İşlem Süre")); ?></td><td><?=$form->doInput(array('islemsure'));?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkislemtarih","chkislemtarih","","İşlem Tarihi (Aralık):")); ?></td><td><?=$form->doDateInput(array('basislemtarih'));?> <?=$form->doDateInput(array('bitislemtarih'));?> </td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkislemyapankulid","chkislemyapankulid","","İşlem Yapan Kullanıcı:")); ?></td><td><?php $form->doSelect(array('islemyapankulid','adsoyad'),$dkullanicilar); ?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chksonkulid","chksonkulid","","Son Kullanıcı:")); ?></td><td><?php $form->doSelect(array('sonkulid','adsoyad'),$dkullanicilar); ?></td>
</tr>
<tr>
	<td width="30%"><?=$form->doCheckGroup(array("chkdetayaciklama","chkdetayaciklama","","Detay Açıklama:")); ?></td><td><?=$form->doTextAreaInput(array('detayaciklama'));?></td>
</tr>
<tr>
	<td colspan='3' align='left'><?=$form->doButton(array('gorevaramaislem','Görev Ara'));?></td>
</tr>
</table>
</fieldset>
<?php
    $form->doForm(array('bitir'));
?>
</div>
<a href="#bastaraf">sayfanın üstüne çık</a><a name="sontaraf">