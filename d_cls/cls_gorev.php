<?php
class Gorev{
private $gorevid;
private $gorevad;

    var $tabloAd="gorevler";
    var $tabloAdGorevBaslik="gorevbaslik";
    var $tabloAdGorevDetay="gorevdetay";
    var $viewAdGorevBaslik ="view_gorevbaslik";
    var $viewAdGorevDetay ="view_gorevdetay";
    var $viewAdGorevler ="view_gorevler";

public function GorevBaslikSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAdGorevBaslik);
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    public function GorevDetaySayiBul($gorevbaslikid){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAdGorevDetay." where gorevbaslikid =".$gorevbaslikid);
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    public function GorevBaslikGetir($gorevbaslikid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->viewAdGorevBaslik ." where id =$gorevbaslikid";
    $sql = $dba->query("select * from ".$this->viewAdGorevBaslik ." where id =$gorevbaslikid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }

    public function GorevAra($where){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->viewAdGorevler ."	where $where";
    $sql = $dba->query("select distinct gorevid from ".$this->viewAdGorevler ."	where $where order by gorevid desc");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }

    public function GorevDetayGetir($gorevbaslikid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->viewAdGorevDetay ." where gorevbaslikid =$gorevbaslikid";
    $sql = $dba->query("select * from ".$this->viewAdGorevDetay ."
    where gorevbaslikid =$gorevbaslikid");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }

    public function GorevBasliklariGetir($pagerWhere ="",$aramaString=""){
    $dba = new dbClass();
    $dba->connect();
    //echo "<br>";
    echo "select * from ".$this->viewAdGorevBaslik ." $aramaString $pagerWhere";
    $sql = $dba->query("select * from ".$this->viewAdGorevBaslik ." $aramaString $pagerWhere ");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }

    public function GorevBaslikEkle($konu,$kaynakid,$nedenid,$aciliyetid,$durumid,$acankulid,$kapatankulid,$acilistarih,$acilissaat,$kapanistarih,$kapanissaat,$dissistemno1,$dissistemno2,$dissistemno3){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("insert into ".$this->tabloAdGorevBaslik ." (konu,kaynakid,nedenid,aciliyetid,durumid,acankulid,kapatankulid,acilistarih,acilissaat,kapanistarih,kapanissaat,dissistemno1,dissistemno2,dissistemno3) values('$konu','$kaynakid','$nedenid','$aciliyetid','$durumid','$acankulid','$kapatankulid','$acilistarih','$acilissaat','$kapanistarih','$kapanissaat','$dissistemno1','$dissistemno2','$dissistemno3')");
    $sonuc = $dba->insert_id($sql);
    return $sonuc;
    }

    public function GorevBaslikDuzenle($gorevbaslikid,$durumid,$kapatankulid,$kapanistarih,$kapanissaat){
    $dba = new dbClass();
    $dba->connect();
    //echo "update ".$this->tabloAdGorevBaslik ." set durumid='$durumid', kapatankulid='$kapatankulid', kapanistarih='$kapanistarih', kapanissaat='$kapanissaat' where id =$gorevbaslikid";
    $sql = $dba->query("update ".$this->tabloAdGorevBaslik ." set durumid='$durumid', kapatankulid='$kapatankulid', kapanistarih='$kapanistarih', kapanissaat='$kapanissaat' where id =$gorevbaslikid");
    $sonuc=1;
    return $sonuc;
    }

    public function GorevDetayEkle($gorevbaslikid,$islemturid,$detayaciklama,$islemtarih,$islemsaat,$islemyapankulid,$sonkulid,$suresaat){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("insert into ".$this->tabloAdGorevDetay ." (gorevbaslikid,islemturid,detayaciklama,islemtarih,islemsaat,islemyapankulid,sonkulid,suresaat) values('$gorevbaslikid','$islemturid','$detayaciklama','$islemtarih','$islemsaat','$islemyapankulid','$sonkulid','$suresaat')");
    $sonuc = $dba->insert_id($sql);
    return $sonuc;
    }
        
    public function GorevSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    public function GorevGetir($gorevid){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAd ."
    where id =$gorevid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }

    public function GorevleriGetir($pagerWhere ="",$aramaString=""){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from v_list_konular $aramaString order by id desc $pagerWhere";
    $sql = $dba->query("select * from v_list_gorevler ".$aramaString." order by id desc $pagerWhere");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    public function GorevleriGetirDurumaGore(){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." where anasayfadagoster=1 order by id desc";
    $sql = $dba->query("select * from ".$this->tabloAd ." where durum=1 order by id desc");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    
    public function GorevleriGetirAnahtaraGore($anahtarid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." where anahtarlar like '%|$anahtarid|%' order by id desc";
    $sql = $dba->query("select * from ".$this->tabloAd ." where anahtarlar like '%|$anahtarid|%' order by id desc");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }

    public function GorevEkle($gorevad,$gorevdetay,$kullanici,$tamam,$anahtarlar){
    $dba = new dbClass();
    $dba->connect();
    $tamam = strpos($anahtarlar,'tamam');
    $bastarihsaat = date("Y-m-d H:i:s");
    if($tamam==1){
        $anahtarlarexp=  explode('tamam', $anahtarlar);
        $anahtarlar = $anahtarlarexp[1];
        $tamam=1;
    }else{
        $tamam=0;
    }
    $cl = new Gorev();
    if($cl->GorevVarmi($gorevad,0)){
      $sonuc = "zatenvar";
    }else{
        //echo "insert into ".$this->tabloAd ." (gorevad,gorevdetay,anahtarlar,kullanici,tamam) values('$gorevad','$gorevdetay','$anahtarlar',$kullanici,$tamam)";
        $sql = $dba->query("insert into ".$this->tabloAd ." (gorevad,gorevdetay,anahtarlar,kullanici,tamam,gorevtarih) values('$gorevad','$gorevdetay','$anahtarlar',$kullanici,$tamam,'$bastarihsaat')");
        $sonuc = $dba->insert_id($sql);
        }
    return $sonuc;
    }
    
    public Function GorevDuzenle($gorevid,$gorevad,$gorevdetay,$kullanici,$tamam,$anahtarlar){
        $dba = new dbClass();
        $dba->connect();
        $tamam = strpos($anahtarlar,'tamam');
        $bastarihsaat = date("Y-m-d H:i:s");
        if($tamam==1){
            $anahtarlarexp=  explode('tamam', $anahtarlar);
            $anahtarlar = $anahtarlarexp[1];
            $tamam=1;
        }else{
            $tamam=0;
        }
        $cl = new Gorev();
        if($cl->GorevVarmi($gorevad,$gorevid)==true){
           $sonuc="zatenvar";
        }else{
            //echo "update $this->tabloAd set gorevad ='$gorevad',gorevdetay='$gorevdetay', anahtarlar ='$anahtarlar', tamam=$tamam, duzenlemetarih='$bastarihsaat', kullanici =$kullanici where id =$gorevid";
            $sql=$dba->query("update $this->tabloAd set gorevad ='$gorevad',gorevdetay='$gorevdetay', anahtarlar ='$anahtarlar', tamam=$tamam, duzenlemetarih='$bastarihsaat', kullanici =$kullanici where id =$gorevid");
            $dba->affected_rows($sql);
            $sonuc =true;
        }
        return $sonuc;
    }

    public function GorevVarmi($gorevad,$gorevid)
    {
        $dba = new dbClass();
        $dba->connect();
        //echo "select count(id) sayi from ".$this->tabloAd ." where gorevad='$gorevad' and id <> $gorevid";
        $sql = $dba->query("select count(id) sayi from ".$this->tabloAd ." where gorevad='$gorevad' and id <> $gorevid");
        $sonuc =$dba->fetch_object($sql);
        if($sonuc->sayi=="0"){
            return false;
        }else{
            return true;
        }
    }

    public function GorevSil($gorevid){
    $dba = new dbClass();
    $dba->connect();
    //$birimcls= new Birim();
    $sql = $dba->query("delete from ".$this->tabloAd ." where id =$gorevid");
    //$sql =$dba->query("select id from gorevler where gorevid =$gorevid");
    /*while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    foreach(@$r as $s){
      $quizcls->BirimSil($s->id);
    }*/
    $sonuc=1;
    return $sonuc;
    }
    
    
  public function GorevMailGonder($gorev,$gorevdetay,$kullaniciadsoyad,$kullanicieposta,$tamam){
    header('Content-Type: text/html; charset=utf-8');
    include_once("../PHPMailer/class.phpmailer.php");
    $phpmailer = new PHPMailer;
    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.yandex.com'; // duzenlenecek
    $phpmailer->SMTPAuth = true;
    $phpmailer->Username = 'rapor@dokuzsistem.com'; // duzenlenecek
    $phpmailer->Password = 'P@ssw0rd9'; // duzenlenecek
    $phpmailer->SMTPSecure = 'tls'; // duzenlenecek
    $phpmailer->Port = '587'; // duzenlenecek
    $phpmailer->CharSet = "utf-8";
    $phpmailer->From = 'rapor@dokuzsistem.com'; // duzenlenecek
    $phpmailer->FromName = ' Dokuz Sistem Ticket Sistemi'; // duzenlenecek
    $phpmailer->AddReplyTo($kullanicieposta,$kullaniciadsoyad);
    $phpmailer->addAddress('haktan.akdag@dokuzsistem.com', 'Dokuz Ticket Sistemi'); // duzenlenecek
    $phpmailer->isHTML(true);
    $phpmailer->Subject = " Dokuz Sistem Ticket Sistemi !!! : ".$gorev;
    $mesaj = $gorevdetay;
    if($tamam=="1"){
        $gorevdurum = " <b>Drum :</b> Ticket Tamamlanmıştır.";
    }else{
        $gorevdurum =" <b>Drum :</b> Ticket İnceleme Sürecindedir.";
    }
    $mesaj ="<b>Mesaj Konusu :</b> ".$gorev."<br><b>Kullanıcı</b> : ".$kullaniciadsoyad. "<br><b>Eposta : </b>  ".$kullanicieposta."<br>  <b>Görev Detayı :</b> ". $mesaj;
    $mesaj = $mesaj."<br>". $gorevdurum;
    //echo $mesaj;
    $phpmailer->Body    = $mesaj;
    $phpmailer->CharSet = 'UTF-8';

    //$phpmailer->SMTPDebug = 2;
    if(!$phpmailer->send()) {
       echo 'Mail gonderilemedi. Hata: ' . $phpmailer->ErrorInfo; 
       exit; 
    } 
    echo 'Mail gonderildi.'; 
    }
}

?>