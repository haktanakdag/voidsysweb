<?php

class clsMenu {
	public $menuId;
	public $menuad;
	public $baglanti;
	public $menubaslik;
	public $modul;
	public $sira;
	public $anasayfa;
        
	var $tabloAd="menu";
        var $tabloAdMobil="mobilmenu";
	
	public function  menuGetir($menuId){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ." where id =$menuId");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function menuleriGetir($menubaslik,$menubag){
	$dba = new dbClass();
	$dba->connect();
	//echo "select * from ".$this->tabloAd ." $aramaString $pagerWhere";
	//echo "select * from ".$this->tabloAd ." where modul =$modul and menubag=$menubag order by sira asc";
	//echo "select * from ".$this->tabloAd ." where menubag =$ and menubag=$menubaslik and anasayfa=$anasayfa order by sira asc";
        //echo "select * from ".$this->tabloAd ." where menubaslik =$menubaslik and menubag=$menubag order by sira asc";
	$sql = $dba->query("select * from ".$this->tabloAd ." where menubaslik =$menubaslik and menubag=$menubag order by sira asc");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
   
        
        public function mobilmenuleriGetir(){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAdMobil ." order by sira asc");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
}

?>