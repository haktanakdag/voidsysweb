<?php
class Masa{
private $masaid;
private $masaad;

    var $tabloAd="masalar";

    public function MasaSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    public function MasaGetir($masaid){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAd ."
    where id =$masaid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }

    public function MasaAcikKapaliKontrol($masaid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select acikkapali from vw_adisyon_masa_acik where masaid =$masaid";
    $sql = $dba->query("select acikkapali from vw_adisyon_masa_acik where masaid =$masaid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    
    public function MasalariGetir($pagerWhere ="",$aramaString=""){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere";
    $sql = $dba->query("select * from ".$this->tabloAd ." $aramaString  order by id desc $pagerWhere");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }

    public function AcikOlmayanMasalariGetir(){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere";
    //echo "select * from ".$this->tabloAd ." where id not in(select masaid from adisyonbaslik where acikkapali=1)";
    $sql = $dba->query("select * from ".$this->tabloAd ." where id not in(select masaid from adisyonbaslik where acikkapali=1)");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    public function MasaEkle($masaad){
    $dba = new dbClass();
    $dba->connect();
    $cl = new Masa();
    if($cl->MasaVarmi($masaad,0)==true){
      $sonuc = "zatenvar";
    }else{
        $sql = $dba->query("insert into ".$this->tabloAd ." (masaad) values('$masaad')");
        $sonuc = $dba->insert_id($sql);
         }
    return $sonuc;
    }
    
    
    
    public Function MasaDuzenle($masaad,$masaid){
        $dba = new dbClass();
        $dba->connect();
        $cl = new Masa();
        if($cl->MasaVarmi($masaad,$masaid)==true){
           $sonuc="zatenvar";
        }else{
             $sql=$dba->query("update $this->tabloAd set masaad ='$masaad' where id =$masaid");
            $sonuc =$dba->affected_rows($sql);
        }
        return $sonuc;
    }

    public function MasaVarmi($masaad,$masaid)
    {
        $dba = new dbClass();
        $dba->connect();
        $sql = $dba->query("select count(id) sayi from ".$this->tabloAd ." where masaad='$masaad' and id <> $masaid");
        $sonuc =$dba->fetch_object($sql);
       if($sonuc->sayi=="0"){
            return false;
        }else{
            return true;
        }
    }
    
    public function MasaDegistir($degistirilenmasaid,$degistirilecekmasaid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select id from adisyonbaslik where masaid =$degistirilenmasaid and acikkapali=1";
    $sql = $dba->query("select id from adisyonbaslik where masaid =$degistirilenmasaid and acikkapali=1");
    $degisenadisyonno = $dba->fetch_object($sql);
    $sql = $dba->query("select id from adisyonbaslik where masaid =$degistirilecekmasaid and acikkapali=1");
    $degistirilenadisyonno = $dba->fetch_object($sql);
        if (@$degistirilenadisyonno->id and $degistirilenadisyonno->id ){
            //echo "update adisyonbaslik set masaid=$degistirilecekmasaid where id=$degisenadisyonno->id";
            $degisim = $dba->query("update adisyonbaslik set masaid=$degistirilecekmasaid where id=$degisenadisyonno->id");
            $degisim = $dba->query("update adisyonbaslik set masaid=$degistirilenmasaid where id=$degistirilenadisyonno->id");
            $sonuc="İşlem Başarılı.";
        }  else {
            $sonuc="Değiştirmeye çalıştığınız masalardan herhangi biri kapalı.";
        }
     return $sonuc;
    }
    
    public function MasaAktar($aktarilanmasa,$aktarilacakmasa){
    $dba = new dbClass();
    $dba->connect();
    //echo "select id from adisyonbaslik where masaid =$degistirilenmasaid and acikkapali=1";
    //echo "select id from adisyonbaslik where masaid =$aktarilanmasa and acikkapali=1";
    $sql = $dba->query("select id from adisyonbaslik where masaid =$aktarilanmasa and acikkapali=1");
    $aktarilanadisyon= $dba->fetch_object($sql);
    //echo "select id from adisyonbaslik where masaid =$aktarilacakmasa and acikkapali=1";
    $sql = $dba->query("select id from adisyonbaslik where masaid =$aktarilacakmasa and acikkapali=1");
    $aktarilacakadisyon = $dba->fetch_object($sql);
    if($aktarilanadisyon){
    $adisyon = new Adisyon();
    $aktarildi =$adisyon->AdisyonAktar($aktarilanadisyon->id,$aktarilacakadisyon->id);
    $sonuc= $adisyon->AdisyonMasaNoGuncelle($aktarilacakmasa,$aktarildi);
    $adisyon->AdisyonIptal($aktarilanadisyon->id);
    $adisyon->AdisyonIptal($aktarilacakadisyon->id);
    $sonuc="İşlem Başarılı.";
    }
    else {
        $sonuc = "Aktarmaya Çalıştığınız Adisyon Kapalı";
    }
    return $sonuc;
    }

    public function MasaSil($masaid){
    $dba = new dbClass();
    $dba->connect();
    $konucls = new Masa();
    $sql = $dba->query("delete from ".$this->tabloAd ." where id =$masaid");
    $sql =$dba->query("select id from masalar where masaid =$masaid");
    $sonuc=1;
    return $sonuc;
    }
}

?>