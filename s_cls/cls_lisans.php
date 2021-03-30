<?php
class Lisans {

	var $tabload="lisans";
        
	public function LisansKontrol($uygulama,$bilgisayar,$tarih){
	$dba = new dbClass();
	$dba->connect();
        //ECHO "select * from lisans where uygulama ='$uygulama' and bilgisayar ='$bilgisayar' and '$tarih' between bastarih and bittarih and durum=1";
	$sql = $dba->query("select * from lisans where uygulama ='$uygulama' and bilgisayar ='$bilgisayar' and '$tarih' between bastarih and bittarih and durum=1");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
        
        public function LisansKontrol2($uygulama,$bayikodu,$musterinumarasi,$bilgisayar,$tarih){
	$dba = new dbClass();
	$dba->connect();
        //echo  "select * from ".$this->tabloAd ."	where id =$kullaniciId";
	$sql = $dba->query("select * from ".$this->tabloAd ." where uygulama ='$uygulama' and bilgisayar ='$bilgisayar' and musterinumarasi ='$musterinumarasi' and bayikodu ='$bayikodu' and '$tarih' between bastarih and bittarih and durum=1");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
        
        public function LisansSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
        
        public function LisansKayitGetir($lisansid){
        $dba = new dbClass();
        $dba->connect();
        $sql = $dba->query("select * from ".$this->tabloAd ."
        where id =$yaziid");
        $sonuc = $dba->fetch_object($sql);
        return $sonuc;
        }
        
        public function LisanslariGetir($pagerWhere ="",$aramaString=""){
        $dba = new dbClass();
        $dba->connect();
        //echo "select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere";
        $sql = $dba->query("select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere");
        while(@$sonuc =$dba->fetch_object($sql)){
                $r[] =$sonuc;
                }
        return $r;
        
        }
        
        public function LisansSil($lisansid){
        $dba = new dbClass();
        $dba->connect();
        //$birimcls= new Birim();
        $sql = $dba->query("delete from ".$this->tabloAd ." where id =$lisansid");
       
        $sonuc=1;
        return $sonuc;
        }
        
}

?>