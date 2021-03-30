<?php
class Adisyon{
private $adisyonid;
private $masaid;
Private $aciklapali;

    var $tabloAdBaslik="adisyonbaslik";
    var $tabloAdDetay="adisyondetay";

    public function AdisyonBaslikSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAdBaslik);
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    
    public function AktifAdisyonBaslikSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAdBaslik ." where acikkapali=1");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    
    public function AdisyonBaslikGetir($adisyonid){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAdBaslik ."
    where id =$adisyonid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    
    public function AdisyonToplamGetir($adisyonid){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select baslikid,sum(satmiktar) satmiktar, sum(sattutar) sattutar, sum(odmiktar) odmiktar, sum(odtutar) odtutar from ".$this->tabloAdDetay ." where baslikid =$adisyonid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    
    public function AdisyonGetirMasayaGore($masaid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAdBaslik ." where masaid =$masaid and acikkapali=1";
    $sql = $dba->query("select * from ".$this->tabloAdBaslik ."
    where masaid =$masaid and acikkapali=1");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    
    public function AdisyonGetirKuryeyeGore($kuryeid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAdBaslik ." where masaid =$masaid and acikkapali=1";
    $sql = $dba->query("select * from ".$this->tabloAdBaslik ."
    where kuryeid =$kuryeid and acikkapali=1");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    
    public function AdisyonDetaylariGetir($adisyonid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select id,cevap,case when dogru=1 then 'Dogru' else 'Yanlıs' end as DY from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere";
    //echo "select * from ".$this->tabloAdDetay ." where baslikid=$adisyonid order by id desc";
    $sql = $dba->query("select * from ".$this->tabloAdDetay ." where baslikid=$adisyonid order by id desc");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    public function AdisyonlariGetir($pagerWhere ="",$aramaString=""){
    $dba = new dbClass();
    $dba->connect();
    //echo "select id,cevap,case when dogru=1 then 'Dogru' else 'Yanlıs' end as DY from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere";
    $sql = $dba->query("select * from ".$this->tabloAd ." $aramaString order by id desc $pagerWhere");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    public function PaketAdisyonEkle($kuryeid){
    $dba = new dbClass();
    $dba->connect();
    $bastarihsaat = date("Y-m-d H:i:s");
    echo "insert into ".$this->tabloAdBaslik ." (kuryeid,bastarihsaat,bittarihsaat,toplamtutar,acikkapali) values($kuryeid,'$bastarihsaat','',0,1)";
    $sql = $dba->query("insert into ".$this->tabloAdBaslik ." (kuryeid,bastarihsaat,bittarihsaat,toplamtutar,acikkapali) values($kuryeid,'$bastarihsaat','',0,1)");
    $sonuc = $dba->insert_id($sql);
    return $sonuc;
    }

    public function AdisyonEkle($masaid){
    $dba = new dbClass();
    $dba->connect();
    $bastarihsaat = date("Y-m-d H:i:s");
    //echo "insert into ".$this->tabloAdBaslik ." (masaid,bastarihsaat,bittarihsaat,toplamtutar,acikkapali) values($masaid,'$bastarihsaat','',0,1)";
    $sql = $dba->query("insert into ".$this->tabloAdBaslik ." (masaid,bastarihsaat,bittarihsaat,toplamtutar,acikkapali) values($masaid,'$bastarihsaat','',0,1)");
    $sonuc = $dba->insert_id($sql);
    return $sonuc;
    }
    
    public function AdisyonDetayEkle($adisyonid,$urunid){
    $dba = new dbClass();
    $dba->connect();
    $bastarihsaat = date("Y-m-d H:i:s");
    $fiyatlar = new Fiyat();
    $dfiyat = $fiyatlar->FiyatGetirUruneGore($urunid);
    if(!$dfiyat){
        @$dfiyat->satisfiyat=0;
    }
    
    //echo "select coalesce(id,0) id from ".$this->tabloAdDetay ." where baslikid =$adisyonid and urunid=$urunid";
    $sql=$dba->query("select coalesce(id,0) id from ".$this->tabloAdDetay ." where baslikid =$adisyonid and urunid=$urunid");
    $sonuc = $dba->fetch_object($sql);
    if($sonuc->id==0){
       //echo "insert into ".$this->tabloAdDetay ." (baslikid,urunid,satmiktar,sattutar,odmiktar,odtutar,islemtarihsaat) values($adisyonid,$urunid,1,$dfiyat->satisfiyat,0,0,'$bastarihsaat')";
       $sql=$dba->query("insert into ".$this->tabloAdDetay ." (baslikid,urunid,satmiktar,sattutar,odmiktar,odtutar,islemtarihsaat) values($adisyonid,$urunid,1,$dfiyat->satisfiyat,0,0,'$bastarihsaat')");
       $sonuc = $dba->insert_id($sql);
    }else{
        //echo "update ".$this->tabloAdDetay ." set satmiktar=satmiktar+1, sattutar=sattutar+$dfiyat->satisfiyat,islemtarihsaat =$bastarihsaat where baslikid=$adisyonid and urunid=$urunid and id=$sonuc->id";
        $sql=$dba->query("update ".$this->tabloAdDetay ." set satmiktar=satmiktar+1, sattutar=sattutar+$dfiyat->satisfiyat,islemtarihsaat ='$bastarihsaat' where baslikid=$adisyonid and urunid=$urunid and id=$sonuc->id");
        $sonuc =$dba->affected_rows($sql);
    }
    return $sonuc;
    }
    
    public function AdisyonAktar($adisyonid1,$adisyonid2){
    $dba = new dbClass();
    $dba->connect();
    $bastarihsaat = date("Y-m-d H:i:s");
    $adisyon = new Adisyon();
    $adisyonekle = $adisyon->AdisyonEkle(999);
    if($adisyonid2){
    $q ="insert into adisyondetay(baslikid,urunid,satmiktar,sattutar,odmiktar,odtutar,islemtarihsaat)"
        ." select $adisyonekle,urunid,sum(satmiktar) satmiktar,sum(sattutar) sattutar,sum(odmiktar) odmiktar, sum(odtutar) odtutar, '$bastarihsaat' from(" 
        ." select $adisyonekle ,urunid,satmiktar,sattutar,odmiktar,odtutar from adisyondetay where baslikid =$adisyonid1"
        ." union all"
        ." select $adisyonekle ,urunid,satmiktar,sattutar,odmiktar,odtutar from adisyondetay where baslikid =$adisyonid2"
        ." ) X GROUP BY urunid";
    }else{
         $q ="insert into adisyondetay(baslikid,urunid,satmiktar,sattutar,odmiktar,odtutar,islemtarihsaat)"
        ." select $adisyonekle,urunid,sum(satmiktar) satmiktar,sum(sattutar) sattutar,sum(odmiktar) odmiktar, sum(odtutar) odtutar, '$bastarihsaat' from(" 
        ." select $adisyonekle ,urunid,satmiktar,sattutar,odmiktar,odtutar from adisyondetay where baslikid =$adisyonid1"
        ." union all"
        ." select $adisyonekle ,urunid,satmiktar,sattutar,odmiktar,odtutar from adisyondetay where baslikid =0"
        ." ) X GROUP BY urunid";
    }
    //ECHO $q;
    $sql= $dba->query($q);
    $sonuc =$dba->affected_rows($sql);
    $sonuc =$adisyonekle;
    return $sonuc;
    }
    
    public function AdisyonMasaNoGuncelle($masano,$adisyonid){
    $dba = new dbClass();
    $dba->connect();
    //ECHO "update ".$this->tabloAdBaslik ." set masaid=$masano where id =$adisyonid";
    $sql = $dba->query("update ".$this->tabloAdBaslik ." set masaid=$masano where id =$adisyonid");
    $sonuc=1;
    return $sonuc;
    }
    
    public function AdisyonIptal($adisyonid){
    $dba = new dbClass();
    $dba->connect();
    $adisyon = new Adisyon();
    $adisyondetaylar = $adisyon->AdisyonDetaylariGetir($adisyonid);
    if($adisyondetaylar)
    foreach($adisyondetaylar as $ad){
        $adisyon->AdisyonDetayIptal($ad->id);
    }
    $sql = $dba->query("delete from ".$this->tabloAdBaslik ." where id =$adisyonid");
    $sonuc=1;
    return $sonuc;
    }
    
    public function AdisyonKapat($adisyonid){
        $dba = new dbClass();
        $dba->connect();
        $bittarihsaat=date("Y-m-d H:i:s");
        $adisyon = new Adisyon();
        $adisyondetaytoplam= $adisyon->AdisyonDetayToplam($adisyonid);
        $adisyondetaylar = $adisyon->AdisyonDetaylariGetir($adisyonid);
        foreach($adisyondetaylar as $ad){
            //echo "update ".$this->tabloAdDetay ." set odmiktar=satmiktar, odtutar=sattutar where id=$ad->id";
           $sql = $dba->query("update ".$this->tabloAdDetay ." set odmiktar=satmiktar, odtutar=sattutar where id=$ad->id"); 
        }
        
        $sql = $dba->query("update ".$this->tabloAdBaslik ." set acikkapali =0, toplamtutar=$adisyondetaytoplam->ToplamTutar , bittarihsaat='$bittarihsaat' where id =$adisyonid");
        $sonuc=1;
        return $sonuc;
    }
    
    public function AdisyonDuzenle($adisyonid,$masaid){
        $dba = new dbClass();
        $dba->connect();
        $bittarihsaat=date("Y-m-d H:i:s");
        $adisyon = new Adisyon();
        //echo "update ".$this->tabloAdBaslik ." set acikkapali =1 , masaid=$masaid where id =$adisyonid";
        $sql = $dba->query("update ".$this->tabloAdBaslik ." set acikkapali =1 , masaid=$masaid where id =$adisyonid");
        $sonuc=1;
        return $sonuc;
    }
    
      public function PaketAdisyonDuzenle($adisyonid,$kuryeid){
        $dba = new dbClass();
        $dba->connect();
        $bittarihsaat=date("Y-m-d H:i:s");
        $adisyon = new Adisyon();
        //echo "update ".$this->tabloAdBaslik ." set acikkapali =1 , masaid=$masaid where id =$adisyonid";
        $sql = $dba->query("update ".$this->tabloAdBaslik ." set acikkapali =1 , kuryeid=$kuryeid where id =$adisyonid");
        $sonuc=1;
        return $sonuc;
    }
    
    
    public function AdisyonDetayIptal($adisyondetayid){
        $dba = new dbClass();
        $dba->connect();
        $sql = $dba->query("delete from ".$this->tabloAdDetay ." where id =$adisyondetayid");
        $sonuc=1;
        return $sonuc;
    }
    
    public function AdisyonAcikKapaliKontrol($adisyonid){
        $dba = new dbClass();
        $dba->connect();
        $sql = $dba->query("select acikkapali from ".$this->tabloAdBaslik." where id=$adisyonid");
        return $sonuc->acikkapali;
    }
    
    public function AdisyonDetayMiktarArttir($adisyondetayid){
        $dba = new dbClass();
        $dba->connect();
        $sql=$dba->query("select urunid from ".$this->tabloAdDetay." where id=$adisyondetayid");
        $sonuc = $dba->fetch_object($sql);
        $fiyatlar = new Fiyat();
        $satfiyat = $fiyatlar->FiyatGetirUruneGore($sonuc->urunid);
        //echo "update ".$this->tabloAdDetay ." set satmiktar=satmiktar+1, sattutar=sattutar+$satfiyat->satisfiyat where id =$adisyondetayid";
        $sql = $dba->query("update ".$this->tabloAdDetay ." set satmiktar=satmiktar+1, sattutar=sattutar+$satfiyat->satisfiyat where id =$adisyondetayid");
        $sonuc=1;
        return $sonuc;
    }
    
    public function AdisyonDetayMiktarAzalt($adisyondetayid){
        $dba = new dbClass();
        $dba->connect();
        $sql=$dba->query("select urunid from ".$this->tabloAdDetay." where id=$adisyondetayid");
        $sonuc = $dba->fetch_object($sql);
        $fiyatlar = new Fiyat();
        $satfiyat = $fiyatlar->FiyatGetirUruneGore($sonuc->urunid);
        $sql = $dba->query("update ".$this->tabloAdDetay ." set satmiktar=satmiktar-1, sattutar=sattutar-$satfiyat->satisfiyat where id =$adisyondetayid");
        $sonuc=1;
        return $sonuc;
    }
    
    public function AdisyonDetayOdemeArttir($adisyondetayid){
        $dba = new dbClass();
        $dba->connect();
        $sql=$dba->query("select urunid from ".$this->tabloAdDetay." where id=$adisyondetayid");
        $sonuc = $dba->fetch_object($sql);
        $fiyatlar = new Fiyat();
        $satfiyat = $fiyatlar->FiyatGetirUruneGore($sonuc->urunid);
        $sql = $dba->query("update ".$this->tabloAdDetay ." set odmiktar=odmiktar+1, odtutar=odtutar+$satfiyat->satisfiyat where id =$adisyondetayid");
        $sonuc=1;
        return $sonuc;
    }
    
   public function AdisyonDetayOdemeAzalt($adisyondetayid){
        $dba = new dbClass();
        $dba->connect();
        $sql=$dba->query("select urunid from ".$this->tabloAdDetay." where id=$adisyondetayid");
        $sonuc = $dba->fetch_object($sql);
        $fiyatlar = new Fiyat();
        $satfiyat = $fiyatlar->FiyatGetirUruneGore($sonuc->urunid);
        $sql = $dba->query("update ".$this->tabloAdDetay ." set odmiktar=odmiktar-1, odtutar=odtutar-$satfiyat->satisfiyat where id =$adisyondetayid");
        $sonuc=1;
        return $sonuc;
    }
    
    public function AdisyonDetayToplam($adisyonid)
    {
        $dba = new dbClass();
        $dba->connect();
        $sql = $dba->query("select coalesce(sum(sattutar),0) ToplamTutar from ".$this->tabloAdDetay ." where baslikid=$adisyonid");
        $sonuc =$dba->fetch_object($sql);
        return $sonuc;
    }
}

?>