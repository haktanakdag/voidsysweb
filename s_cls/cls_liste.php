<?php
class Listeler {
private $listebaslikId;
private $listedetayId;
private $lbaciklama;
private $ldaciklama;

	var $tabloAdListeBaslik="listebaslik";
	var $tabloAdListeDetay="listedetay";
	
	public function ListeBaslikSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAdListeBaslik);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	public function ListeDetaySayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAdListeDetay);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function ListeBaslikGetir($listebaslikId){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAdListeBaslik ."
	where id =$listebaslikId");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
        
	
        public function ListeBaslikGetirAciklamayaGore($lbaciklama){
	$dba = new dbClass();
	$dba->connect();
        //echo "select * from ".$this->tabloAdListeBaslik ." where lbaciklama ='$lbaciklama'";
	$sql = $dba->query("select * from ".$this->tabloAdListeBaslik ."
	where lbaciklama ='$lbaciklama'");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
        
        public function ListeDetayGetirAciklamayaGore($listebaslikId,$ldaciklama){
	$dba = new dbClass();
	$dba->connect();
        echo "select * from ".$this->tabloAdListeDetay ." where baslikid=$listebaslikId and ldaciklama ='$ldaciklama'";
	$sql = $dba->query("select * from ".$this->tabloAdListeDetay ."
	where baslikid=$listebaslikId and ldaciklama ='$ldaciklama'");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
        
	public function ListeDetayGetir($listedetayId){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAdListeDetay ."
	where id =$listedetayId");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function ListeBasliklariGetir($pagerWhere ="",$aramaString =""){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select id,lbaciklama from ".$this->tabloAdListeBaslik ." $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function ListeDetaylariGetir($pagerWhere ="",$aramaString =""){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select ld.id,lb.lbaciklama,ld.ldaciklama,baslikid from ".$this->tabloAdListeDetay ." ld inner join ".$this->tabloAdListeBaslik." lb on lb.id =ld.baslikid $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	Public function listeDetayGetirC($listebaslikId){
	$dba = new dbClass();
	$dba->connect();
	//echo "select id as ".$paciklama."id, baslikid, ldaciklama from ".$this->tabloAdListeDetay ." where baslikid=".$listebaslikId;
	$sql = $dba->query("select id, baslikid, ldaciklama from ".$this->tabloAdListeDetay ." where baslikid=".$listebaslikId." order by id asc");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function ListeBaslikEkle($lbaciklama){
	$dba = new dbClass();
	$dba->connect();
	$lis = new Listeler();
	if($lis->LbVarmi($lbaciklama)){
		$sonuc = "lbvar";
	}else{
		//echo "insert into ".$this->tabloAdListeBaslik ." (lbaciklama) values('$lbaciklama')";
		$sql = $dba->query("insert into ".$this->tabloAdListeBaslik ." (lbaciklama) values('$lbaciklama')");
		$sonuc = $dba->insert_id($sql);
		}
	return $sonuc;
	}
	
	public function ListeDetayEkle($ldaciklama,$listebaslikId){
	$dba = new dbClass();
	$dba->connect();
	$lis = new Listeler();
	//echo "insert into ".$this->tabloAdListeDetay ." (ldaciklama,baslikid) values('$ldaciklama','$listebaslikId')";
	$sql = $dba->query("insert into ".$this->tabloAdListeDetay ." (ldaciklama,baslikid) values('$ldaciklama','$listebaslikId')");
	$sonuc = $dba->insert_id($sql);
	return $sonuc;
	}
	
	public function LbVarmi($lbaciklama)
	{
		$dba = new dbClass();
		$dba->connect();
		$sql = $dba->query("select id from ".$this->tabloAdListeBaslik ." where lbaciklama='$lbaciklama'");
		$sonuc =$dba->fetch_object($sql);
		if($sonuc){
		return $sonuc->id;
		}else{
		return false;
		}
	}
	/*public function LdVarmi($ldaciklama,$listedetayId="")
	{
		$dba = new dbClass();
		$dba->connect();
		//echo "select id from ".$this->tabloAdListeDetay ." where ldaciklama='$ldaciklama' and id<>$listedetayId";
		$sql = $dba->query("select id from ".$this->tabloAdListeDetay ." where ldaciklama='$ldaciklama' and id<>$listedetayId");
		$sonuc =$dba->fetch_object($sql);
		if($sonuc){
		return $sonuc->id;
		}else{
		return false;
		}
	}*/
	
	public function ListeBaslikDuzenle($listebaslikId,$lbaciklama){
	$dba = new dbClass();
	$dba->connect();
	$lis = new Listeler();
	if($lis->LbVarmi($lbaciklama)){
		if($listebaslikId == $lis->LbVarmi($lbaciklama)){
		$sql = $dba->query("update ".$this->tabloAdListeBaslik." set lbaciklama='$lbaciklama' where id =$listebaslikId");
		$sonuc=true;
		}else{
			$sonuc=2;
		}
	}else{
		//echo "update ".$this->tabloAdListeBaslik." set lbaciklama='$lbaciklama' where id =$listebaslikId";
		$sql = $dba->query("update ".$this->tabloAdListeBaslik." set lbaciklama='$lbaciklama' where id =$listebaslikId");
		$sonuc=1;
	}
	return $sonuc;
	}

	public function ListeDetayDuzenle($listedetayId,$ldaciklama,$listebaslikId){
	$dba = new dbClass();
	$dba->connect();
	$lis = new Listeler();
	$sql = $dba->query("update ".$this->tabloAdListeDetay." set ldaciklama='$ldaciklama', baslikid='$listebaslikId' where id =$listedetayId");
	$sonuc=1;
	return $sonuc;
	}
	
	public function ListeBaslikSil($listebaslikId){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAdListeBaslik ." where id =$listebaslikId");
	$sql = $dba->query("delete from ".$this->tabloAdListeDetay. " where baslikid=".$listebaslikId);
	$sonuc=1;
	return $sonuc;
	}
	
	public function ListeDetaySil($listedetayId){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAdListeDetay ." where id =$listedetayId");
	$sonuc=1;
	return $sonuc;
	}
	
}

?>