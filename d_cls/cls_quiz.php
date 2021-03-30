<?php
class Quiz{
private $quizid;
private $aciklama;
Private $konuid;

    var $tabloAd="quiz";
    var $viewad="vquiz";
    var $tabloAdQuizSoru="quizsoru";
    var $tabloAdQuizCevap="quizcevap";
    var $tabloAdQuizSonucBaslik="quizsonucbaslik";
    var $tabloAdQuizSonucDetay="quizsonucdetay";
    
    
    
    public function QuizSayiBul(){
    $dba = new dbclass();
    $dba->connect();
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    public function QuizGetir($quizid){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select * from ".$this->tabloAd ."
    where id =$quizid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }

    public function QuizleriGetir($pagerWhere ="",$aramaString=""){
    $dba = new dbClass();
    $dba->connect();
    $query ="select * from ".$this->viewad ." $aramaString order by id desc $pagerWhere";
    //echo $query;
    $sql = $dba->query($query);
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    public function QuizSoruGetir($soruid){
	$dba = new dbClass();
	$dba->connect();
	//echo "select * from ".$this->tabloAdQuizSoru ." where id =$soruid";
	$sql = $dba->query("select * from ".$this->tabloAdQuizSoru ." where id =$soruid");
	$sonuc = $dba->fetch_object($sql);
        return $sonuc;
	}
        
    public function QuizUygulamaSorulariGetir($quizid){
	$dba = new dbClass();
	$dba->connect();
	//echo "select * from ".$this->tabloAdAnketSoru ." where anketid=$anketid";
	$sql = $dba->query("select * from ".$this->tabloAdQuizSoru ." where quizid=$quizid");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
    }
    
      public function QuizUygulamaSoruCevaplariniGetir($soruid){
	$dba = new dbClass();
	$dba->connect();
	//echo "select * from ".$this->tabloAdAnketSoru ." where anketid=$anketid";
	$sql = $dba->query("select * from ".$this->tabloAdQuizCevap." where soruid=$soruid");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
    }
        
    public function QuizCevapGetir($cevapid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAdQuizSoru ." where id =$soruid";
    $sql = $dba->query("select * from ".$this->tabloAdQuizCevap." where id =$cevapid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
        
    public function QuizleriGetirDerseGore($dersid){
    $dba = new dbClass();
    $dba->connect();
    //echo "select * from ".$this->tabloAd ." where dersid=$dersid";
    $sql = $dba->query("select * from ".$this->tabloAd ." where dersid=$dersid");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    return $r;
    }
    
    public function QuizSoruSayiBul($quizid){
    $dba = new dbclass();
    $dba->connect();
    //echo "select count(id) sayi from ".$this->tabloAdQuizSoru." where id=$quizid";
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAdQuizSoru." where id=$quizid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }

    public function QuizCevapSayiBul($quizid,$soruid){
    $dba = new dbclass();
    $dba->connect();
    //echo "select count(id) sayi from ".$this->tabloAdQuizSoru." where id=$quizid";
    $sql=$dba->query("select count(id) sayi from ".$this->tabloAdQuizCevap." where cevapid=$quizid and soruid=$soruid");
    $sonuc = $dba->fetch_object($sql);
    return $sonuc;
    }
    
    public function QuizSorulariGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAdQuizSoru ." $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
    public function QuizCevaplariGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("select * from ".$this->tabloAdQuizCevap ." $aramaString $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
        

    public function QuizEkle($quizad,$dersid){
    $dba = new dbClass();
    $dba->connect();
    $cl = new Quiz();
    if($cl->QuizVarmi($quizad,0)){
      $sonuc = "zatenvar";
    }else{
        //echo "insert into ".$this->tabloAd ." (quizad,dersid) values('$quizad','$dersid')";
        $sql = $dba->query("insert into ".$this->tabloAd ." (quizad,dersid) values('$quizad','$dersid')");
        $sonuc = $dba->insert_id($sql);
         }
    return $sonuc;
    }
    
    public Function QuizDuzenle($quizid,$quizad,$dersid){
        $dba = new dbClass();
        $dba->connect();
        $cl = new Quiz();
        if($cl->QuizVarmi($aciklama,$quizid)==true){
           $sonuc="zatenvar";
        }else{
            //echo "update $this->tabloAd set $quizad ='$quizad', dersid='$dersid' where id =$quizid";
            $sql=$dba->query("update $this->tabloAd set $quizad ='$quizad', dersid='$dersid' where id =$quizid");
            $sonuc =$dba->affected_rows($sql);
        }
        return $sonuc;
    }

    public function QuizVarmi($quizad,$quizid)
    {
        $dba = new dbClass();
        $dba->connect();
        $sql = $dba->query("select count(id) sayi from ".$this->tabloAd ." where quizad='$quizad' and id <> $quizid");
        $sonuc =$dba->fetch_object($sql);
        if($sonuc->sayi>0){
            return true;
        }else{
            return false;
        }
    }
    
    public function QuizSoruEkle($quizid,$soru){
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("insert into ".$this->tabloAdQuizSoru ." (quizid,soru) values('$quizid','$soru')");
    $sonuc = $dba->insert_id($sql);
    return $sonuc;
    }

    public function QuizSoruDuzenle($quizsoruid,$soru){
    $dba = new dbClass();
    $dba->connect();
    //echo "update ".$this->tabloAdQuizSoru ." set soru='$soru' where id =$quizsoruid";
    $sql = $dba->query("update ".$this->tabloAdQuizSoru ." set soru='$soru' where id =$quizsoruid" );
    $sonuc=$quizsoruid;
    return $sonuc;
    }

    public function QuizCevapEkle($quizid,$soruid,$cevap,$dy){
    $dba = new dbClass();
    $dba->connect();
    $bir = new Quiz();
      if($dy=="dogru"){
        $dy="D";
    }else{
        $dy="Y";
    }
    //echo "insert into ".$this->tabloAdQuizCevap ." (quizid,soruid,cevap,dy) values($quizid,$soruid,'$cevap','$dy')";
    $sql = $dba->query("insert into ".$this->tabloAdQuizCevap ." (quizid,soruid,cevap,dy) values($quizid,$soruid,'$cevap','$dy')");
    $sonuc = $dba->insert_id($sql);
    return $sonuc;
    }

    public function QuizCevapDuzenle($cevapid,$quizid,$soruid,$cevap,$dy){
    $dba = new dbClass();
    $dba->connect();
    $bir = new Quiz();
    if($dy=="dogru"){
        $dy="D";
    }else{
        $dy="Y";
    }
    //echo "update ".$this->tabloAdQuizCevap ." set cevap='$cevap',dy='$dy' where id =$cevapid";
    $sql = $dba->query("update ".$this->tabloAdQuizCevap ." set cevap='$cevap',dy='$dy' where id =$cevapid" );
    $sonuc=$cevapid;
    return $sonuc;
    }

    public function QuizSoruVarmi($quizsoruid,$quizid,$soru)
    {
    $dba = new dbClass();
    $dba->connect();
    $sql = $dba->query("select id from ".$this->tabloAdQuizSoru ." where soru='$soru' and quizid=$quizid and  id <>$quizsoruid");
    $sonuc =$dba->fetch_object($sql);
    if($sonuc){
    return $sonuc->id;
    }else{
    return false;
    }
    }

    public function QuizSil($quizid){
    $dba = new dbClass();
    $dba->connect();
    $sorucls= new Soru();
    $sql = $dba->query("delete from ".$this->tabloAdQuizSoru ." where id =$quizid");
    $sql =$dba->query("select id from sorular where quizid =$quizid");
    while(@$sonuc =$dba->fetch_object($sql)){
            $r[] =$sonuc;
            }
    foreach(@$r as $s){
       $sorucls->SoruSil($s->id);
    }
    $sonuc=1;
    return $sonuc;
    }
    
    public function QuizSonucBaslikEkle($quizid,$adsoyad,$aciklama){
    $dba = new dbClass();
    $dba->connect();
    $cl = new Quiz();
    $zatenvar=$cl->QuizSonucVarmi($quizid,$adsoyad);
    if($zatenvar>0){
    $sonuc= "zatenvar";
    }else{
    //echo "insert into ".$this->tabloAdQuizSonucBaslik." (quizid,adsoyad,aciklama) values('$quizid','$adsoyad','$aciklama')";
    $sql = $dba->query("insert into ".$this->tabloAdQuizSonucBaslik." (quizid,adsoyad,aciklama) values('$quizid','$adsoyad','$aciklama')");
    $sonuc = $dba->insert_id($sql);
    }
    return $sonuc;
    }
    
    public function QuizSonucVarmi($quizid,$adsoyad)
    {
    $dba = new dbClass();
    $dba->connect();
    //echo "select id from ".$this->tabloAdQuizSonucBaslik ." where quizid='$quizid' and adsoyad='$adsoyad'";
    $sql = $dba->query("select id from ".$this->tabloAdQuizSonucBaslik ." where quizid='$quizid' and adsoyad='$adsoyad'");
    $sonuc =$dba->fetch_object($sql);
    if($sonuc){
    return $sonuc->id;
    }else{
    return false;
    }
    }
    
    public function QuizSonucDetayEkle($baslikid,$quizid,$soruid,$cevapid){
    $dba = new dbClass();
    $dba->connect();
    $cl = new Quiz();
    //echo "insert into ".$this->tabloAdQuizSonucDetay." (baslikid,quizid,soruid,cevapid) values('$baslikid','$quizid','$soruid','$cevapid')";
    $sql = $dba->query("insert into ".$this->tabloAdQuizSonucDetay." (baslikid,quizid,soruid,cevapid) values('$baslikid','$quizid','$soruid','$cevapid')");
    $sonuc = $dba->insert_id($sql);
    return $sonuc;
    }
    
    
    
}

?>