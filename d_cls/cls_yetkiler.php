<?php
class Yetkiler {
private $kullaniciid;
private $birimid;
private $yetkibirimid;

	var $tabloAdBirimYetki="birimyetki";
	var $tabloAdKullaniciYetki="kullaniciyetki";
	
	
	public function BirimYetkileriGetir($birimid){
	$dba = new dbClass();
	$dba->connect();
	//echo "select id,birimid,yetkibirimid from ".$this->tabloAdBirimYetki;
	//echo "select birimid,yetkibirimid from ".$this->tabloAdBirimYetki ."where birimid=$birimid";
	$sql = $dba->query("select birimid,yetkibirimid from ".$this->tabloAdBirimYetki ." where birimid=$birimid");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function KullaniciYetkileriGetir($kullaniciid){
	$dba = new dbClass();
	$dba->connect();
        echo "select kulid,yetkibirimid from ".$this->tabloAdKullaniciYetki." where kulid=$kullaniciid";
	$sql = $dba->query("select kulid,yetkibirimid from ".$this->tabloAdKullaniciYetki." where kulid=$kullaniciid");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function BirimYetkiEkle($birimid,$byetkiler){
	$dba = new dbClass();
	$dba->connect();
	$lis = new Yetkiler();
		$sql =$dba->query("delete from ".$this->tabloAdBirimYetki." where birimid =".$birimid);
		$sonuc=1;
		if($sonuc==1){
			for($y=0;$y<count($byetkiler);$y++){
				//echo "insert into ".$this->tabloAdBirimYetki."(birimid,yetkibirimid) values($birimid,$byetkiler[$y])";
				//echo "<br>";
				$sqlinsert =$dba->query("insert into ".$this->tabloAdBirimYetki."(birimid,yetkibirimid) values($birimid,$byetkiler[$y])");
				$sonuc = $dba->insert_id($sql);
			}
		}else{
			$sonuc=0;
		}
	return $sonuc;
	}
	
	public function KullaniciYetkiEkle($kullaniciid,$byetkiler){
        echo "alsjdasd";
	$dba = new dbClass();
	$dba->connect();
	$lis = new Yetkiler();
		$sql =$dba->query("delete from ".$this->tabloAdKullaniciYetki." where kulid =".$kullaniciid);
		$sonuc=1;
		if($sonuc==1){
			for($y=0;$y<count($byetkiler);$y++){
				//echo "insert into ".$this->tabloAdKullaniciYetki."(kulid,yetkibirimid) values($kullaniciid,$byetkiler[$y])";
				$sqlinsert =$dba->query("insert into ".$this->tabloAdKullaniciYetki."(kulid,yetkibirimid) values($kullaniciid,$byetkiler[$y])");
				$sonuc = $dba->insert_id($sql);
			}
		}else{
			$sonuc=0;
		}
	return $sonuc;
	}
}
?>