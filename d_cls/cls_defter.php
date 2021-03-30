<?php
class Defter{
private $yaziid;
private $yaziad;

    var $tabloAd="defter";

    public function DefterSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAd." where giriscikistip = 1");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    
    public function DefterGetir($defterid){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAd ."
    where id =$defterid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }

    public function DefterKayitlariniGetir($pagerWhere ="",$aramaString=""){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from  ".$this->tabloAd ." $aramaString order by id desc $pagerWhere";
    //$sql = $dba->query("select id,islem,aciklama,islemtarih,cikis,giris from vw_defter $aramaString order by id desc $pagerWhere");
    $sql = $dba->query("select * from  ".$this->tabloAd ." $aramaString order by id desc $pagerWhere");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }

    public function DefterKayitEkle($islemtip,$projeid,$tutar,$islemtarih,$islemaciklama,$detayaciklama){
    $dba = new dbClass();
    $dba->connect();
    $cl = new Defter();
    //echo "insert into ".$this->tabloAd ." (islemtip,tutar,islemtarih,islemaciklama,detayaciklama) values($islemtip,$tutar,'$islemtarih','$islemaciklama','$detayaciklama')";
    $parametre = new Parametreler();
    $dparametre = $parametre->ParametreGetirA($islemtip);
    $tutar= $tutar*$dparametre->deger;
    $sql = $dba->query("insert into ".$this->tabloAd ." (islemtip,projeid,tutar,islemtarih,islemaciklama,detayaciklama) values($islemtip,$projeid,$tutar,'$islemtarih','$islemaciklama','$detayaciklama')");
    $sonuc = $dba->insert_id($sql);
    return $sonuc;
    }
    
    public Function DefterKayitDuzenle($defterid,$islemtip,$projeid,$tutar,$islemtarih,$islemaciklama,$detayaciklama){
        $dba = new dbClass();
        $dba->connect();
        $parametre = new Parametreler();
        $dparametre = $parametre->ParametreGetirA($islemtip);
        $tutar= $tutar*$dparametre->deger;
        $sql=$dba->query("update $this->tabloAd set islemtip =$islemtip, projeid=$projeid, tutar=$tutar , islemtarih='$islemtarih', islemaciklama='$islemaciklama', detayaciklama='$detayaciklama' where id =$defterid");
        $sonuc =$dba->affected_rows($sql);
        return $sonuc;
    }
    
    public function DefterKayitSil($defterid){
    $dba = new dbClass();
    $dba->connect();
    //$birimcls= new Birim();
    $sql = $dba->query("delete from ".$this->tabloAd ." where id =$defterid");
    $sonuc=1;
    return $sonuc;
    }
}

?>