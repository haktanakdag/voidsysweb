<?php
class Parametreler {
private $parId;
private $paciklama;
private $deger;

	var $tabloAd="parametreler";
	
	public function ParametreSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	public function ParametreGetir($parId){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ."
	where id =$parId");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function ParametreGetirA($aciklama){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ."
	where paciklama like '%$aciklama%'");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function ParametreleriGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ." $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function ParametreEkle($paciklama,$deger){
	$dba = new dbClass();
	$dba->connect();
	$par = new Parametreler();
	//ECHO "insert into ".$this->tabloAd ." (paciklama,deger) values('$paciklama','$deger')";
	$sql = $dba->query("insert into ".$this->tabloAd ." (paciklama,deger) values('$paciklama','$deger')");
	$sonuc = $dba->insert_id($sql);
	return $sonuc;
	}
	
	public function ParametreDuzenle($parId,$deger){
	$dba = new dbClass();
	$dba->connect();
	$par = new Parametreler();
	//ECHO "update ".$this->tabloAd ." set Unvanad ='$unvanad' where id =$Unvanid";
	$sql = $dba->query("update ".$this->tabloAd ." set deger ='$deger' where id =$parId");
	$sonuc=1;
	return $sonuc;
	}
}

?>