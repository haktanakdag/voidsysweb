<?php
class Birimler {
private $birimid;
private $birimad;

	var $tabloAd="birimler";
	
	public function BirimSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function BirimSeviyeSayiGetir(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(distinct seviye) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function SeviyeBirimGetir($seviyeno){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select * from ".$this->tabloAd." where seviye=".$seviyeno);
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function BirimGetir($birimid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ."
	where id =$birimid");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function BirimleriGetir($pagerWhere ="",$aramaString =""){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select id,birimad,birimbagid from ".$this->tabloAd ." $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function BirimEkle($birimad,$birimbagid){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Birimler();
	if($bir->BirimVarmi($birimad)){
		$sonuc = "birimvar";
	}else{
		$sql = $dba->query("insert into ".$this->tabloAd ." (birimad,birimbagid) values('$birimad','$birimbagid')");
		$sonuc = $dba->insert_id($sql);
		}
	return $sonuc;
	}
	
	public function BirimVarmi($birimad)
	{
		$dba = new dbClass();
		$dba->connect();
		$sql = $dba->query("select id from ".$this->tabloAd ." where email='$birimad'");
		$sonuc =$dba->fetch_object($sql);
		if($sonuc){
		return $sonuc->id;
		}else{
		return false;
		}
	}
	
	public function BirimDuzenle($birimid,$birimad,$birimbagid){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Birimler();
	if($bir->BirimVarmi($birimad)){
		if($birimid == $bir->BirimVarmi($birimad)){
		$sql = $dba->query("update ".$this->tabloAd ." set birimad ='$birimad', birimbagid='$birimbagid' where id =$birimid");
		$sonuc=true;
		}else{
			$sonuc=2;
		}
	}else{
		$sql = $dba->query("update ".$this->tabloAd ." set birimad ='$birimad', birimbagid='$birimbagid' where id =$birimid");
		$sonuc=1;
	}
	return $sonuc;
	}
	
	public function BirimSil($birimid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAd ." where id =$birimid");
	$sonuc=1;
	return $sonuc;
	}
}

?>