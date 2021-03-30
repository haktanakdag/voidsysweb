<?php

class Musteriler {
private $musterikod;
private $musteriunvan;
private $grupkod;
private $ekgrupkod;
private $ilgilikisi;
private $vd;
private $vn;
private $telno;
private $adres;
private $aciklama;

	var $tabloAd="musteri";
        var $tabloAdGrup="musterigrup";
        var $tabloAdEkgrup="musteriekgrup";
	
	public function MusteriSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
        
        public function MusteriGrupSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAdGrup);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
        
        public function MusteriEkGrupSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAdEkgrup);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	public function MusteriGetir($musteriid){
	$dba = new dbClass();
	$dba->connect();
        //echo  "select * from ".$this->tabloAd ."	where id =$musteriid";
	$sql = $dba->query("select * from ".$this->tabloAd ." where id =$musteriid");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
        
        public function MusteriGrupGetir($grupkod){
	$dba = new dbClass();
	$dba->connect();
        //echo  "select * from ".$this->tabloAd ."	where id =$musteriid";
	$sql = $dba->query("select * from ".$this->tabloAdGrup ." where grupkod =$grupkod");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
        
        public function MusteriEkGrupGetir($ekgrupkod){
	$dba = new dbClass();
	$dba->connect();
        //echo  "select * from ".$this->tabloAd ."	where id =$musteriid";
	$sql = $dba->query("select * from ".$this->tabloAdEkgrup ." where ekgrupkod =$ekgrupkod");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
        
	public function MusterileriGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ." $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
                $r[] =$sonuc;
                }
	return $r;
	}
        
        public function MusteriGruplariGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAdGrup ." $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
                $r[] =$sonuc;
                }
	return $r;
	}
        
        public function MusteriEkGruplariGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAdEkgrup ." $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
                $r[] =$sonuc;
                }
	return $r;
	}
	
	public function MusteriEkle($musterikod,$musteriunvan,$grupkod,$ekgrupkod,$ilgilikisi,$vd,$vn,$telno,$adres,$aciklama){
	$dba = new dbClass();
	$dba->connect();
	$cl = new Musteriler();
        if($cl->MusteriVarmi($musterikod,0)==true){
           $sonuc="zatenvar";
           //echo $sonuc;
        }else{
        //echo "insert into ".$this->tabloAd ." (musterikod,musteriunvan,grupkod,ekgrupkod,ilgilikisi,vd,vn,telno,adres,aciklama) values('$musterikod','$musteriunvan','$grupkod','$ekgrupkod','$ilgilikisi','$vd','$vn','$telno','$adres','$aciklama')";
        $sql = $dba->query("insert into ".$this->tabloAd ." (musterikod,musteriunvan,grupkod,ekgrupkod,ilgilikisi,vd,vn,telno,adres,aciklama) values('$musterikod','$musteriunvan','$grupkod','$ekgrupkod','$ilgilikisi','$vd','$vn','$telno','$adres','$aciklama')");
	$sonuc = $dba->insert_id($sql);
        $cl->MusteriGrupEkle($grupkod,$grupkod);
        $cl->MusteriEkGrupEkle($ekgrupkod,$ekgrupkod);
        }
	return $sonuc;
	}
        
        public function MusteriDuzenle($musteriid,$musterikod,$musteriunvan,$grupkod,$ekgrupkod,$ilgilikisi,$vd,$vn,$telno,$adres,$aciklama){
	$dba = new dbClass();
	$dba->connect();
        $cl = new Musteriler();
        if($cl->MusteriVarmi($musterikod,$musteriid)==true){
        $sonuc="zatenvar";
        }else{
	$sql = $dba->query("update ".$this->tabloAd ." set musterikod='$musterikod',musteriunvan='$musteriunvan',grupkod='$grupkod',ekgrupkod='$ekgrupkod',ilgilikisi='$ilgilikisi',vd='$vd',vn='$vn', telno='$telno', adres='$adres', aciklama ='$aciklama' where id =$musteriid");
	$sonuc=true;
        $cl->MusteriGrupEkle($grupkod,$grupad);
        $cl->MusteriEkGrupEkle($ekgrupkod,$ekgrupad);
        }
	return $sonuc;
        }
        
        public function MusteriGrupEkle($grupkod,$grupad){
	$dba = new dbClass();
	$dba->connect();
	$cl = new Musteriler();
        if($cl->MusteriGrupVarmi($grupkod)==true){
           $sonuc="zatenvar";
        }else{
        //echo "insert into ".$this->tabloAdGrup ." (grupkod,grupad) values('$grupkod','$grupad')";
        if($grupad==""){
            $grupad =$grupkod;
        }
        echo "insert into ".$this->tabloAdGrup ." (grupkod,grupad) values('$grupkod','$grupad')";
        $sql = $dba->query("insert into ".$this->tabloAdGrup ." (grupkod,grupad) values('$grupkod','$grupad')");
        echo "Müşteri Grup Kaydedildi<br>";
	$sonuc = $dba->insert_id($sql);
        }
	return $sonuc;
	}
        
        public function MusteriGrupDuzenle($grupkod,$grupad,$eskigrupkod){
	$dba = new dbClass();
	$dba->connect();
	$cl = new Musteriler();
        if($cl->MusteriGrupVarmi($grupkod)==true){
           $sonuc="zatenvar";
        }else{
        //echo "insert into ".$this->tabloAdGrup ." (grupkod,grupad) values('$grupkod','$grupad')";
        if($grupad==""){
            $grupad =$grupkod;
        }
        echo "update ".$this->tabloAdGrup ." set grupkod ='$grupkod', grupad='$grupad' where grupkod='$eskigrupkod'";
        $sql = $dba->query("update ".$this->tabloAdGrup ." set grupkod ='$grupkod', grupad='$grupad' where grupkod='$eskigrupkod'");
        echo "Müşteri Grup Kaydedildi<br>";
	$sonuc = $dba->insert_id($sql);
        }
	return $sonuc;
	}
        
        public function MusteriGrupVarmi($grupkod){
        $dba = new dbClass();
        $dba->connect();
        $cl = new Musteriler();
        //echo "select count(1) sayi from ".$this->tabloAdGrup ." where grupkod='$grupkod'";
        $sql = $dba->query("select count(1) sayi from ".$this->tabloAdGrup ." where grupkod='$grupkod'");
        $sonuc =$dba->fetch_object($sql);
        if($sonuc->sayi=="0"){
            return false;
        }else{
            return true;
        }
                        
        }
        
        public function MusteriEkGrupEkle($ekgrupkod,$ekgrupad){
	$dba = new dbClass();
	$dba->connect();
	$cl = new Musteriler();
        if($cl->MusteriEkGrupVarmi($ekgrupkod)==true){
        $sonuc="zatenvar";
        //echo $sonuc;
        }else{
        if($ekgrupad==""){
        $ekgrupad =$ekgrupkod;
        }
        //echo "insert into ".$this->tabloAdEkgrup ." (ekgrupkod,ekgrupad) values('$ekgrupkod','$ekgrupad')";
        $sql = $dba->query("insert into ".$this->tabloAdEkgrup ." (ekgrupkod,ekgrupad) values('$ekgrupkod','$ekgrupad')");
        echo "Müşteri Ek Grup Kaydedildi<br>";
        $sonuc = $dba->insert_id($sql);
        }
	return $sonuc;
	}
        
        public function MusteriEkGrupDuzenle($ekgrupkod,$ekgrupad,$eskiekgrupkod){
	$dba = new dbClass();
	$dba->connect();
	$cl = new Musteriler();
        if($cl->MusteriEkGrupVarmi($ekgrupkod)==true){
        $sonuc="zatenvar";
        echo $sonuc;
        }else{
        if($ekgrupad==""){
        $ekgrupad =$ekgrupkod;
        }
        //echo "insert into ".$this->tabloAdEkgrup ." (ekgrupkod,ekgrupad) values('$ekgrupkod','$ekgrupad')";
        $sql = $dba->query("update ".$this->tabloAdEkGrup ." set ekgrupkod ='$ekgrupkod', ekgrupad='$ekgrupad' where grupkod='$eskiekgrupkod'");
        echo "Müşteri Ek Grup Kaydedildi<br>";
        $sonuc = $dba->insert_id($sql);
        }
	return $sonuc;
	}
        
        public function MusteriEkGrupVarmi($ekgrupkod){
        $dba = new dbClass();
        $dba->connect();
        $cl = new Musteriler();
        //echo "select count(1) sayi from ".$this->tabloAdEkgrup ." where ekgrupkod='$ekgrupkod'";
        $sql = $dba->query("select count(1) sayi from ".$this->tabloAdEkgrup ." where ekgrupkod='$ekgrupkod'");
        $sonuc =$dba->fetch_object($sql);
        if($sonuc->sayi=="0"){
            return false;
        }else{
            return true;
        }
        }
        

        
        public function MusteriVarmi($musterikod,$musteriid){
        $dba = new dbClass();
        $dba->connect();
        //echo "select count(id) sayi from ".$this->tabloAd ." where musterikod='$musterikod' and id <> $musteriid";
        $sql = $dba->query("select count(id) sayi from ".$this->tabloAd ." where musterikod='$musterikod' and id <> $musteriid");
        $sonuc =$dba->fetch_object($sql);
        if($sonuc->sayi=="0"){
            return false;
        }else{
            return true;
        }
        }
	
	public function MusteriSil($musteriid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAd ." where id =$musteriid");
	$sonuc=1;
	return $sonuc;
	}
        
     
       
}

?>
