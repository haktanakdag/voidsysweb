<?php
$birimler = new Birimler();
$dbirimler = $birimler->BirimleriGetir();

$birimyetkiler = new Yetkiler();
$dbirimyetkiler = $birimyetkiler->BirimYetkileriGetir($birimyetki);

$b = $birimler->BirimGetir($birimyetki);
echo "<h2>".$b->birimad.(" Biriminin yetkileri")."</h2>";

if($birimyetkiislem){
		foreach($dbirimler as $dbirim){
			$sec ="birim_".$dbirim->id;
			if($$sec){
			$secilenbirimler[]=$dbirim->id;
			}
		}
	//print_r($secilenbirimler);
	$birimyetkiler->BirimYetkiEkle($birimyetki,$secilenbirimler);
	header("Location: adminpanel.php?lx=birimyetki.php&birimyetki=".$birimyetki);
}

if (is_array($dbirimyetkiler))
{
	foreach($dbirimyetkiler as $dbirimyetki){
		$ddbirimyetki[].=$dbirimyetki->yetkibirimid;
	}
}

$yetkisayi =count($ddbirimyetki);
$yetkisayi =$yetkisayi-1;
$i =0;
$form = new clsForms();
$form->doForm(array('basla'));
foreach($dbirimler as $dbirim){
	//echo $dbirim->id;
	$checked="";
	if($ddbirimyetki){
		foreach($ddbirimyetki as $dd){
			if($dd==$dbirim->id){
				$checked="checked";
			}
		}
	}
	echo $form->doCheckGroup(array($dbirim->id,"birim_".$dbirim->id,$checked,$dbirim->birimad));
	$i++;
	echo "<br>";
}
$form->doButton(array('birimyetkiislem','Gönder'));
$form->doForm(array('bitir'));

?>