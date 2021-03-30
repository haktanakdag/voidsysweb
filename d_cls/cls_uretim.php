<?php
class Uretim{
private $mamkod;
private $hamkod;

    var $tabloAdBaslik="uretimbaslik";
    var $tabloAdDetay="uretimdetay";

    public function UretimSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAdBaslik);
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    
    public function UretimGetir($uretimid){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAdBaslik ."
    where id =$uretimid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }

    public function UretimleriGetir($pagerWhere ="",$aramaString=""){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere";
    //echo "select * from ".$this->tabloAdBaslik ." $aramaString order by id desc $pagerWhere";
    $sql = $dba->query("select * from ".$this->tabloAdBaslik ." $aramaString order by id desc $pagerWhere");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
 
    public function UretimEkle($mamkod,$uretmiktar,$tarih,$depo){
    $dba = new dbClass();
    $dba->connect();
    $entegrasyon = new Entegrasyon();
    $dent = $entegrasyon->entNetsisUrunGetir($mamkod);
    $stokadi =$dent['STOK_ADI'];
    //echo "insert into ".$this->tabloAdBaslik ." (mamkod,mamad,uretmiktar,tarih,depokod) values('$mamkod','$stokadi',$uretmiktar','$tarih','$depo')";
    $sql = $dba->query("insert into ".$this->tabloAdBaslik ." (mamkod,mamad,uretmiktar,tarih,depokod) values('$mamkod','$stokadi',$uretmiktar,'$tarih','$depo')");
    $sonuc = $dba->insert_id($sql);
    return $sonuc;
    }
    
    
    public function UretimDetayEkle($uretimid,$hamkod,$hammiktar){
    $dba = new dbClass();
    $dba->connect();
     $entegrasyon = new Entegrasyon();
    $dent = $entegrasyon->entNetsisUrunGetir($hamkod);
    $stokadi =$dent['STOK_ADI'];
    //echo "insert into ".$this->tabloAdDetay ." (baslikid,hamkod,hamad,tuketmiktar) values('$uretimid','$hamkod','$stokadi','$hammiktar')";
    $sql = $dba->query("insert into ".$this->tabloAdDetay ." (baslikid,hamkod,hamad,tuketmiktar) values('$uretimid','$hamkod','$stokadi','$hammiktar')");
    $sonuc = $dba->insert_id($sql);
    return $sonuc;
    }
    
   Public function UretimDetaySil($uretimdetayid){
    $dba = new dbClass();
    $dba->connect();
    $uretim = new Uretim();
    $sql = $dba->query("delete from ".$this->tabloAdDetay ." where  id=$uretimdetayid");
    $sonuc=1;
    return $sonuc;
   }

   public function UretimSil($uretimid){
    $dba = new dbClass();
    $dba->connect();
    $uretim = new Uretim();
    $sql = $dba->query("delete from ".$this->tabloAdBaslik ." where id =$uretimid");
    $sql =$dba->query("select id from ".$this->tabloAdDetay ." where baslikid =$uretimid");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    foreach(@$r as $s){
      $uretim->UretimDetaySil($s->id);
    }
    $sonuc=1;
    return $sonuc;
    }
}

?>