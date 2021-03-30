<?php
class IsTanimlari {
Private $IsTanimId;
private $gorevId;
private $isne;
private $iskimdenalinacak;
private $isinozeti;
private $amac;
private $yontem;
private $surec;
private $ortam;
private $issonucukimeverilecek;

	var $tabloAd="istanimlari";
	var $viewAd="view_istanimlari";
	
	public function IsTanimSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	public function IsTanimiGetir($IsTanimId){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ." where id =$IsTanimId");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function IsTanimlariGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	//echo "select * from ".$this->viewAd ." $aramaString $pagerWhere";
	$sql = $dba->query("select * from ".$this->viewAd ." $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function IsTanimiEkle($isne,$iskimden,$isinozeti,$amac,$yontem,$surec,$ortam,$iskime,$gorevid){
	$dba = new dbClass();
	$dba->connect();
	//echo "insert into ".$this->tabloAd ." (isne,iskimden,isinozeti,amac,yontem,surec,ortam,iskime,gorevid) values('$isne','$iskimden','$isinozeti','$amac','$yontem','$surec','$ortam','$iskime',$gorevid)";
        $sql = $dba->query("insert into ".$this->tabloAd ." (isne,iskimden,isinozeti,amac,yontem,surec,ortam,iskime,gorevid) values ('$isne','$iskimden','$isinozeti','$amac','$yontem','$surec','$ortam','$iskime',$gorevid) ");
	$sonuc = $dba->insert_id($sql);
	return $sonuc;
	}
	
	
	public function IsTanimiDuzenle($IsTanimId,$isne,$iskimden,$isinozeti,$amac,$yontem,$surec,$ortam,$iskime,$gorevid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("update ".$this->tabloAd ." set gorevid=$gorevid, isne='$isne', iskimden='$iskimden', isinozeti='$isinozeti', amac='$amac', yontem='$yontem', surec='$surec', ortam='$ortam', iskime='$iskime' where id =$IsTanimId");
	$sonuc=1;
	return $sonuc;
	}
	
	public function IsTanimiSil($IsTanimId){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAd ." where id =$IsTanimId");
	$sonuc=1;
	return $sonuc;
	}
}

?>