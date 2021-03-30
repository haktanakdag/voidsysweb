<?php
class Urun{
private $urunid;
private $urunad;

    var $tabloAd="urunler";

    public function UrunSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    public function UrunGetir($urunid){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAd ."
    where id =$urunid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }

    public function UrunleriGetir($pagerWhere ="",$aramaString=""){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere";
    $sql = $dba->query("select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    
    public function UrunleriGetirAnahtaraGore($anahtarid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." where anahtarlar like '%|$anahtarid|%'";
    $sql = $dba->query("select * from ".$this->tabloAd ." where anahtarlar like '%|$anahtarid|%' order by id");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }

    public function UrunEkle($urunkod,$urunad,$anahtarlar){
    $dba = new dbClass();
    $dba->connect();
    $cl = new Urun();
    if($cl->UrunVarmi($urunad,0)==true){
      $sonuc = "zatenvar";
    }else{
        //echo "insert into ".$this->tabloAd ." (urunad,anahtarlar) values('$urunad','$anahtarlar')";
        $sql = $dba->query("insert into ".$this->tabloAd ." (urunkod,urunad,anahtarlar) values('$urunkod','$urunad','$anahtarlar')");
        $sonuc = $dba->insert_id($sql);
         }
    return $sonuc;
    }
    
    public Function UrunDuzenle($urunkod,$urunad,$urunid,$anahtarlar){
        $dba = new dbClass();
        $dba->connect();
        $cl = new Urun();
        if($cl->UrunVarmi($urunad,$urunid)==true){
           $sonuc="zatenvar";
        }else{
             $sql=$dba->query("update $this->tabloAd set urunkod='$urunkod', urunad ='$urunad', anahtarlar ='$anahtarlar' where id =$urunid");
            $sonuc =$dba->affected_rows($sql);
        }
        return $sonuc;
    }

    public function UrunVarmi($urunad,$urunid)
    {
        $dba = new dbClass();
        $dba->connect();
        $sql = $dba->query("select count(id) sayi from ".$this->tabloAd ." where urunad='$urunad' and id <> $urunid");
        $sonuc =$dba->fetch_object($sql);
        if($sonuc->sayi>0){
            return true;
        }else{
            return false;
        }
    }

    public function UrunSil($urunid){
    $dba = new dbClass();
    $dba->connect();
    //$birimcls= new Birim();
    $sql = $dba->query("delete from ".$this->tabloAd ." where id =$urunid");
    //$sql =$dba->query("select id from quiz where urunid =$urunid");
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