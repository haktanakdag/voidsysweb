<?php
class Giris{
	private $email;
	private $sifre;
	private $admin;
	
	function girisKontrol($email,$sifre){
		$dba= new dbClass();
		$dba->connect();
		//echo "SELECT id from kullanicilar where email='$email' and sifre='$sifre'";
		$sql = $dba->query("SELECT id from kullanicilar where email='$email' and sifre='$sifre'");
		$sonuc = $dba->fetch_object($sql);
		return $sonuc;
	}
	function AdminGirisKontrol($admin,$sifre){
		$dba= new dbClass();
		$dba->connect();
		//echo "SELECT admin from admin where admin='$admin' and sifre='$sifre'";
		$sql = $dba->query("SELECT admin from admin where admin='$admin' and sifre='$sifre'");
		$sonuc = $dba->fetch_object($sql);
		return $sonuc;
	}
	
	function deneme(){
		$dba= new dbClass();
		$dba->connect();
		//echo "SELECT id from kullanicilar where email='$email' and sifre='$sifre'";
		$sql = $dba->query("SELECT * from kullanicilar");
		$sonuc = $dba->fetch_object($sql);
		return $sonuc;
	}
	
}
?>