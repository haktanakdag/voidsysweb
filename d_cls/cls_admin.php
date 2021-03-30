<?php
class Admin {
private $adminid;
private $admin;
private $sifre;
private $mail;

	var $tabloAd="admin";
	
	public function MailGetir(){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select mail from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
        
        public function SifreGetir(){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select sifre from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function MailDegistir($mail){
	$dba = new dbClass();
	$dba->connect();
        $sql = $dba->query("update ".$this->tabloAd ." set mail='$mail'");
        $sonuc=1;
	return $sonuc;
	}
        
        public function SifreDegistir($sifre){
	$dba = new dbClass();
	$dba->connect();
        $sql = $dba->query("update ".$this->tabloAd ." set sifre='$sifre'");
        $sonuc=1;
	return $sonuc;
	}
	
}

?>