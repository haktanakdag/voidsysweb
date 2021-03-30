<?php
class Kurye{
private $kuryeid;
private $kuryead;

    var $tabloAd="kuryeler";

    public function KuryeSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    public function KuryeGetir($kuryeid){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAd ."
    where id =$kuryeid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }

    public function KuryeAcikKapaliKontrol($kuryeid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select acikkapali from vw_adisyon_kurye_acik where kuryeid =$kuryeid";
    $sql = $dba->query("select acikkapali from vw_adisyon_kurye_acik where kuryeid =$kuryeid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    
    public function KuryeleriGetir($pagerWhere ="",$aramaString=""){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere";
    $sql = $dba->query("select * from ".$this->tabloAd ." $aramaString  order by id desc $pagerWhere");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    

    public function AcikOlmayanKuryeleriGetir(){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere";
    //echo "select * from ".$this->tabloAd ." where id not in(select kuryeid from adisyonbaslik where acikkapali=1)";
    $sql = $dba->query("select * from ".$this->tabloAd ." where id not in(select kuryeid from adisyonbaslik where acikkapali=1)");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    public function KuryeEkle($kuryead){
    $dba = new dbClass();
    $dba->connect();
    $cl = new Kurye();
    if($cl->KuryeVarmi($kuryead,0)==true){
      $sonuc = "zatenvar";
    }else{
        $sql = $dba->query("insert into ".$this->tabloAd ." (kuryead) values('$kuryead')");
        $sonuc = $dba->insert_id($sql);
         }
    return $sonuc;
    }
    
    
    
    public Function KuryeDuzenle($kuryead,$kuryeid){
        $dba = new dbClass();
        $dba->connect();
        $cl = new Kurye();
        if($cl->KuryeVarmi($kuryead,$kuryeid)==true){
           $sonuc="zatenvar";
        }else{
             $sql=$dba->query("update $this->tabloAd set kuryead ='$kuryead' where id =$kuryeid");
            $sonuc =$dba->affected_rows($sql);
        }
        return $sonuc;
    }

    public function KuryeVarmi($kuryead,$kuryeid)
    {
        $dba = new dbClass();
        $dba->connect();
        $sql = $dba->query("select count(id) sayi from ".$this->tabloAd ." where kuryead='$kuryead' and id <> $kuryeid");
        $sonuc =$dba->fetch_object($sql);
       if($sonuc->sayi=="0"){
            return false;
        }else{
            return true;
        }
    }
    
    public function KuryeDegistir($degistirilenkuryeid,$degistirilecekkuryeid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select id from adisyonbaslik where kuryeid =$degistirilenkuryeid and acikkapali=1";
    $sql = $dba->query("select id from adisyonbaslik where kuryeid =$degistirilenkuryeid and acikkapali=1");
    $degisenadisyonno = $dba->fetch_object($sql);
    $sql = $dba->query("select id from adisyonbaslik where kuryeid =$degistirilecekkuryeid and acikkapali=1");
    $degistirilenadisyonno = $dba->fetch_object($sql);
        if (@$degistirilenadisyonno->id and $degistirilenadisyonno->id ){
            //echo "update adisyonbaslik set kuryeid=$degistirilecekkuryeid where id=$degisenadisyonno->id";
            $degisim = $dba->query("update adisyonbaslik set kuryeid=$degistirilecekkuryeid where id=$degisenadisyonno->id");
            $degisim = $dba->query("update adisyonbaslik set kuryeid=$degistirilenkuryeid where id=$degistirilenadisyonno->id");
            $sonuc="İşlem Başarılı.";
        }  else {
            $sonuc="Değiştirmeye çalıştığınız kuryelerdan herhangi biri kapalı.";
        }
     return $sonuc;
    }
    
    public function KuryeAktar($aktarilankurye,$aktarilacakkurye){
    $dba = new dbClass();
    $dba->connect();
    //echo "select id from adisyonbaslik where kuryeid =$degistirilenkuryeid and acikkapali=1";
    //echo "select id from adisyonbaslik where kuryeid =$aktarilankurye and acikkapali=1";
    $sql = $dba->query("select id from adisyonbaslik where kuryeid =$aktarilankurye and acikkapali=1");
    $aktarilanadisyon= $dba->fetch_object($sql);
    //echo "select id from adisyonbaslik where kuryeid =$aktarilacakkurye and acikkapali=1";
    $sql = $dba->query("select id from adisyonbaslik where kuryeid =$aktarilacakkurye and acikkapali=1");
    $aktarilacakadisyon = $dba->fetch_object($sql);
    if($aktarilanadisyon){
    $adisyon = new Adisyon();
    $aktarildi =$adisyon->AdisyonAktar($aktarilanadisyon->id,$aktarilacakadisyon->id);
    $sonuc= $adisyon->AdisyonKuryeNoGuncelle($aktarilacakkurye,$aktarildi);
    $adisyon->AdisyonIptal($aktarilanadisyon->id);
    $adisyon->AdisyonIptal($aktarilacakadisyon->id);
    $sonuc="İşlem Başarılı.";
    }
    else {
        $sonuc = "Aktarmaya Çalıştığınız Adisyon Kapalı";
    }
    return $sonuc;
    }

    public function KuryeSil($kuryeid){
    $dba = new dbClass();
    $dba->connect();
    $konucls = new Kurye();
    $sql = $dba->query("delete from ".$this->tabloAd ." where id =$kuryeid");
    $sql =$dba->query("select id from kuryeler where kuryeid =$kuryeid");
    $sonuc=1;
    return $sonuc;
    }
}

?>