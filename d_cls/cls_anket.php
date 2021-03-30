<?php
class Anket {
private $anketid;
private $anketad;

	var $tabloAdAnketBaslik="anketbaslik";
	var $tabloAdAnketSoru="anketsoru";
	var $tabloAdAnketCevapBaslik="anketcevapbaslik";
	var $tabloAdAnketCevapDetay="anketcevapdetay";
	
	public function AnketSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAdAnketBaslik);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function AnketSoruSayiBul($anketid){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAdAnketSoru." where anketid=$anketid");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function AnketGetir($anketid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAdAnketBaslik ."
	where id =$anketid");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function AnketSoruGetir($anketsoruid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAdAnketSoru ."
	where id =$anketsoruid");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function AnketleriGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAdAnketBaslik ." $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function AnketSorulariGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	//echo "select * from ".$this->tabloAdAnketSorular ." $aramaString $pagerWhere";
	$sql = $dba->query("select * from ".$this->tabloAdAnketSoru ." $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function AnketUygulamaSorulariGetir($anketid){
	$dba = new dbClass();
	$dba->connect();
	//echo "select * from ".$this->tabloAdAnketSoru ." where anketid=$anketid";
	$sql = $dba->query("select * from ".$this->tabloAdAnketSoru ." where anketid=$anketid");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	

	public function AnketVarmi($anketad,$anketid)
	{
		$dba = new dbClass();
		$dba->connect();
		$sql = $dba->query("select id from ".$this->tabloAdAnketBaslik ." where anketad='$anketad' and id <>$anketid");
		$sonuc =$dba->fetch_object($sql);
		if($sonuc){
		return $sonuc->id;
		}else{
		return false;
		}
	}
	
	public function AnketEkle($anketad,$aciklama,$durumid){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Anket();
	if($bir->AnketVarmi($anketad,0)){
		$sonuc="anketvar";
	}else{
            //echo "insert into ".$this->tabloAdAnketBaslik ." (anketad,aciklama,durumid) values('$anketad','$aciklama','$durumid')";
		$sql = $dba->query("insert into ".$this->tabloAdAnketBaslik ." (anketad,aciklama,durumid) values('$anketad','$aciklama','$durumid')");
		$sonuc = $dba->insert_id($sql);
	}
	return $sonuc;
	}
	
	public function AnketDuzenle($anketid,$anketad,$aciklama,$durumid){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Anket();
	if($bir->AnketVarmi($anketad,$anketid)){
		$sonuc="anketvar";
	}else{
		$sql = $dba->query("update ".$this->tabloAdAnketBaslik ." set anketad ='$anketad',aciklama='$aciklama',durumid='$durumid' where id =$anketid");
		$sonuc=$anketid;
	}
	return $sonuc;
	}
	
	public function AnketSoruVarmi($anketsoruid,$anketid,$soru)
	{
		$dba = new dbClass();
		$dba->connect();
		$sql = $dba->query("select id from ".$this->tabloAdAnketSoru ." where soru='$soru' and anketid=$anketid and  id <>$anketsoruid");
		$sonuc =$dba->fetch_object($sql);
		if($sonuc){
		return $sonuc->id;
		}else{
		return false;
		}
	}
	
	public function AnketSoruEkle($anketid,$sorutip,$soru){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Anket();
	if($bir->AnketSoruVarmi(0,$anketid,$soru)){
		$sonuc="anketsoruvar";
	}else{
		$sql = $dba->query("insert into ".$this->tabloAdAnketSoru ." (anketid,sorutip,soru) values('$anketid','$sorutip','$soru')");
		$sonuc = $dba->insert_id($sql);
	}
	return $sonuc;
	}
	
	public function AnketSoruDuzenle($anketsoruid,$anketid,$sorutip,$soru){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Anket();
	if($bir->AnketSoruVarmi($anketsoruid,$anketid,$soru)){
		$sonuc="anketsoruvar";
	}else{
		$sql = $dba->query("update ".$this->tabloAdAnketSoru ." set sorutip ='$sorutip',soru='$soru' where id =$anketsoruid");
		$sonuc=$anketsoruid;
	}
	return $sonuc;
	}
	
	public function AnketSil($anketid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAdAnketBaslik ." where id =$anketid");
	$sql = $dba->query("delete from ".$this->tabloAdAnketSoru ." where anketid =$anketid");
	$sql = $dba->query("delete from ".$this->tabloAdAnketCevapBaslik ." where anketid =$anketid");
	$sql = $dba->query("delete from ".$this->tabloAdAnketCevapDetay ." where anketid =$anketid");
	$sonuc=1;
	return $sonuc;
	}
	
	public function AnketSoruSil($anketsoruid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAdAnketSoru ." where id =$anketsoruid");
	$sql = $dba->query("delete from ".$this->tabloAdAnketCevapBaslik ." where anketid =$anketid");
	$sql = $dba->query("delete from ".$this->tabloAdAnketCevapDetay ." where anketid =$anketid");
	$sonuc=1;
	return $sonuc;
	}
	
	public function AnketCevaplariSil($anketid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAdAnketCevapBaslik ." where anketid =$anketid");
	$sql = $dba->query("delete from ".$this->tabloAdAnketCevapDetay ." where anketid =$anketid");
	$sonuc=1;
	return $sonuc;
	}
	
	public function AnketCevapSil($anketcevapbaslikid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAdAnketCevapBaslik ." where id =$anketcevapbaslikid");
	$sql = $dba->query("delete from ".$this->tabloAdAnketCevapDetay ." where anketcevapid =$anketcevapbaslikid");
	$sonuc=1;
	return $sonuc;
	}
	
	public function AnketCevapBaslikEkle($anketid,$adsoyad,$cinsiyet,$email,$telefon,$adres){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("insert into ".$this->tabloAdAnketCevapBaslik ." (anketid,adsoyad,cinsiyet,email,telefon,adres) values($anketid,'$adsoyad','$cinsiyet','$email','$telefon','$adres')");
	$sonuc = $dba->insert_id($sql);
	return $sonuc;
	}
	
	public function AnketCevapDetayEkle($anketid,$anketsoruid,$anketcevapid,$cevapsayi,$cevapyazi){
	$dba = new dbClass();
	$dba->connect();
	//echo "insert into ".$this->tabloAdAnketCevapDetay ." (anketid,anketsoruid,anketcevapid,cevapsayi,cevapyazi) values($anketid,$anketsoruid,$anketcevapid,$cevapsayi,'$cevapyazi')";
	$sql = $dba->query("insert into ".$this->tabloAdAnketCevapDetay ." (anketid,anketsoruid,anketcevapid,cevapsayi,cevapyazi) values($anketid,$anketsoruid,$anketcevapid,$cevapsayi,'$cevapyazi')");
	$sonuc = $dba->insert_id($sql);
	return $sonuc;
	}
	
}

?>