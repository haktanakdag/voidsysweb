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
    $kriterlerAdisyon = $kriterlerAdisyon." and adbastarihsaat>='".$bastarih." ".$bassaat."'";
    $kriterlerGenel =$kriterlerGenel." and tarih>='".$bastarih."'";
    }
    if($bitislemtarih){
    $bittarih =explode("/",$bitislemtarih);
    $bittarih =$bittarih[2]."-".$bittarih[0]."-".$bittarih[1];
    $kriterlerAdisyon = $kriterlerAdisyon." and adbittarihsaat<='".$bittarih." ".$bitsaat."'";
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
    $kriterlerAdisyon = $kriterlerAdisyon." and adbastarihsaat>='".$bastarih." ".$bassaat."'";
    $kriterlerGenel =$kriterlerGenel." and tarih>='".$bastarih."'";
    }
    if($bitislemtarih){
    $bitsaat='23:59:00';
    $bittarih =explode("/",$bitislemtarih);
    $bittarih =$bittarih[2]."-".$bittarih[0]."-".$bittarih[1];
    $kriterlerAdisyon = $kriterlerAdisyon." and adbittarihsaat<='".$bittarih." ".$bitsaat."'";
    $kriterlerGenel =$kriterlerGenel." and tarih<='".$bittarih."'";
    }
}

//echo $kriterlerAdisyon;
//echo "<br>";
//echo $kriterlerGenel;

$raporlar = new Raporlar();
$forms = new clsForms();
$forms->doForm(array('basla','index.php?lx=raporlar.php'));
echo "Başlangıç Tarih";
$forms->doDateInput(array('basislemtarih',$basislemtarih));
echo "Başlangıç Saat";
$forms->doInput(array('bassaat',$bassaat));
echo "Bitiş Tarih";
$forms->doDateInput(array('bitislemtarih',$bitislemtarih));
echo "Bitiş Saat";
$forms->doInput(array('bitsaat',$bitsaat));
echo "Adisyon No :";
$forms->doInput(array('adisyonno',$adisyonno));
$forms->doButton(array('ara','Ara'));
$forms->doForm(array('bitir'));
echo "<hr>";
if(!$adisyonno){
Echo "<h2>Satış Yapılan Ürün</h2>";
//$raporlar->RaporOlustur('satis_yapilan_urun',$kriterlerGenel);
$query=$raporlar->RaporSorguDondur('adisyon_detay',$kriterlerAdisyon);
$query= "SELECT urunad, SUM( satmiktar ) satmiktar, SUM( sattutar ) sattutar from ($query) X group by urunad order by satmiktar desc ";
$kolonadi=array('urunad','satmiktar','sattutar');
$raporlar->RaporOlusturWithQuery($query,$kolonadi );
Echo "<h2>Adisyon Toplam</h2>";
$query = $raporlar->RaporSorguDondur('adisyon_baslik',$kriterlerAdisyon);
$query= "SELECT substr(adbastarihsaat,1,10) as tarih, SUM( satmiktar ) satmiktar, SUM( sattutar ) sattutar, SUM( odmiktar ) odmiktar, SUM( odtutar ) odtutar,count(distinct No) adisyonmiktar from ($query) X group by tarih order by tarih desc ";
//echo $query;
$kolonadi=array('tarih','satmiktar','sattutar','odmiktar','odtutar','adisyonmiktar');
$raporlar->RaporOlusturWithQuery($query,$kolonadi );


/*
Echo "<h2>Adisyon Toplam</h2>";
$raporlar->RaporOlustur('adisyon_toplam',$kriterlerGenel);
 */
}
Echo "<h2>Adisyon Başlık Raporu</h2>";
$raporlar->RaporOlustur('adisyon_baslik',$kriterlerAdisyon);
Echo "<h2>Adisyon Detay Raporu</h2>";
//echo $kriterlerAdisyon;


$raporlar->RaporOlustur('adisyon_detay',$kriterlerAdisyon);

?>