<?php
class GorevTanimlar {
private $Unvanid;
private $Unvanad;

	var $tabloAd="gorevtanim";
	
	public function GorevTanimSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	public function GorevTanimGetir($Unvanid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ."
	where id =$Unvanid");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function GorevTanimlariGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	//echo "select * from ".$this->tabloAd ." $aramaString $pagerWhere";
	$sql = $dba->query("select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function GorevTanimlariAnahtaraGoreGetir($aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	//
	echo "select g.id,g.adsoyad from gorevtanim g inner join ( select concat('|',convert(id, char(50)),'|') as id  from anahtarlar where anahtarad like '%$aramaString%' ) x on g.anahtarlar collate utf8_turkish_ci like concat('%', x.id ,'%') group by g.id,g.adsoyad";
	$sql = $dba->query("select g.id,g.adsoyad from gorevtanim g inner join ( select concat('|',convert(id, char(50)),'|') as id  from anahtarlar where anahtarad like '%$aramaString%' ) x on g.anahtarlar collate utf8_turkish_ci like concat('%', x.id ,'%') group by g.id,g.adsoyad");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
        
        public function GorevTanimlariIsmeGoreGetir($aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	//
	//echo "select g.id,g.adsoyad from gorevtanim g where g.adsoyad like '%$aramaString%'";
	$sql = $dba->query("select g.id,g.adsoyad from gorevtanim g where g.adsoyad like '%$aramaString%'");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function GorevTanimlariBirimeGoreGetir($aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	//
	//echo "select * from ".$this->tabloAd." where birimid=".$aramaString;
	$sql = $dba->query("select * from ".$this->tabloAd." where birimid=".$aramaString);
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function GorevTanimEkle($adsoyad,$birimid,$unvanid,$bagunvanid,$gorevinamaci,$gorevkisatanimi,$vekaletid,$issorumluluklari,$yetkileri,$anahtarlar){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("insert into ".$this->tabloAd ." (adsoyad,birimid,unvanid,bagliunvanid,gorevinamaci,gorevkisatanimi,vekaletid,issorumluluklari,yetkileri,anahtarlar) values('$adsoyad',$birimid,$unvanid,$bagunvanid,'$gorevinamaci','$gorevkisatanimi','$vekaletid','$issorumluluklari','$yetkileri','$anahtarlar')");
	$sonuc = $dba->insert_id($sql);
	return $sonuc;
	}
	
	
	public function GorevTanimDuzenle($gorevtanimid,$adsoyad,$birimid,$unvanid,$bagunvanid,$gorevinamaci,$gorevkisatanimi,$vekaletid,$issorumluluklari,$yetkileri,$anahtarlar){
	$dba = new dbClass();
	$dba->connect();
	//echo "update ".$this->tabloAd ." set adsoyad='$adsoyad', birimid='$birimid', unvanid='$unvanid', bagliunvanid='$bagliunvanid', gorevinamaci='$gorevinamaci', gorevkisatanimi='$gorevkisatanimi', vekalet='$vekalet', yetkileri='$yetkileri', anahtarlar='$anahtarlar' where id =$gorevtanimid";
	$sql = $dba->query("update ".$this->tabloAd ." set adsoyad='$adsoyad', birimid='$birimid', unvanid='$unvanid', bagliunvanid='$bagunvanid', gorevinamaci='$gorevinamaci', gorevkisatanimi='$gorevkisatanimi', vekaletid='$vekaletid',issorumluluklari='$issorumluluklari', yetkileri='$yetkileri', anahtarlar='$anahtarlar' where id =$gorevtanimid");
	$sonuc=1;
	return $sonuc;
	}
	
	public function GorevTanimiSil($IsTanimId){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAd ." where id =$IsTanimId");
	$sonuc=1;
	return $sonuc;
	}

}

?>