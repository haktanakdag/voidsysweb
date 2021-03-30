<?php
class Unvanlar {
private $Unvanid;
private $Unvanad;

	var $tabloAd="unvanlar";
	
	public function UnvanSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	public function UnvanGetir($Unvanid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ."
	where id =$Unvanid");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function UnvanlariGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ." $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function UnvanEkle($unvanad,$bagliunvanid){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Unvanlar();
	if($bir->UnvanVarmi($unvanad)){
		$sonuc = "unvanvar";
	}else{
		//echo "insert into ".$this->tabloAd ." (unvanad,bagliunvanid) values('$unvanad',$bagliunvanid)";
		$sql = $dba->query("insert into ".$this->tabloAd ." (unvanad,bagliunvanid) values('$unvanad',$bagliunvanid)");
		$sonuc = $dba->insert_id($sql);
		}
	return $sonuc;
	}
	
	public function UnvanVarmi($Unvanad)
	{
		$dba = new dbClass();
		$dba->connect();
		$sql = $dba->query("select id from ".$this->tabloAd ." where email='$Unvanad'");
		$sonuc =$dba->fetch_object($sql);
		if($sonuc){
		return $sonuc->id;
		}else{
		return false;
		}
	}
	
	public function UnvanDuzenle($unvanid,$unvanad,$bagliunvanid){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Unvanlar();
	if($bir->UnvanVarmi($unvanad)){
		if($Unvanid == $bir->UnvanVarmi($unvanad)){
		$sql = $dba->query("update ".$this->tabloAd ." set unvanad ='$unvanad',bagliunvanid=$bagliunvanid where id =$unvanid");
		$sonuc=true;
		}else{
			$sonuc=2;
		}
	}else{
		//ECHO "update ".$this->tabloAd ." set Unvanad ='$unvanad' where id =$Unvanid";
		$sql = $dba->query("update ".$this->tabloAd ." set unvanad ='$unvanad',bagliunvanid=$bagliunvanid where id =$unvanid");
		$sonuc=1;
	}
	return $sonuc;
	}
	
	public function UnvanSil($unvanid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAd ." where id =$unvanid");
	$sonuc=1;
	return $sonuc;
	}
}

?>