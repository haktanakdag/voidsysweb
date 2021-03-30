<?php
class Yazi{
private $yaziid;
private $yaziad;

    var $tabloAd="yazilar";

    public function YaziSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    public function YaziGetir($yaziid){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAd ."
    where id =$yaziid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }

    public function YazilariGetir($pagerWhere ="",$aramaString=""){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere";
    $sql = $dba->query("select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    public function YazilariGetirAnasayfayaGore(){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAd ." where anasayfadagoster=1 order by id desc");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    
    public function YazilariGetirAnahtaraGore($anahtarid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." where anahtarlar like '%|$anahtarid|%' order by id desc";
    $sql = $dba->query("select * from ".$this->tabloAd ." where anahtarlar like '%|$anahtarid|%' order by id desc");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }

    public function YaziEkle($yaziad,$yazidetay,$anahtarlar){
    $dba = new dbClass();
    $dba->connect();
    $anasayfadurum = strpos($anahtarlar,'anasayfadagoster');
    if($anasayfadurum==1){
        $anahtarlarexp=  explode('anasayfadagoster', $anahtarlar);
        $anahtarlar = $anahtarlarexp[1];
        $anasayfadagoster=1;
    }else{
        $anasayfadagoster=0;
    }
    $cl = new Yazi();
    if($cl->YaziVarmi($yaziad,0)==true){
      $sonuc = "zatenvar";
    }else{
        //echo "insert into ".$this->tabloAd ." (yaziad,yazidetay,anahtarlar,anasayfadagoster) values('$yaziad','$yazidetay','$anahtarlar',$anasayfadagoster)";
        $sql = $dba->query("insert into ".$this->tabloAd ." (yaziad,yazidetay,anahtarlar,anasayfadagoster) values('$yaziad','$yazidetay','$anahtarlar',$anasayfadagoster)");
        $sonuc = $dba->insert_id($sql);
         }
    return $sonuc;
    }
    
    public Function YaziDuzenle($yaziid,$yaziad,$yazidetay,$anahtarlar){
        $dba = new dbClass();
        $dba->connect();
        $anasayfadurum = strpos($anahtarlar,'anasayfadagoster');
        if($anasayfadurum==1){
        $anahtarlarexp=  explode('anasayfadagoster', $anahtarlar);
        $anahtarlar = $anahtarlarexp[1];
        $anasayfadagoster=1;
        }else{
            $anasayfadagoster=0;
        }
        $cl = new Yazi();
        if($cl->YaziVarmi($yaziad,$yaziid)==true){
           $sonuc="zatenvar";
        }else{
            //echo "update $this->tabloAd set yaziad ='$yaziad',yazidetay='$yazidetay', anahtarlar ='$anahtarlar', anasayfadagoster=$anasayfadagoster where id =$yaziid";
            $sql=$dba->query("update $this->tabloAd set yaziad ='$yaziad',yazidetay='$yazidetay', anahtarlar ='$anahtarlar', anasayfadagoster=$anasayfadagoster where id =$yaziid");
            $sonuc =$dba->affected_rows($sql);
        }
        return $sonuc;
    }

    public function YaziVarmi($yaziad,$yaziid)
    {
        $dba = new dbClass();
        $dba->connect();
        //echo "select count(id) sayi from ".$this->tabloAd ." where yaziad='$yaziad' and id <> $yaziid";
        $sql = $dba->query("select count(id) sayi from ".$this->tabloAd ." where yaziad='$yaziad' and id <> $yaziid");
        $sonuc =$dba->fetch_object($sql);
        if($sonuc->sayi>0){
            
            return true;
        }else{
            return false;
        }
    }

    public function YaziSil($yaziid){
    $dba = new dbClass();
    $dba->connect();
    //$birimcls= new Birim();
    $sql = $dba->query("delete from ".$this->tabloAd ." where id =$yaziid");
    $sql =$dba->query("select id from quiz where yaziid =$yaziid");
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