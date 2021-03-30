<?php
class Raporlar {
private $raporid;
private $raporad;
private $raporkaynak;
private $raportip;
private $raporveritip;

	var $tabloAd="raporlar";
	
	public function RaporKolonlariGetir($raporad){
	$dba = new dbClass();
	$dba->connect();
	//echo "select * from ".$this->tabloAd ." where raporad ='".$raporad."'";
	$sql = $dba->query("select * from ".$this->tabloAd ." where raporad ='".$raporad."'");
	$rapor = $dba->fetch_object($sql);
	//echo "SELECT  COLUMN_NAME AS kolonadi FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$rapor->kaynak."' and TABLE_SCHEMA='$dba->db'";
	$sql =$dba->query("SELECT  COLUMN_NAME AS kolonadi FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '".$rapor->kaynak."' and TABLE_SCHEMA='$dba->db'");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}
	
	public function RaporSatirlariGetir($raporad,$wherestr =""){
	$dba = new dbClass();
	$dba->connect();
	//echo "select * from ".$this->tabloAd ." where raporad ='".$raporad."'";
	$sql = $dba->query("select * from ".$this->tabloAd ." where raporad ='".$raporad."'");
	$rapor = $dba->fetch_object($sql);
	//echo "SELECT  * from $rapor->kaynak";
	if($wherestr<>""){
		$wherestr="where $wherestr";
	}
        //echo "SELECT * from $rapor->kaynak $wherestr";
        $sql =$dba->query("SELECT  * from $rapor->kaynak $wherestr");
	while(@$sonuc =$dba->fetch_object($sql)){
		$r[] =$sonuc;
		}
	return $r;
	}

	Public function RaporOlustur($raporad,$wherestr=""){
        $raporlar = new Raporlar();
        $raporkol = $raporlar->RaporKolonlariGetir($raporad);
        echo "<script>
	$(function() {
		$('button').click(function(){
			$('#table2excel').table2excel({
					exclude: '.noExl',
					name: '$raporad',
					filename: '$raporad',
					fileext: '.xls',
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
			});
	});
	});
	</script>";
	echo "<button class='btn'>Excel Export</button>";
	echo "<input type='search' class='light-table-filter' data-table='".$raporad."' placeholder='Filtrer' />";
	echo "<table class='$raporad' id='table2excel'><thead><tr>";
        foreach($raporkol as $rc){
                echo "<th>$rc->kolonadi</th>";
        }
        echo "</tr></thead><tbody>";        
        $raporsat = $raporlar->RaporSatirlariGetir($raporad,$wherestr);
	if($raporsat){
	foreach($raporsat as $rs){
			echo "<tr>";
			foreach($raporkol as $rc){
					$kolonadi =$rc->kolonadi;
                                        //echo $kolonadi;
					$sonuc=$rs->$kolonadi;
					if(!$sonuc){
						$sonuc ="&nbsp;";
					}
					echo "<td data-label=".$rc->kolonadi.">".$sonuc."</td>";
			}
			echo "</tr>";
	}
	}
	echo "</tbody></table>";
}
    
    
    public function RaporSatirlariGetirSSP($raporad,$parametre =""){
	$dba = new dbClass();
	$dba->connect();
	//echo "select * from ".$this->tabloAd ." where raporad ='".$raporad."'";
	$sql = $dba->query("select * from ".$this->tabloAd ." where raporad ='".$raporad."'");
	$rapor = $dba->fetch_object($sql);
        $parametrebas="(";
        foreach($parametre as $pr){
        $strParametre .= ",'".$pr."'";
        $strParametre=ltrim($strParametre,",");
        }
        $parametreson=");";
        $param= $parametrebas.$strParametre.$parametreson;
        //echo "call ". $rapor->kaynak ." ". $param;
	$sql =$dba->query("call ". $rapor->kaynak ." ". $param);
	while(@$sonuc =$dba->fetch_object($sql)){ 
		$r[] =$sonuc;
		}
                $dba->close();
	@mysql_select_db($dba->db);
	return $r;
        $dba->close();
	}
        
