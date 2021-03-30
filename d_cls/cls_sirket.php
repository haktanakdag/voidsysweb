<?php
class Sirket{
private $Sirketid;
private $Sirketad;

	var $tabloAd="sirketler";
	
     
	public function SirketSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	public function SirketGetir($Sirketid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ."
	where id =$Sirketid");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
	public function SirketleriGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAd ." $aramaString order by id asc $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
        

	
	public function SirketEkle($Sirketad){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Sirket();
	if($bir->SirketVarmi($Sirketad,0)){
		$sonuc = "zatenvar";
	}else{
            //echo "insert into ".$this->tabloAd ." (Sirketad,ozel) values('$Sirketad',$ozel)";
            $sql = $dba->query("insert into ".$this->tabloAd ." (sirketad) values('$Sirketad')");
            $sonuc = $dba->insert_id($sql);
		}
	return $sonuc;
	}
	
	public function SirketVarmi($Sirketad,$Sirketid)
	{
            $dba = new dbClass();
            $dba->connect();
            $sql = $dba->query("select id from ".$this->tabloAd ." where sirketad='$Sirketad' and id <> $Sirketid");
            $sonuc =$dba->fetch_object($sql);
            if($sonuc){
                return true;
            }else{
                return false;
            }
	}
	
	public function SirketDuzenle($Sirketid,$Sirketad){
	$dba = new dbClass();
	$dba->connect();
	$bir = new Sirket();
	if($bir->SirketVarmi($Sirketad,$Sirketid)==true){
        $sonuc="zatenvar";
        }else{
        $sql = $dba->query("update ".$this->tabloAd ." set sirketad ='$Sirketad' where id =$Sirketid");
        $sonuc=1;
	}
	return $sonuc;
	}
	
	public function SirketSil($Sirketid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAd ." where id =$Sirketid");
	$sonuc=1;
	return $sonuc;
	}
}

?>