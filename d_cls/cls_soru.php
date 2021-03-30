<?php
class Soru{
private $soruid;
private $aciklama;
Private $quizid;

    var $tabloAd="sorular";

    public function SoruSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    public function SoruGetir($soruid){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAd ."
    where id =$soruid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }

    public function SorulariGetir($pagerWhere ="",$aramaString=""){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }

    public function SorulariGetirQuizeGore($quizid){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAd ." where quizid=$quizid");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    public function SoruEkle($aciklama,$quizid){
    $dba = new dbClass();
    $dba->connect();
    $cl = new Soru();
    if($cl->SoruVarmi($aciklama,0)){
      $sonuc = "zatenvar";
    }else{
        //echo "insert into ".$this->tabloAd ." (soru,quizid) values('$aciklama',$quizid)";
        $sql = $dba->query("insert into ".$this->tabloAd ." (soru,quizid) values('$aciklama',$quizid)");
        $sonuc = $dba->insert_id($sql);
         }
    return $sonuc;
    }
    
    public Function SoruDuzenle($aciklama,$quizid,$soruid){
        $dba = new dbClass();
        $dba->connect();
        $cl = new Soru();
        if($cl->SoruVarmi($aciklama,$soruid)==true){
           $sonuc="zatenvar";
        }else{
             $sql=$dba->query("update $this->tabloAd set soru ='$aciklama', quizid='$quizid' where id =$soruid");
            $sonuc =$dba->affected_rows($sql);
        }
        return $sonuc;
    }

    public function SoruVarmi($aciklama,$soruid)
    {
        $dba = new dbClass();
        $dba->connect();
        $sql = $dba->query("select count(id) sayi from ".$this->tabloAd ." where soru='$aciklama' and id <> $soruid");
        $sonuc =$dba->fetch_object($sql);
        if($sonuc->sayi>0){
            return true;
        }else{
            return false;
        }
    }

    public function SoruSil($soruid){
    $dba = new dbClass();
    $dba->connect();
    $cevapcls = new Cevap();
    $sql = $dba->query("delete from ".$this->tabloAd ." where id =$soruid");
    $sql =$dba->query("select id from cevaplar where soruid =$soruid");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    foreach(@$r as $s){
       $cevapcls->CevapSil($s->id);
    }
    $sonuc=1;
    return $sonuc;
    }
}

?>