	Public function RaporOlusturSSP($raporad,$parametre="",$raporkol){
	$raporlar = new Raporlar();
	echo "<script>
	$(function() {
		$('button').click(function(){
			$('#table2excel').table2excel({
					exclude: '.noExl',
					name: '$raporad',
					filename: '$raporad',
					fileext: '.xls',
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
			});
	});
	});
	</script>";
	echo "<button class='btn'>Excel Export</button>";
	echo "<input type='search' class='light-table-filter' data-table='".$raporad."' placeholder='Filtrer' />";
	echo "<table class='$raporad' id='table2excel'><thead><tr>";
	foreach($raporkol as $rc){
			echo "<th>$rc</th>";
	}
	echo "</tr></thead><tbody>";
	$raporsat = $raporlar->RaporSatirlariGetirSSP($raporad,$parametre);
	if($raporsat){
	foreach($raporsat as $rs){
			echo "<tr>";
			foreach($raporkol as $rc){
					$kolonadi =$rc;
					$sonuc=$rs->$kolonadi;
					if(!$sonuc){
						$sonuc ="&nbsp;";
					}
					echo "<td data-label=".$rc.">".$sonuc."</td>";
			}
			echo "</tr>";
	}
	}
	echo "</tbody></table>";
}
     public function RaporSorguDondur($raporad,$wherestr =""){
	$dba = new dbClass();
	$dba->connect();
	//echo "select * from ".$this->tabloAd ." where raporad ='".$raporad."'";
	$sql = $dba->query("select * from ".$this->tabloAd ." where raporad ='".$raporad."'");
	$rapor = $dba->fetch_object($sql);
	//echo "SELECT  * from $rapor->kaynak";
	if($wherestr<>""){
		$wherestr="where $wherestr";
	}
	return "SELECT  * from $rapor->kaynak $wherestr";
        }
        
        
        Public function RaporOlusturWithQuery($sorgu,$raporkol,$raporad=""){
        echo "<script>
	$(function() {
		$('button').click(function(){
			$('#table2excel').table2excel({
					exclude: '.noExl',
					name: '$raporad',
					filename: '$raporad',
					fileext: '.xls',
					exclude_img: true,
					exclude_links: true,
					exclude_inputs: true
			});
	});
	});
	</script>";
	echo "<button class='btn'>Excel Export</button>";
	echo "<input type='search' class='light-table-filter' data-table='".$raporad."' placeholder='Filtrer' />";
	echo "<table class='$raporad' id='table2excel''><thead><tr>";
        $dba = new dbClass();
        foreach($raporkol as $rc){
                echo "<th>$rc</th>";
        }
        echo "</tr></thead><tbody>";
        $sql = $dba->query($sorgu);
        while(@$sonuc =$dba->fetch_object($sql)){
        $raporsat[] =$sonuc;
        }
        if($raporsat){
        foreach($raporsat as $rs){
                echo "<tr>";
                foreach($raporkol as $rc){
                        $kolonadi =$rc;
                        echo "<td>".$rs->$kolonadi."</td>";
                }
                echo "</tr>";
        }
        } 
        echo "</tbody></table>";
	}
        
	function exportExcel($raporad,$wherestr=""){
	$raporlar = new Raporlar();	
        header('Content-Encoding: UTF-8');
        header('Content-Type: text/plain; charset=utf-8'); 
        header("content-type:application/csv;charset=UTF-8");
        //header("Content-Disposition:attachment;filename=\"$raporad.csv\"");
        header("Content-disposition: attachment; filename=".$raporad.".xls");
        header("Content-Type: application/vnd.ms-excel");
        //echo "\xEF\xBB\xBF"; // UTF-8 BOM
        echo $raporlar->RaporOlustur($raporad,$wherestr); 
	}
}

?>

