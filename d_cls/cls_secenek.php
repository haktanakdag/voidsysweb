<?php
class Secenek {
private $secenekid;
private $secenekad;

	var $tabloAd="secenekler";
	
	public function SecenekSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function SecenekSeviyeSayiGetir(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(distinct seviye) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function SeviyeSecenekGetir($seviyeno){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select * from ".$this->tabloAd." where seviye=".$seviyeno);
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function SecenekGetir($secenekid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ."
	where id =$secenekid");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function SecenekleriGetir($pagerWhere ="",$aramaString =""){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select id,secenekad,secenekbagid from ".$this->tabloAd ." $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function SecenekEkle($secenekad,$secenekbagid){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Secenek();
	if($bir->SecenekVarmi($secenekad)){
		$sonuc = "secenekvar";
	}else{
		$sql = $dba->query("insert into ".$this->tabloAd ." (secenekad,secenekbagid) values('$secenekad','$secenekbagid')");
		$sonuc = $dba->insert_id($sql);
		}
	return $sonuc;
	}
	
	public function SecenekVarmi($secenekad)
	{
		$dba = new dbClass();
		$dba->connect();
		$sql = $dba->query("select id from ".$this->tabloAd ." where email='$secenekad'");
		$sonuc =$dba->fetch_object($sql);
		if($sonuc){
		return $sonuc->id;
		}else{
		return false;
		}
	}
	
	public function SecenekDuzenle($secenekid,$secenekad,$secenekbagid){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Secenek();
	if($bir->SecenekVarmi($secenekad)){
		if($secenekid == $bir->SecenekVarmi($secenekad)){
		$sql = $dba->query("update ".$this->tabloAd ." set secenekad ='$secenekad', secenekbagid='$secenekbagid' where id =$secenekid");
		$sonuc=true;
		}else{
			$sonuc=2;
		}
	}else{
		$sql = $dba->query("update ".$this->tabloAd ." set secenekad ='$secenekad', secenekbagid='$secenekbagid' where id =$secenekid");
		$sonuc=1;
	}
	return $sonuc;
	}
	
	public function SecenekSil($secenekid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAd ." where id =$secenekid");
	$sonuc=1;
	return $sonuc;
	}
}

?>