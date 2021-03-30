<?php
class Stok{
    var $tabloAd="stok";

    public function StokSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    public function StokGetir($urunid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." where id =$urunid";
    $sql = $dba->query("select * from ".$this->tabloAd ."
    where id =$urunid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }

    public function StoklariGetir($pagerWhere ="",$aramaString=""){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere";
    $sql = $dba->query("select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    
    public function StoklariGetirGrubaGore($grupkod){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." where anahtarlar like '%|$anahtarid|%'";
    $sql = $dba->query("select * from ".$this->tabloAd ." where grupkod = '$grupkod' order by id");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    public function StoklariGetirEkGrubaGore($ekgrupkod){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." where anahtarlar like '%|$anahtarid|%'";
    $sql = $dba->query("select * from ".$this->tabloAd ." where ekgrupkod = '$grupkod' order by id");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    public function StokEkle($stokkod,$stokad,$grupkod,$ekgrupkod,$birim,$kdvoran,$aciklama,$alisfiyat,$satisfiyat){
    $dba = new dbClass();
    $dba->connect();
    $cl = new Stok();
    if($cl->StokVarmi($stokkod,0)==true){
      $sonuc = "zatenvar";
    }else{
        //echo "insert into ".$this->tabloAd ." (stokad,anahtarlar) values('$stokad','$anahtarlar')";
        $sql = $dba->query("insert into ".$this->tabloAd ." (stokkod,stokad,grupkod,ekgrupkod,birim,kdvoran,aciklama,alisfiyat,satisfiyat) values('$stokkod','$stokad','$grupkod','$ekgrupkod','$birim','$kdvoran','$aciklama','$alisfiyat','$satisfiyat')");
        $sonuc = $dba->insert_id($sql);
         }
    return $sonuc;
    }
    
    public Function StokDuzenle($stokkod,$stokad,$grupkod,$ekgrupkod,$birim,$kdvoran,$aciklama,$alisfiyat,$satisfiyat,$stokid){
        $dba = new dbClass();
        $dba->connect();
        $cl = new Stok();
        if($cl->StokVarmi($stokad,$stokid)==true){
           $sonuc="zatenvar";
        }else{
             $sql=$dba->query("update $this->tabloAd set stokkod='$stokkod', stokad ='$stokad', grupkod ='$grupkod', ekgrupkod='$ekgrupkod', birim ='$birim', kdvoran=$kdvoran, aciklama='$aciklama', alisfiyat=$alisfiyat, satisfiyat=$satisfiyat  where id =$stokid");
            $sonuc =$dba->affected_rows($sql);
        }
        return $sonuc;
    }

    public function StokVarmi($stokkod,$stokid)
    {
        $dba = new dbClass();
        $dba->connect();
        $sql = $dba->query("select count(id) sayi from ".$this->tabloAd ." where stokkod='$stokkod' and id <> $stokid");
        $sonuc =$dba->fetch_object($sql);
        if($sonuc->sayi>0){
            return true;
        }else{
            return false;
        }
    }

    public function StokSil($stokid){
    $dba = new dbClass();
    $dba->connect();
    //$birimcls= new Birim();
    $sql = $dba->query("delete from ".$this->tabloAd ." where id =$stokid");
    $sql =$dba->query("select id from stok where stokid =$stokid");
    /*while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    foreach(@$r as $s){
      $quizcls->BirimSil($s->id);
    }*/
    $sonuc=1;
    return $sonuc;
    }
}

?>