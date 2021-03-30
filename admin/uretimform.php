<?php
$ent= new Entegrasyon();
$dent = $ent->netsisUrunGruplariCek();
$sayfaad="adminpanel.php?lx=uretimform.php";
$form = new clsForms();
$uretim = new Uretim();

//print_r($dent);
?>
<?php
//echo $_COOKIE['uretim'];
$uretimvar =$_COOKIE['uretim'];
if($uretimsil=="1"){
    setcookie("uretim","", time()-3600);
    unset($_COOKIE['uretim']);
    $uretimvar =false;
}
if($uretimkaydet){
    $hammaddeyibuldum =false;
    foreach($_POST as $baslik=>$deger){
     if($hammaddeyibuldum==false){
        if($baslik <>"mamul" && is_numeric(str_replace(",",".",$deger))){
           $urunkod = STR_replace("_",".",$baslik);
           $miktar =$deger;
           $mamulkod =$urunkod;
           $mamulmiktar =$miktar;

        }elseif($baslik =="mamul" ){
            $hammaddeyibuldum=true;
            $uretilenurunkod =$mamulkod;
            $uretilenmiktar =$mamulmiktar;
        }
       }
     }
     echo "Üretilen Ürün Kod : ".$mamulkod;
     echo "<hr>";
     echo "Üretilen Miktar :".$mamulmiktar;
     echo "<hr>";
     $mamulmiktar =str_replace(",",".",$mamulmiktar);
     $uretimid=$uretim->UretimEkle($mamulkod, $mamulmiktar,$tarih, $depokodu);
     foreach($_POST as $baslik=>$deger){
     $urunkod = STR_replace("_",".",$baslik);
     if($baslik<>"mamul" && $urunkod<>$uretilenurunkod && is_numeric(str_replace(",",".",$deger)) && $urunkod<>"depokodu"){
         $deger =str_replace(",",".",$deger);
         echo "Tüketilen Ürün Kod : ".$urunkod;
         echo "<hr>";
         echo "Tüketilen Miktar :".$deger;
         echo "<hr>";
         $uretim->UretimDetayEkle($uretimid, $urunkod, $deger);
     }
     }
    
    setcookie("uretim","", time()-3600);
    unset($_COOKIE['uretim']);
    $uretimvar =false;
    $urunkod =false;
}
if($urunkod){
    $uretim ="";
    if($_COOKIE['uretim']){
        $c_uretim = $_COOKIE['uretim'];
    }
    if(unserialize($c_uretim)){
    $data = serialize(unserialize($c_uretim)."-".$urunkod);
    }else{
         $data =serialize($urunkod);
    }
    //echo $data;
    setcookie("uretim", $data, time()+3600); 
    $uretimvar =$data;
}
if($GRUP_KODU){
   $Uent = $ent->netsisUrunleriCek($GRUP_KODU);
}
 //echo $_COOKIE['uretim'];
if(($uretimvar) or ($_COOKIE['uretim'])){
   $form->doForm(array('basla'));
   echo "<fieldset><legend>Üretim İşlem</legend>";
   $expurun= explode("-",unserialize($uretimvar));
    $tip[] = "G";
    $tip[] = "C";
    echo "Tarih : <br> ";
    echo $form->doDateInput(array('tarih'));
    echo "<br> ";
    echo "Depo : <br>";
    echo $form->doInput(array('depokodu'));
     echo "<br>";
    foreach ($expurun as $expu){
       $sonuc= $ent->netsisRecetesiVarmi($expu);
       $urun = $ent->netsisUrunGetir($expu);
       if($sonuc['sayi']>0){
       echo $urun['STOK_ADI']." : ".$urun['BIRIM']."<br>";
       echo $form->doInput(array($expu,'')).$form->doRadioGroup(array("mamul",$expu,"checked","Mamül"))."<br>";
       $recete = $ent->netsisReceteGetir($expu);
        foreach($recete as $r){
            echo $r['HAM_ADI']." : ".$r['HAMBIRIM']."<br>";
            echo $form->doInput(array($r['HAM_KODU'],'')).$form->doRadioGroup(array("mamul",$expu,"","Mamül"))."<br>";
       }
       }else{
       echo $urun['STOK_ADI']." : ".$urun['BIRIM']."<br>";
       echo $form->doInput(array($expu,'')).$form->doRadioGroup(array("mamul",$expu,"","Mamül"))."<br>";
       }
   }
   
   ?>
<?=$form->doButton(array('uretimkaydet','Gönder'));?>
<?=$form->doBaglanti(array('uretimsil','Üretim Sil',"$sayfaad&uretimsil=1"));?>

</fieldset>
<?php
$form->doForm(array('bitir'));
 ?>
<?php
}
?>
<?php
$_SESSION['GRUP_KODU']=$GRUP_KODU;
?>

<h2>Ürünler</h2>
<input type='search' class='light-table-filter' data-table='myTable' placeholder='Filtrer' />
<?php
$forms  = new clsForms();
$forms->doTable(
array(array("Grup",'20%'))
,array("GRUP_KODU")
,$dent
,array(array("GRUP_KODU",$sayfaad,"Grup Seç"))
,"myTable"
,"GRUP_KODU"
);

if($Uent){
$forms->doTable(
array(array("STOK_KODU",'20%'),array("STOK_ADI",'20%'),array("Grup",'20%'),array("EkGrup",'20%'))
,array("STOK_KODU","STOK_ADI","GRUP_KODU","KOD_1")
,$Uent
,array(array("urunkod",$sayfaad,"Ekle"))
,"myTable"
,"STOK_KODU"
);
}
?>