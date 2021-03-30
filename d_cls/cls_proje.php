<?php
class Projeler {
private $projeid;
private $projead;

	var $tabloAd="projeler";
	
	public function ProjeSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	
	public function ProjeGetir($projeid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ."
	where id =$projeid");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function ProjeleriGetir($pagerWhere ="",$aramaString =""){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ." $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function ProjeEkle($sirketid,$projead){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Projeler();
	if($bir->ProjeVarmi($projead)){
		$sonuc = "projevar";
	}else{
		$sql = $dba->query("insert into ".$this->tabloAd ." (sirketid,projead) values('$sirketid','$projead')");
		$sonuc = $dba->insert_id($sql);
		}
	return $sonuc;
	}
	
	public function ProjeVarmi($projead)
	{
		$dba = new dbClass();
		$dba->connect();
		$sql = $dba->query("select id from ".$this->tabloAd ." where projead='$projead'");
		$sonuc =$dba->fetch_object($sql);
		if($sonuc){
		return $sonuc->id;
		}else{
		return false;
		}
	}
	
	public function ProjeDuzenle($projeid,$projead,$sirketid){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Projeler();
	if($bir->ProjeVarmi($projead)){
		if($secenekid == $bir->ProjeVarmi($projead)){
		$sql = $dba->query("update ".$this->tabloAd ." set projead ='$projead', sirketid='$sirketid' where id =$projeid");
		$sonuc=true;
		}else{
			$sonuc=2;
		}
	}else{
            //echo "update ".$this->tabloAd ." set projead ='$projead', sirketid='$sirketid' where id =$projeid";
		$sql = $dba->query("update ".$this->tabloAd ." set projead ='$projead', sirketid='$sirketid' where id =$projeid");
		$sonuc=1;
	}
	return $sonuc;
	}
	
	public function ProjeSil($projeid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAd ." where id =$projeid");
	$sonuc=1;
	return $sonuc;
	}
}

?>