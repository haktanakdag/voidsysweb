<?php
class Dersler{
private $Dersid;
private $Dersad;

	var $tabloAd="dersler";
	
	public function DersSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	public function DersGetir($Dersid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ."
	where id =$Dersid");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function DersleriGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ." $aramaString order by id asc $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
        

	
	public function DersEkle($Dersad){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Dersler();
	if($bir->DersVarmi($Dersad,0)){
		$sonuc = "zatenvar";
	}else{
            echo "insert into ".$this->tabloAd ." (dersad) values('$Dersad')";
            $sql = $dba->query("insert into ".$this->tabloAd ." (dersad) values('$Dersad')");
            $sonuc = $dba->insert_id($sql);
		}
	return $sonuc;
	}
	
	public function DersVarmi($Dersad,$Dersid)
	{
            $dba = new dbClass();
            $dba->connect();
            $sql = $dba->query("select id from ".$this->tabloAd ." where dersad='$Dersad' and id <> $Dersid");
            $sonuc =$dba->fetch_object($sql);
            if($sonuc){
                return true;
            }else{
                return false;
            }
	}
	
	public function DersDuzenle($Dersid,$Dersad){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Dersler();
	if($bir->DersVarmi($Dersad,$Dersid)==true){
        $sonuc="zatenvar";
        }else{
        $sql = $dba->query("update ".$this->tabloAd ." set dersad ='$Dersad' where id =$Dersid");
        $sonuc=1;
	}
	return $sonuc;
	}
	
	public function DersSil($Dersid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAd ." where id =$Dersid");
	$sonuc=1;
	return $sonuc;
	}
}

?>