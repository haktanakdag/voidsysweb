<?php
class Fiyat{

    var $tabloAd="fiyatlar";

    public function FiyatSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    public function FiyatGetir($fiyatid){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAd ."
    where id =$fiyatid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    
    public function FiyatGetirUruneGore($urunid){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select max(id) fiyatid from ".$this->tabloAd ."
    where urunid =$urunid");
    $sonuc = $dba->fetch_object($sql);
    $sql=$dba->query("select * from ".$this->tabloAd ." where id=$sonuc->fiyatid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }

    
    public function FiyatlariGetir($pagerWhere ="",$aramaString=""){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }

    public function FiyatEkle($aciklama,$urunid,$alisfiyat,$satisfiyat){
    $dba = new dbClass();
    $dba->connect();
    $cl = new Fiyat();
    if($cl->FiyatVarmi($aciklama,0)){
      $sonuc = "zatenvar";
    }else{
        $sql = $dba->query("insert into ".$this->tabloAd ." (aciklama,urunid,alisfiyat,satisfiyat) values('$aciklama',$urunid,$alisfiyat,$satisfiyat)");
        $sonuc = $dba->insert_id($sql);
         }
    return $sonuc;
    }
    
    public Function FiyatDuzenle($aciklama,$urunid,$alisfiyat,$satisfiyat,$fiyatid){
        $dba = new dbClass();
        $dba->connect();
        $cl = new Fiyat();
        if($cl->FiyatVarmi($aciklama,$fiyatid)==true){
           $sonuc="zatenvar";
        }else{
             $sql=$dba->query("update $this->tabloAd set aciklama ='$aciklama',urunid=$urunid,alisfiyat=$alisfiyat,satisfiyat=$satisfiyat where id =$fiyatid");
            $sonuc =$dba->affected_rows($sql);
        }
        return $sonuc;
    }

    public function FiyatVarmi($aciklama,$fiyatid)
    {
        $dba = new dbClass();
        $dba->connect();
        $sql = $dba->query("select count(id) sayi from ".$this->tabloAd ." where aciklama='$aciklama' and id <> $fiyatid");
        $sonuc =$dba->fetch_object($sql);
        if($sonuc->sayi>0){
            return true;
        }else{
            return false;
        }
    }

    public function FiyatSil($fiyatid){
    $dba = new dbClass();
    $dba->connect();
    $quizcls= new Quiz();
    $sql = $dba->query("delete from ".$this->tabloAd ." where id =$fiyatid");
    $sonuc=1;
    return $sonuc;
    }
}

?>