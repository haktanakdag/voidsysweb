<?php
class Entegrasyon{
    private $entUrunKodu;

    var $tabloAdUrunler="ent_urunler";
    var $tabloAdRecete="ent_recete";
	
	public function entUrunlerSayiBul(){
	$dba = new dbclass();
	$dba->connect();
	$sql=$dba->query("select count(id) sayi from ".$this->tabloAdUrunler);
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
        
	public function entUrunGetir($entUrunKodu){
	$dba = new dbClass();
	$dba->connect();
        //echo "select * from ".$this->tabloAdUrunler ." where urunkod =$entUrunKodu";
	$sql = $dba->query("select * from ".$this->tabloAdUrunler ." where urunkod ='$entUrunKodu'");
        //echo "select * from  $this->tabloAd where id =$Anahtarid";
	$sonuc = $dba->fetch_object($sql);
	return $sonuc;
	}
        
        public function entNetsisUrunGetir($entUrunKodu){
	$dba = new dbClass();
	$dba->connect();
        $baglanti = odbc_connect('DRIVER={SQL Server};SERVER=192.168.0.17;DATABASE=AYBEL2018','HAKTAN','1312');
        $sorgu=odbc_exec($baglanti,"SELECT STOK_KODU,STOK_ADI from TBLSTSABIT WHERE STOK_KODU='$entUrunKodu'");
        $sonuc = odbc_fetch_array($sorgu);
	return $sonuc;
	}
	
	public function entUrunleriGetir($pagerWhere ="",$aramaString=""){
	$dba = new dbClass();
	$dba->connect();
        //echo "select * from ".$this->tabloAd ." $aramaString order by id asc $pagerWhere";
	$sql = $dba->query("select * from ".$this->tabloAdUrunler ." $aramaString order by urunkod asc $pagerWhere");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
        
        public function entUrunGruplariGetir(){
	$dba = new dbClass();
	$dba->connect();
        //echo "select * from ".$this->tabloAd ." $aramaString order by id asc $pagerWhere";
        //echo "select DISTINCT grup,ekgrup from ".$this->tabloAdUrunler;
	$sql = $dba->query("select DISTINCT grup,ekgrup from ".$this->tabloAdUrunler);
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
        
        public function entReceteGetir($mamulkod){
	$dba = new dbClass();
	$dba->connect();
        //echo "select * from ".$this->tabloAdRecete ." where mamulkod='$mamulkod'";
	$sql = $dba->query("select * from ".$this->tabloAdRecete ." where mamulkod='$mamulkod'");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
        
	public function entUrunEkle($enturunkod,$enturunad,$grup,$ekgrup){
	$dba = new dbClass();
	$dba->connect();
        //$sql =$dba->query("delete from ".$this->tabloAdUrunler ." where urunkod ='$enturunkod'");
        //echo "insert into ".$this->tabloAdUrunler ." (urunkod,urunad) values('$enturunkod','$enturunad')";
        $sql = $dba->query("insert into ".$this->tabloAdUrunler ." (urunkod,urunad,grup,ekgrup) values('$enturunkod','$enturunad','$grup','$ekgrup')");
        $sonuc = $dba->insert_id($sql);
        echo $enturunkod." - ".$enturunad ." ->  Aktarıldı.";
        echo "<br>";
	return $sonuc;
	}
        
        public function netsisRecetesiVarmi($mamulkod){
	$baglanti = odbc_connect('DRIVER={SQL Server};SERVER=192.168.0.17;DATABASE=AYBEL2018','HAKTAN','1312');
        $sorgu=odbc_exec($baglanti,"SELECT count(1) sayi from TBLSTOKURM WHERE MAMUL_KODU='$mamulkod'");
        $sonuc = odbc_fetch_array($sorgu);
        return $sonuc;
	}
        
        public function netsisUrunGetir($STOK_KODU){
	$baglanti = odbc_connect('DRIVER={SQL Server};SERVER=192.168.0.17;DATABASE=AYBEL2018','HAKTAN','1312');
        $sorgu=odbc_exec($baglanti,"SELECT STOK_KODU,STOK_ADI,OLCU_BR1 BIRIM   from TBLSTSABIT WHERE STOK_KODU='$STOK_KODU'");
        $sonuc = odbc_fetch_array($sorgu);
        return $sonuc;
	}
        
        public function entReceteEkle($mamulkod,$hamkod){
	$dba = new dbClass();
	$dba->connect();
        echo "insert into ".$this->tabloAdRecete ." (mamulkod,hamkod) values('$mamulkod','$hamkod')";
        $sql = $dba->query("insert into ".$this->tabloAdRecete ." (mamulkod,hamkod) values('$mamulkod','$hamkod')");
        $sonuc = $dba->insert_id($sql);
        //echo $mamulkod." - ".$hamkod ." ->  Aktarıldı.";
        //echo "<br>";
	return $sonuc;
	}
        
        public function netsisUrunGruplariCek(){
        $baglanti = odbc_connect('DRIVER={SQL Server};SERVER=192.168.0.17;DATABASE=AYBEL2018','HAKTAN','1312');
        // sorguyu isletelim
        $sorgu = odbc_exec($baglanti,"select GRUP_KODU from TBLSTSABIT WHERE (STOK_KODU LIKE 'H.%' OR STOK_KODU LIKE 'Y.%' OR STOK_KODU LIKE 'M.%') AND GRUP_KODU IN('HAMMADDE','MAMUL','YMAMUL','AMBALAJ') GROUP BY GRUP_KODU");
        // verileri alip isleyelim

        /*while( $bilgi = odbc_fetch_array($sorgu) ){
        print_r($bilgi);
        }*/

        while(@$sonuc =odbc_fetch_object($sorgu)){
        $r[] =$sonuc;
        }
        return $r;
        }
        
        public function netsisUrunleriCek($GRUP_KODU=""){
        $baglanti = odbc_connect('DRIVER={SQL Server};SERVER=192.168.0.17;DATABASE=AYBEL2018','HAKTAN','1312');
        // sorguyu isletelim
        $sorgu = odbc_exec($baglanti,"select STOK_KODU,dbo.FNC_Turkce_Kaldir(STOK_ADI) STOK_ADI,GRUP_KODU,KOD_1 from TBLSTSABIT WHERE (STOK_KODU LIKE 'H.%' OR STOK_KODU LIKE 'Y.%' OR (STOK_KODU LIKE 'M.%' AND KOD_4='OU')) AND GRUP_KODU IN('HAMMADDE','MAMUL','YMAMUL','AMBALAJ') AND GRUP_KODU='$GRUP_KODU'");
        while(@$sonuc =odbc_fetch_object($sorgu)){
		$r[] =$sonuc;
		}
	return $r;
        }
        
        public function netsisReceteGetir($MAMUL_KODU){
        $baglanti = odbc_connect('DRIVER={SQL Server};SERVER=192.168.0.17;DATABASE=AYBEL2018','HAKTAN','1312');
        // sorguyu isletelim
        //echo "SELECT MAMUL_KODU,dbo.FNC_Turkce_Kaldir(MS.STOK_ADI) AS MAMUL_ADI,HAM_KODU,dbo.FNC_Turkce_Kaldir(HS.STOK_ADI) AS HAM_ADI FROM TBLSTOKURM U INNER JOIN TBLSTSABIT HS ON HS.STOK_KODU=U.HAM_KODU INNER JOIN TBLSTSABIT MS ON MS.STOK_KODU=U.MAMUL_KODU WHERE MAMUL_KODU ='".$MAMUL_KODU."'";
        $sorgu = odbc_exec($baglanti,"SELECT MAMUL_KODU,dbo.FNC_Turkce_Kaldir(MS.STOK_ADI) AS MAMUL_ADI,MS.OLCU_BR1 MAMULBIRIM,HAM_KODU,dbo.FNC_Turkce_Kaldir(HS.STOK_ADI) AS HAM_ADI,HS.OLCU_BR1 HAMBIRIM FROM TBLSTOKURM U INNER JOIN TBLSTSABIT HS ON HS.STOK_KODU=U.HAM_KODU INNER JOIN TBLSTSABIT MS ON MS.STOK_KODU=U.MAMUL_KODU  WHERE MAMUL_KODU ='".$MAMUL_KODU."'");
        while( @$sonuc = odbc_fetch_array($sorgu) ){
            $r[]=$sonuc;
        }
        return $r;
        }
        
        /*public function netsisReceteleriCekveAktar(){
        $baglanti = odbc_connect('DRIVER={SQL Server};SERVER=192.168.0.17;DATABASE=AYBEL2018','HAKTAN','1312');
        // sorguyu isletelim
        //echo "SELECT MAMUL_KODU,HAM_KODU FROM TBLSTOKURM WHERE (MAMUL_KODU LIKE 'M.%' OR MAMUL_KODU LIKE 'Y.%')";
        //$sorgu = odbc_exec($baglanti,"select MAMUL_KODU,HAM_KODU FROM TBLSTOKURM WHERE (MAMUL_KODU LIKE 'M.%' OR MAMUL_KODU LIKE 'Y.%')");
        $sorgu = odbc_exec($baglanti,"select DISTINCT MAMUL_KODU FROM TBLSTOKURM WHERE (MAMUL_KODU LIKE 'M.%' OR MAMUL_KODU LIKE 'Y.%')");
        // verileri alip isleyelim
        $receteler = new Entegrasyon();
        $receteler->netsisReceteTablosunuBosalt();
        //while( @$sonuc = odbc_fetch_array($sorgu) ){
        //print_r($sonuc);
        //$receteler->entReceteEkle($sonuc['MAMUL_KODU'],$sonucdetay['HAM_KODU']);
        //}
        
        while( @$sonuc = odbc_fetch_array($sorgu) ){
        $sorgudetay = odbc_exec($baglanti,"SELECT MAMUL_KODU,HAM_KODU FROM TBLSTOKURM WHERE MAMUL_KODU ='".$sonuc['MAMUL_KODU']."'");
            while (@$sonucdetay=odbc_fetch_array($sorgudetay)){
            $receteler->entReceteEkle($sonucdetay['MAMUL_KODU'],$sonucdetay['HAM_KODU']);
            }
        }
        /*while(@$sonuc =odbc_fetch_object($sorgu)){
                //print_r($sonuc);
		$r[] =$sonuc;
		}
        }
        */
        
        public function netsisReceteleriCekveAktar(){
        $baglanti = odbc_connect('DRIVER={SQL Server};SERVER=192.168.0.17;DATABASE=AYBEL2018','HAKTAN','1312');
        // sorguyu isletelim
        //echo "SELECT MAMUL_KODU,HAM_KODU FROM TBLSTOKURM WHERE (MAMUL_KODU LIKE 'M.%' OR MAMUL_KODU LIKE 'Y.%')";
        //$sorgu = odbc_exec($baglanti,"select MAMUL_KODU,HAM_KODU FROM TBLSTOKURM WHERE (MAMUL_KODU LIKE 'M.%' OR MAMUL_KODU LIKE 'Y.%')");
        $sorgu = odbc_exec($baglanti,"select DISTINCT MAMUL_KODU FROM TBLSTOKURM WHERE (MAMUL_KODU LIKE 'M.%' OR MAMUL_KODU LIKE 'Y.%')");
        while( @$sonuc = odbc_fetch_array($sorgu) ){
            $r[]=$sonuc;
        }
        // verileri alip isleyelim
        $receteler = new Entegrasyon();
        $receteler->netsisReceteTablosunuBosalt();
        foreach ($r as $s){
           $sorgudetay = odbc_exec($baglanti,"SELECT MAMUL_KODU,HAM_KODU FROM TBLSTOKURM WHERE MAMUL_KODU ='".$sonuc['MAMUL_KODU']."'");
           while (@$sonucdetay=odbc_fetch_array($sorgudetay)){
               $t[] =$sonucdetay['MAMUL_KODU'];
            $receteler->entReceteEkle($sonucdetay['MAMUL_KODU'],$sonucdetay['HAM_KODU']);
            }
        }
        //print_r($t);
        /*while(@$sonuc =odbc_fetch_object($sorgu)){
                //print_r($sonuc);
		$r[] =$sonuc;
		}*/
        }
        
        public function netsisReceteTablosunuBosalt(){
        $dba = new dbClass();
        $dba->connect();
        $dba->query("truncate table ".$this->tabloAdRecete);
        }
        
        public function netsisUrunleriAktar(){
       
        $urunler = new Entegrasyon();
        $durunler = $urunler->netsisUrunleriCek();
        //print_r($durunler);
        foreach ($durunler as $ur){
            $urunler->entUrunEkle($ur->STOK_KODU,$ur->STOK_ADI ,$ur->GRUP_KODU,$ur->KOD_1);
        }
        }
        
        /*Public function netsisReceteleriAktar(){
        $dba = new dbClass();
        $dba->connect();
        echo "truncate table ".$this->tabloAdRecete;
        $dba->query("truncate table ".$this->tabloAdRecete);
        $entegrasyon = new Entegrasyon();
        $dentegrasyon = $entegrasyon->netsisReceteleriCek();
        //print_r($durunler);
        //foreach ($dentegrasyon as $rr){
        //    echo $rr[0].",".$rr[1];
            //$entegrasyon->entReceteEkle($rr->MAMUL_KODU,$rr->HAM_KODU);
        //}
        }*/
        
}

?>