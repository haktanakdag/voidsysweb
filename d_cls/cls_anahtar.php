<?php
class Anahtarlar{
private $Anahtarid;
private $Anahtarad;

	var $tabloAd="anahtarlar";
	
	public function AnahtarSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	public function AnahtarGetir($Anahtarid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ."
	where id =$Anahtarid");
        //echo "select * from  $this->tabloAd where id =$Anahtarid";
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function AnahtarlariGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
        //echo "select * from ".$this->tabloAd ." $aramaString order by id asc $pagerWhere";
	$sql = $dba->query("select * from ".$this->tabloAd ." $aramaString order by id asc $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
        
        public function AnahtarlariGetirGrubaGore($grupid ,$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
        echo "select * from ".$this->tabloAd ." where grup =$grupid $aramaString";
	$sql = $dba->query("select * from ".$this->tabloAd ." where grup =$grupid".  $aramaString);
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
        
        public function AnahtaraBagliKonuSayiGetir($anahtarid){
            $dba = new dbClass();
            $dba->connect();
            $sql = $dba->query("select count(id) sayi from yazilar where anahtarlar like '%|$anahtarid|%'");
            $sonuc = $dba->fetch_object($sql);
            return $sonuc ;
            
        }
	
	public function AnahtarlariGetirGorevTanimBag($anahtaridler="0"){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ." where id in(".$anahtaridler.")");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function AnahtarEkle($Anahtarad,$ozel,$grup){
	$dba = new dbClass();
	$dba->connect();
	$data = new Anahtarlar();
	if($data->AnahtarVarmi($Anahtarad,0)==true){
		$sonuc = "anahtarvar";
	}else{
            //echo $ozel;
            //echo "insert into ".$this->tabloAd ." (anahtarad,ozel) values('$Anahtarad',$ozel)";
            //echo "insert into ".$this->tabloAd ." (anahtarad,ozel,grup) values('$Anahtarad',$ozel,$grup)";
            $sql = $dba->query("insert into ".$this->tabloAd ." (anahtarad,ozel,grup) values('$Anahtarad',$ozel,$grup)");
            $sonuc = $dba->insert_id($sql);
		}
	return $sonuc;
	}

	
	public function AnahtarDuzenle($Anahtarid,$Anahtarad,$ozel,$grup){
	$dba = new dbClass();
	$dba->connect();
	$data = new Anahtarlar();
	if($data->AnahtarVarmi($Anahtarad,$Anahtarid)==true){
           $sonuc="zatenvar";
        }else{
            //echo $ozel;
                //echo "update ".$this->tabloAd ." set anahtarad ='$Anahtarad' , ozel=$ozel where id =$Anahtarid";
		$sql = $dba->query("update ".$this->tabloAd ." set anahtarad ='$Anahtarad' , ozel=$ozel, grup=$grup where id =$Anahtarid");
		$sonuc=1;
	}
	return $sonuc;
	}
	
        	
	public function AnahtarVarmi($anahtarad,$Anahtarid)
	{
            $dba = new dbClass();
            $dba->connect();
            $sql = $dba->query("select id from ".$this->tabloAd ." where anahtarad='$anahtarad' and id <> $Anahtarid");
            $sonuc =$dba->fetch_object($sql);
            if($sonuc){
                return true;
            }else{
                return false;
            }
	}
        
	public function AnahtarSil($anahtarid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAd ." where id =$anahtarid");
	$sonuc=1;
	return $sonuc;
	}
}

?>