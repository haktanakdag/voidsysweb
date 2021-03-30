<?php
class Sube{
private $subeid;
private $subead;

    var $tabloAd="subeler";

    public function SubeSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    public function SubeGetir($subeid){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAd ."
    where id =$subeid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }

    public function SubeleriGetir($pagerWhere ="",$aramaString=""){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere";
    $sql = $dba->query("select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    public function SubeleriGetirAnasayfayaGore(){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAd ." where anasayfadagoster=1 order by id desc");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    public function SubeleriGetirAnahtaraGore($anahtarid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." where anahtarlar like '%|$anahtarid|%' order by id desc";
    $sql = $dba->query("select * from ".$this->tabloAd ." where anahtarlar like '%|$anahtarid|%' order by id desc");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }

    public function SubeEkle($subead,$subedetay){
    $dba = new dbClass();
    $dba->connect();
    $cl = new Sube();
    if($cl->SubeVarmi($subead,0)==true){
      $sonuc = "zatenvar";
    }else{
        $sql = $dba->query("insert into ".$this->tabloAd ." (subead,subedetay) values('$subead','$subedetay')");
        $sonuc = $dba->insert_id($sql);
         }
    return $sonuc;
    }
    
    public Function SubeDuzenle($subeid,$subead,$subedetay){
        $dba = new dbClass();
        $dba->connect();
        $anasayfadurum = strpos($anahtarlar,'anasayfadagoster');
     
        $cl = new Sube();
        if($cl->SubeVarmi($subead,$subeid)==true){
           $sonuc="zatenvar";
        }else{
            $sql=$dba->query("update $this->tabloAd set subead ='$subead',subedetay='$subedetay' where id =$subeid");
            $sonuc =$dba->affected_rows($sql);
        }
        return $sonuc;
    }

    public function SubeVarmi($subead,$subeid)
    {
        $dba = new dbClass();
        $dba->connect();
        $sql = $dba->query("select count(id) sayi from ".$this->tabloAd ." where subead='$subead' and id <> $subeid");
        $sonuc =$dba->fetch_object($sql);
        if($sonuc->sayi>0){
            return true;
        }else{
            return false;
        }
    }

    public function SubeSil($subeid){
    $dba = new dbClass();
    $dba->connect();
    //$birimcls= new Birim();
    $sql = $dba->query("delete from ".$this->tabloAd ." where id =$subeid");
    $sonuc=1;
    return $sonuc;
    }
}

?>