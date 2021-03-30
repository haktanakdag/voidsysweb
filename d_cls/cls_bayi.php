<?php
class Bayiler{


	var $tabloAd="bayiler";
	var $tabloAdDetay="bayidetay";
        
	public function BayiSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAd);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}

	
	public function BayileriGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
        //echo "select * from ".$this->tabloAd ." $aramaString order by id asc $pagerWhere";
	$sql = $dba->query("select * from ".$this->tabloAd ." $aramaString order by id asc $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
        public function BayiGetir($bayiid){
	$dba = new dbClass();
	$dba->connect();
        //echo "select * from ".$this->tabloAd ." where id =$bayiid";
	$sql = $dba->query("select * from ".$this->tabloAd ." where id =$bayiid");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
         
        public function BayiDetayGetir($bayiid){
	$dba = new dbClass();
	$dba->connect();
        //echo "select * from ".$this->tabloAdDetay ." where bayiid =$bayiid";
	$sql = $dba->query("select * from ".$this->tabloAdDetay ." where bayiid =$bayiid");
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
	
        public function BayiEkle($bayikodu,$bayiadi,$bylogokucuk,$bylogobuyuk,$bylogoico,$sunucuadresi){
	$dba = new dbClass();
	$dba->connect();
	$data = new Bayiler();
	if($data->BayiVarmi($bayikodu,0)==true){
		$sonuc = "bayivar";
	}else{
            //echo "insert into ".$this->tabloAd ." (bayikodu,bayiadi,logokucuk,logobuyuk,logoico,sunucuadresi) values('$bayikodu','$bayiadi','$bylogokucuk','$bylogobuyuk','$bylogoico','$sunucuadresi')";
            $sql = $dba->query("insert into ".$this->tabloAd ." (bayikodu,bayiadi,logokucuk,logobuyuk,logoico,sunucuadresi) values('$bayikodu','$bayiadi','$bylogokucuk','$bylogobuyuk','$bylogoico','$sunucuadresi')");
            $sonuc = $dba->insert_id($sql);
		}
	return $sonuc;
	}

	public function BayiDuzenle($bayiid,$bayikodu,$bayiadi,$bylogokucuk,$bylogobuyuk,$bylogoico,$sunucuadresi){
	$dba = new dbClass();
	$dba->connect();
	$data = new Bayiler();
	if($data->BayiVarmi($bayikodu,$bayiid)==true){
           $sonuc="zatenvar";
        }else{
           //echo "update ".$this->tabloAd ." set bayikodu ='$bayikodu' , bayiadi='$bayiadi', logokucuk ='$bylogokucuk', logobuyuk ='$bylogobuyuk', logoico='$bylogoico', sunucuadresi='$sunucuadresi' where id =$bayiid";
           $sql = $dba->query("update ".$this->tabloAd ." set bayikodu ='$bayikodu' , bayiadi='$bayiadi', logokucuk ='$bylogokucuk', logobuyuk ='$bylogobuyuk', logoico='$bylogoico', sunucuadresi='$sunucuadresi' where id =$bayiid");
           $sonuc=1;
	}
	return $sonuc;
	}
	
        public  function BayiIslem($bayiid,$sabittel,$ceptel,$fax,$adres,$email,$www,$calsaathici,$calsaathsonu,$bizkimiz,$facebookadr,$twitteradr,$instagramadr,$detaybilgi,$anahtarkelimeler){
            $dba = new dbClass();
            $dba->connect();
            $data = new Bayiler();
            $dbayidetay = $data->BayiDetayGetir($bayiid);
            if($dbayidetay->bayiid){
                $data->BayiDetayDuzenle($bayiid, $sabittel, $ceptel, $fax, $adres, $email, $www, $calsaathici, $calsaathsonu, $bizkimiz, $facebookadr, $twitteradr, $instagramadr, $detaybilgi, $anahtarkelimeler);
                $sonuc =1;
            }else{
                $data->BayiDetayEkle($bayiid, $sabittel, $ceptel, $fax, $adres, $email, $www, $calsaathici, $calsaathsonu, $bizkimiz, $facebookadr, $twitteradr, $instagramadr, $detaybilgi, $anahtarkelimeler);
                $sonuc =1;
            }
            return $sonuc;
        }


        public function BayiDetayEkle($bayiid,$sabittel,$ceptel,$fax,$adres,$email,$www,$calsaathici,$calsaathsonu,$bizkimiz,$facebookadr,$twitteradr,$instagramadr,$detaybilgi,$anahtarkelimeler){
	$dba = new dbClass();
	$dba->connect();
        echo "insert into ".$this->tabloAdDetay ." (bayiid,sabittel,ceptel,fax,adres,email,www,calsaathici,calsaathsonu,bizkimiz,facebookadr,twitteradr,instagramadr,detaybilgi,anahtarkelimeler) values($bayiid,'$sabittel','$ceptel','$fax','$adres','$email','$www','$calsaathici','$calsaathsonu','$bizkimiz','$facebookadr','$twitteradr','$instagramadr','$detaybilgi','$anahtarkelimeler')";
        $sql = $dba->query("insert into ".$this->tabloAdDetay ." (bayiid,sabittel,ceptel,fax,adres,email,www,calsaathici,calsaathsonu,bizkimiz,facebookadr,twitteradr,instagramadr,detaybilgi,anahtarkelimeler) values($bayiid,'$sabittel','$ceptel','$fax','$adres','$email','$www','$calsaathici','$calsaathsonu','$bizkimiz','$facebookadr','$twitteradr','$instagramadr','$detaybilgi','$anahtarkelimeler')");
        $sonuc = $dba->insert_id($sql);
	return $sonuc;
	}
        
        public function BayiDetayDuzenle($bayiid,$sabittel,$ceptel,$fax,$adres,$email,$www,$calsaathici,$calsaathsonu,$bizkimiz,$facebookadr,$twitteradr,$instagramadr,$detaybilgi,$anahtarkelimeler){
	$dba = new dbClass();
	$dba->connect();
        echo "update ".$this->tabloAdDetay ." set sabittel ='$sabittel' , ceptel='$ceptel', fax ='$fax', adres ='$adres', email='$email', www='$www', calsaathici='$calsaathici', calsaathsonu ='$calsaathsonu', bizkimiz ='$bizkimiz', facebookadr='$facebookadr', twitteradr='$twitteradr', instagramadr='$instagramadr', detaybilgi='$detaybilgi', anahtarkelimeler='$anahtarkelimeler'  where bayiid =$bayiid";
        $sql = $dba->query("update ".$this->tabloAdDetay ." set sabittel ='$sabittel' , ceptel='$ceptel', fax ='$fax', adres ='$adres', email='$email', www='$www', calsaathici='$calsaathici', calsaathsonu ='$calsaathsonu', bizkimiz ='$bizkimiz', facebookadr='$facebookadr', twitteradr='$twitteradr', instagramadr='$instagramadr', detaybilgi='$detaybilgi', anahtarkelimeler='$anahtarkelimeler'  where bayiid =$bayiid");
        $sonuc = $dba->insert_id($sql);
	return $sonuc;
	}
        	
	public function BayiVarmi($bayikod,$bayiid)
	{
            $dba = new dbClass();
            $dba->connect();
            $sql = $dba->query("select id from ".$this->tabloAd ." where bayikodu='$bayikod' and id <> $bayiid");
            $sonuc =$dba->fetch_object($sql);
            if($sonuc){
                return true;
            }else{
                return false;
            }
	}
        
	public function BayiSil($bayiid){
	$dba = new dbClass();
	$dba->connect();
	$sql = $dba->query("delete from ".$this->tabloAd ." where id =$bayiid");
	$sonuc=1;
	return $sonuc;
	}
}

?>