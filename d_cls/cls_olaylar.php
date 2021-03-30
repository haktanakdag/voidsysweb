<?php
class Olaylar {
private $olayid;
private $bastarih;
private $bittarih;
private $olay;

	var $tabloAd="olay";
	
	public function OlaySayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	public function OlayGetir($olayid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ."
	where id =$olayid");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function OlaylariGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
        //echo "select * from ".$this->tabloAd ." $aramaString $pagerWhere";
	$sql = $dba->query("select * from ".$this->tabloAd ." $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function OlayEkle($bastarih,$bittarih,$olay){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Olaylar();
	if($bir->OlayVarmi($olay)){
		$sonuc = "olayvar";
	}else{
		$sql = $dba->query("insert into ".$this->tabloAd ." (bastarih,bittarih,olay) values('$bastarih','$bittarih','$olay')");
		$sonuc = $dba->insert_id($sql);
		}
	return $sonuc;
	}
	
	public function OlayVarmi($olay)
	{
		$dba = new dbClass();
		$dba->connect();
		$sql = $dba->query("select id from ".$this->tabloAd ." where olay='$olay'");
		$sonuc =$dba->fetch_object($sql);
		if($sonuc){
		return $sonuc->id;
		}else{
		return false;
		}
	}
	
	public function OlayDuzenle($olayid,$bastarih,$bittarih,$olay){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Olaylar();
	if($bir->OlayVarmi($olay)){
		if($olayid == $bir->OlayVarmi($olay)){
		$sql = $dba->query("update ".$this->tabloAd ." set olay ='$olay',bastarih='$bastarih',bittarih='$bittarih' where id =$olayid");
		$sonuc=true;
		}else{
			$sonuc=2;
		}
	}else{
		$sql = $dba->query("update ".$this->tabloAd ." set olay ='$olay',bastarih='$bastarih',bittarih='$bittarih' where id =$olayid");
		$sonuc=1;
	}
	return $sonuc;
	}
	
	public function OlaySil($olayid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAd ." where id =$olayid");
	$sonuc=1;
	return $sonuc;
	}
}

?>