<?php
$birimler = new Birimler();
$dbirimler = $birimler->BirimleriGetir();
$kullanici = new Kullanicilar();
$dkullanici = $kullanici->KullanicilariGetir();
$kullaniciyetkiler = new Yetkiler();
$dkulyetkiler = $kullaniciyetkiler->KullaniciYetkileriGetir($kulyetki);

$kullanicilar = new Kullanicilar();
$kul = $kullanicilar->KullaniciGetir($kulyetki);
echo "<h2>".$kul->adsoyad.(" Kullanıcısının yetkileri")."</h2>";
echo "<br>";
echo $kulyetkiislem;
if($kulyetkiislem){
foreach($dbirimler as $dbirim){
        $sec ="birim_".$dbirim->id;
        if($$sec){
        $secilenbirimler[]=$dbirim->id;
        }
        $sec="";
}
$kullaniciyetkiler->KullaniciYetkiEkle($kulyetki,$secilenbirimler);
header("Location: adminpanel.php?lx=kullaniciyetki.php&kulyetki=".$kulyetki);
}

if (is_array($dkulyetkiler))
{
	foreach($dkulyetkiler as $dkulyetki){
		$ddkulyetki[].=$dkulyetki->yetkibirimid;
	}
}


$yetkisayi =count($ddkulyetki);
$yetkisayi =$yetkisayi-1;
$i =0;
$form = new clsForms();
$form->doForm(array('basla'));
if($dbirimler) {
foreach($dbirimler as $dbirim){
        //echo $dbirim->id;
        $checked="";
        if($ddkulyetki){
                foreach($ddkulyetki as $dd){
                        if($dd==$dbirim->id){
                                $checked="checked";
                        }
                }
        }
        echo $form->doCheckGroup(array($dbirim->id,"birim_".$dbirim->id,$checked,$dbirim->birimad));
        $i++;
        echo "<br>";
    }
}

$form->doButton(array('kulyetkiislem','Kaydet'));
$form->doForm(array('bitir'));

?>