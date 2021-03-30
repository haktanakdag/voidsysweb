<?=$anahtaragore?>
<div class="wrap">
	<?php 
	$birimler= new birimler();
	$birim=$birimler->BirimleriGetir();
	
	
	function objectToArray($d) {
	if (is_object($d)) {
	// Gets the properties of the given object
	// with get_object_vars function
	$d = get_object_vars($d);
	}
	
	if (is_array($d)) {
	/*
	* Return array converted to object
	* Using __FUNCTION__ (Magic constant)
	* for recursive call
	*/
	return array_map(__FUNCTION__, $d);
	}
	else {
	// Return array
	return $d;
	}
	}
	$arrbirim = objectToArray($birim);
	
	//print_r($arrbirim);
	
	function has_children($rows,$id) {
		foreach ($rows as $row) {
			if ($row['birimbagid'] == $id)
			return true;
		}
		return false;
	}
	
	function build_menu($rows,$parent=0) {  
		$result = "<ul>";
		foreach ($rows as $row) {
			if ($row['birimbagid'] == $parent) {
			$strong="";
			if($row[id]==$id){$strong="<strong>";}
				$result .= "<li><a href=\"?birimid=$row[id]\">$row[birimad]</a>";
			if (has_children($rows,$row['id']))
				$result.= build_menu($rows,$row['id']);
				$result .= "</li>";
			}
		}
		$result.= "</ul>";
		return $result;
	}
	echo build_menu($arrbirim);
	
	$sayfaad="adminpanel.php";
	$forms = new clsForms();
	$forms->doform(array('basla','arama',$sayfaad));
	$forms->doInput(array('txtara',$txtara));
	$forms->doButton(array('ara','Ara'));
	echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;";
    
    $gorevtanimlar = new GorevTanimlar();
        
    if($aramaradio=="anahtaragore"){
	$gorevtanim =$gorevtanimlar->GorevTanimlariAnahtaraGoreGetir($txtara);
    $checkedanahtar="checked";
	}
    if($aramaradio=="ismegore"){
	$gorevtanim =$gorevtanimlar->GorevTanimlariIsmeGoreGetir($txtara);
    $checkedisim="checked";
	}
    if(!$aramaradio){
    $checkedanahtar="checked";
    }
	if($birimid){
	$gorevtanim =$gorevtanimlar->GorevTanimlariBirimeGoreGetir($birimid);
	}
	echo $forms->doRadioGroup(array('aramaradio','anahtaragore',"Anahtara Göre", $checkedanahtar));
        echo "&nbsp;";
        echo $forms->doRadioGroup(array('aramaradio','ismegore',"İsime Göre",$checkedisim));
    
	$forms->doform(array('bitir'));
	echo "<hr>";
	
	
	if($gorevtanim){
		foreach($gorevtanim as $g)
		{	
			echo "<ul>";
			echo "<li>";
			//echo "<a href='index.php?lx=gorevtanimdetay.php&detaygoster=".$g->id."'>".$g->adsoyad."</a>";
            echo "<a href='index.php?lx=base.php&gorevtanimdetay=".$g->id."'>".$g->adsoyad."</a>";
			echo "</li>";
			echo "</ul>";
			echo "<hr>";
		}
	}
	?>

</div>