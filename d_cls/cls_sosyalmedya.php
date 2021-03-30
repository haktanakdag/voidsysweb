<?php
class SosyalMedya{
private $kayitid;
private $kayitad;

    var $tabloAd="sosyalmedyakayitlari";

    public function KayitSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    
    public function KayitGetir($kayitid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." where id =$kayitid";
    $sql = $dba->query("select * from ".$this->tabloAd ." where id =$kayitid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }

    public function KayitlariGetir($pagerWhere ="",$aramaString=""){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere";
    $sql = $dba->query("select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    public function KayitlariGetirAnasayfayaGore(){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." where anasayfadagoster=1 order by id desc";
    $sql = $dba->query("select * from ".$this->tabloAd ." where anasayfadagoster=1 order by id desc");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    
    public function KayitlariGetirAnahtaraGore($anahtarid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." where anahtarlar like '%|$anahtarid|%' order by id desc";
    //echo "select * from ".$this->tabloAd ." where anahtarlar like '%|$anahtarid|%' order by id desc";
    $sql = $dba->query("select * from ".$this->tabloAd ." where anahtarlar like '%|$anahtarid|%' order by id desc");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }

    public function KayitEkle($kayitad,$kayitdetay,$kayitbaglanti,$anahtarlar){
    $dba = new dbClass();
    $dba->connect();
    $kayitbaglanti=str_replace("'"," ",$kayitbaglanti);
    $anasayfadurum = strpos($anahtarlar,'anasayfadagoster');
    if($anasayfadurum==1){
        $anahtarlarexp=  explode('anasayfadagoster', $anahtarlar);
        $anahtarlar = $anahtarlarexp[1];
        $anasayfadagoster=1;
    }else{
        $anasayfadagoster=0;
    }
    $cl = new Kayit();
    if($cl->KayitVarmi($kayitad,0)==true){
      $sonuc = "zatenvar";
    }else{
        //echo "insert into ".$this->tabloAd ." (kayitad,kayitdetay,kayitbaglanti,anahtarlar,anasayfadagoster) values('$kayitad','$kayitdetay','$kayitbaglanti','$anahtarlar',$anasayfadagoster)";
        $sql = $dba->query("insert into ".$this->tabloAd ." (kayitad,kayitdetay,kayitbaglanti,anahtarlar,anasayfadagoster) values('$kayitad','$kayitdetay','$kayitbaglanti','$anahtarlar',$anasayfadagoster)");
        $sonuc = $dba->insert_id($sql);
    }
    return $sonuc;
    }
    
    public Function KayitDuzenle($kayitid,$kayitad,$kayitdetay,$kayitbaglanti,$anahtarlar){
        $dba = new dbClass();
        $dba->connect();
         $kayitbaglanti=str_replace("'"," ",$kayitbaglanti);
        $anasayfadurum = strpos($anahtarlar,'anasayfadagoster');
        if($anasayfadurum==1){
        $anahtarlarexp=  explode('anasayfadagoster', $anahtarlar);
        $anahtarlar = $anahtarlarexp[1];
        $anasayfadagoster=1;
        }else{
            $anasayfadagoster=0;
        }
        $cl = new Kayit();
        if($cl->KayitVarmi($kayitad,$kayitid)==true){
           $sonuc="zatenvar";
        }else{
            //echo"update $this->tabloAd set kayitad ='$kayitad',kayitdetay='$kayitdetay', kayitbaglanti='$kayitbaglanti', anahtarlar ='$anahtarlar', anasayfadagoster=$anasayfadagoster where id =$kayitid";
            
            $sql=$dba->query("update $this->tabloAd set kayitad ='$kayitad',kayitdetay='$kayitdetay',kayitbaglanti='$kayitbaglanti', anahtarlar ='$anahtarlar', anasayfadagoster=$anasayfadagoster where id =$kayitid");
            $dba->affected_rows($sql);
            $sonuc =true;
        }
        return $sonuc;
    }

    public function KayitVarmi($kayitad,$kayitid)
    {
        $dba = new dbClass();
        $dba->connect();
        //echo "select count(id) sayi from ".$this->tabloAd ." where kayitad='$kayitad' and id <> $kayitid";
        $sql = $dba->query("select count(id) sayi from ".$this->tabloAd ." where kayitad='$kayitad' and id <> $kayitid");
        $sonuc =$dba->fetch_object($sql);
        if($sonuc->sayi=="0"){
            return false;
        }else{
            return true;
        }
    }

    public function KayitSil($kayitid){
    $dba = new dbClass();
    $dba->connect();
    //$birimcls= new Birim();
    $sql = $dba->query("delete from ".$this->tabloAd ." where id =$kayitid");
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