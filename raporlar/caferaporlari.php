<?php
$kriterlerAdisyon = "1=1";
$kriterlerGenel = "1=1";

if($basislemtarih==""){
    $basislemtarih =date("Y-m-d");
    $bastar = explode("-", $basislemtarih);
    $basislemtarih = $bastar[1]."/".$bastar[2]."/".$bastar[0];
}

if($bitislemtarih==""){
    $bitislemtarih =date('Y-m-d', strtotime($Date. ' + 1 days'));
    $bittar = explode("-", $bitislemtarih);
    $bitislemtarih = $bittar[1]."/".$bittar[2]."/".$bittar[0];
}


if($ara){
    if($basislemtarih){
    $bastarih =explode("/",$basislemtarih);
    $bastarih =$bastarih[2]."-".$bastarih[0]."-".$bastarih[1];
    $kriterlerAdisyon = $kriterlerAdisyon." and bastarihsaat>='".$bastarih." ".$bassaat."'";
    $kriterlerGenel =$kriterlerGenel." and tarih>='".$bastarih."'";
    }
    if($bitislemtarih){
    $bittarih =explode("/",$bitislemtarih);
    $bittarih =$bittarih[2]."-".$bittarih[0]."-".$bittarih[1];
    $kriterlerAdisyon = $kriterlerAdisyon." and bittarihsaat<='".$bittarih." ".$bitsaat."'";
    $kriterlerGenel =$kriterlerGenel." and tarih<='".$bittarih."'";
    }
    if($adisyonno){
    $kriterlerAdisyon=$kriterlerAdisyon." and No=".$adisyonno;
    }
}else{
    if($basislemtarih){
    $bassaat='00:00:00';
    $bastarih =explode("/",$basislemtarih);
    $bastarih =$bastarih[2]."-".$bastarih[0]."-".$bastarih[1];
    $kriterlerAdisyon = $kriterlerAdisyon." and bastarihsaat>='".$bastarih." ".$bassaat."'";
    $kriterlerGenel =$kriterlerGenel." and tarih>='".$bastarih."'";
    }
    if($bitislemtarih){
    $bitsaat='23:59:00';
    $bittarih =explode("/",$bitislemtarih);
    $bittarih =$bittarih[2]."-".$bittarih[0]."-".$bittarih[1];
    $kriterlerAdisyon = $kriterlerAdisyon." and bittarihsaat<='".$bittarih." ".$bitsaat."'";
    $kriterlerGenel =$kriterlerGenel." and tarih<='".$bittarih."'";
    }
}

//echo $kriterlerAdisyon;
//echo "<br>";
//echo $kriterlerGenel;

$raporlar = new Raporlar();
$forms = new clsForms();
$forms->doForm(array('basla','index.php?lx=raporlar.php'));
echo "Başlangıç Tarih<br>";
$forms->doDateInput(array('basislemtarih',$basislemtarih));
echo "Başlangıç Saat<br>";
$forms->doInput(array('bassaat',$bassaat));
echo "<br>Bitiş Tarih<br>";
$forms->doDateInput(array('bitislemtarih',$bitislemtarih));
echo "Bitiş Saat<br>";
$forms->doInput(array('bitsaat',$bitsaat));
echo "<br>Adisyon No :<br>";
$forms->doInput(array('adisyonno',$adisyonno));
echo "<br>";
$forms->doButton(array('ara','Ara'));
$forms->doForm(array('bitir'));
echo "<hr>";
if(!$adisyonno){

$query=$raporlar->RaporSorguDondur('adisyon_detay',$kriterlerAdisyon);
$query= "SELECT urunad, SUM( satmiktar ) satmiktar, SUM( sattutar ) sattutar from ($query) X group by urunad order by satmiktar desc ";
$kolonadi=array('urunad','satmiktar','sattutar');
echo "<fieldset>";
echo "<legend> Satış Yapılan Ürün</legend>";
//echo $query;
$raporlar->RaporOlusturWithQuery($query,$kolonadi);
echo "</fieldset>";

$query = $raporlar->RaporSorguDondur('adisyon_baslik',$kriterlerAdisyon);

$query= "SELECT substr(bastarihsaat,1,10) as tarih, SUM( satmiktar ) satmiktar, SUM( sattutar ) sattutar, SUM( odmiktar ) odmiktar, SUM( odtutar ) odtutar,count(distinct adsNo) adisyonmiktar from ($query) X group by tarih order by tarih desc ";
$kolonadi=array('tarih','satmiktar','sattutar','odmiktar','odtutar','adisyonmiktar');
echo "<fieldset>";
echo "<legend> Adisyon Toplam</legend>";
//echo $query;
$raporlar->RaporOlusturWithQuery($query,$kolonadi );
echo "</fieldset>";
}

echo "<fieldset>";
echo "<legend> Adisyon Başlık Raporu</legend>";
$query=$raporlar->RaporSorguDondur('adisyon_baslik',$kriterlerAdisyon);
$raporkol =array("adsNo","masaad","bastarihsaat","bittarihsaat","durum","satmiktar","sattutar","odmiktar","odtutar");
$raporlar->RaporOlusturWithQuery($query, $raporkol,"adisyon_baslik");
echo "</fieldset>";

echo "<fieldset>";
echo "<legend>Adisyon Detay Raporu</legend>";
$query=$raporlar->RaporSorguDondur('adisyon_detay',$kriterlerAdisyon);
$raporkol =array("adsNo","masaad","bastarihsaat","bittarihsaat","durum","urunad","satmiktar","sattutar","odmiktar","odtutar","detaytarih");
$raporlar->RaporOlusturWithQuery($query, $raporkol,"adisyon_detay");
echo "</fieldset>";
?>